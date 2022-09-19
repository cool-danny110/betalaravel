<?php

namespace phpformbuilder\database;

/**
 * Ultimate MySQL PDO database utility class with built-in debugging and logging
 *
 * This database class uses a global PDO database connection to make it easier
 * to retrofit into existing projects or use in new projects. All of the code is in a
 * single file to make it incredibly easy to install and learn. Some basic
 * knowledge of how PDO "placeholders" work is helpful but not necessary. Every
 * effort to use them is applied to stop SQL injection hacks and also because:
 *
 * "There is a common misconception about how the placeholders in prepared
 * statements work. They are not simply substituted in as (escaped) strings,
 * and the resulting SQL executed. Instead, a DBMS asked to "prepare" a
 * statement comes up with a complete query plan for how it would execute that
 * query, including which tables and indexes it would use."
 * http://php.net/manual/en/pdo.prepare.php
 *
 * I (@Jeff Williams) also made every efforts to take care of all the details like try/catch
 * error checking, PHP error logging, security, full transaction processing,
 * and using as little memory and being as lightweight as possible while still
 * containing a lot of great features.
 *
 * Starting from the original version designed by Jeff Williams
 * I (Gilles Migliori) reverted to an object based conception rather than static, mainly for 2 reasons:
 * - The connection to the database is done automatically when the instance is created
 * - This allows to store different useful data and keep them within the instance
 *   instead of storing them in global variables.
 *
 * @author Jeff Williams
 * @author Gilles Migliori
 * @version 2.0
 */
class DB
{
    private $error = ''; // error message if any failure
    private $last_insert_id = -1; // last id of record inserted
    private $pdo; // PDO internal object
    private $query; // PDO Statement
    private $row_count = 0; // number of rows returned by the latest query
    private $show_errors;

    /**
     * Creates the DB object and & connects to a MySQL PDO database.
     *
     * @param string $username Database user name
     * @param string $password Database password
     * @param string $database Database or schema name
     * @param string $hostname [OPTIONAL] Host name of the server
     * @param bool $show_errors [OPTIONAL] Show errors on queries or connection
     * @return bool true if connection is successfull, otherwise false
     */
    public function __construct(
        $show_errors = false,
        $username = DBUSER,
        $password = DBPASS,
        $database = DBNAME,
        $hostname = DBHOST
    ) {
        try {
            $success = false;
            // Connect to the MySQL database
            $this->pdo = new \PDO(
                'mysql:' .
                    'host='   . $hostname . ';' .
                    'dbname=' . $database,
                $username,
                $password
            );

            $this->show_errors = $show_errors;
            // If we are connected...
            if ($this->pdo) {
                // The default error mode for PDO is \PDO::ERRMODE_SILENT.
                // With this setting left unchanged, you'll need to manually
                // fetch errors, after performing a query
                if ($this->show_errors) {
                    $this->pdo->setAttribute(
                        \PDO::ATTR_ERRMODE,
                        \PDO::ERRMODE_EXCEPTION
                    );
                }

                // Connection was successful
                $success = true;
            }
        } catch (\PDOException $e) {
            // If onnection was not successful
            $error = 'Database Connection Error (' . __METHOD__ . '): ' .
                $e->getMessage();

            // Send the error to the error event handler
            $this->errorEvent($error, $e->getCode());
        }

        // Return the results
        return $success;
    }

    /**
     * Executes a SQL statement using PDO
     *
     * @param string $sql SQL
     * @param array $placeholders [OPTIONAL] Associative array placeholders for binding to SQL
     *                            array("name' => 'Cathy', 'city' => 'Cardiff')
     * @param bool $debug [OPTIONAL] If set to true, will output results and query info
     * @return bool (Last INSERT ID if INSERT or) true if success otherwise false
     */
    public function execute($sql, $placeholders = false, $debug = false)
    {

        // Set the variable initial values
        $qry = false;
        $count = false;
        $id    = false;
        $time  = false;

        // reset the global db_last_insert_id & db_row_count
        $this->last_insert_id = -1;
        $this->row_count = 0;

        // Is there already a transaction pending? No nested transactions in MySQL!
        $existing_transaction = $this->pdo->inTransaction();

        // Is this a SQL INSERT statement? Check the first word...
        $insert = (strtoupper(strtok(trim($sql), ' '))) === 'INSERT';

        // Is this a SQL SELECT statement? Check the first word...
        $select = (strtoupper(strtok(trim($sql), ' '))) === 'SELECT';

        // Set a flag
        $return = false;

        try {
            // Begin a transaction
            if (!$existing_transaction) {
                $this->pdo->beginTransaction();
            }

            // Create the query object
            $qry = $this->pdo->prepare($sql);

            // If there are values in the passed in array
            if (!empty($placeholders) && is_array($placeholders)) {
                // Loop through the placeholders and values
                foreach ($placeholders as $field => $value) {
                    // Determine the datatype
                    if (is_int($value)) {
                        $datatype = \PDO::PARAM_INT;
                    } elseif (is_bool($value)) {
                        $datatype = \PDO::PARAM_BOOL;
                    } elseif (is_null($value)) {
                        $datatype = \PDO::PARAM_NULL;
                    } elseif ($value instanceof \DateTime) {
                        $value = $value->format('Y-m-d H:i:s');
                        $placeholders[$field] = $value;
                        $datatype = \PDO::PARAM_STR;
                    } else {
                        $datatype = \PDO::PARAM_STR;
                    }

                    // Bind the placeholder and value to the query
                    $qry->bindValue($field, $value, $datatype);
                }
            }

            // Start a timer
            $time_start = microtime(true);

            // Execute the query
            $qry->execute();

            if ($select) {
                $count = $qry->rowCount();
                $this->row_count = $count;
            }

            // Find out how long the query took
            $time_end = microtime(true);
            $time = $time_end - $time_start;

            // If this was an INSERT...
            if ($insert) {
                // Get the last inserted ID (has to be done before the commit)
                $id = $this->pdo->lastInsertId();
            }

            // Debug only
            if ($debug) {
                // Rollback the transaction
                if (!$existing_transaction) {
                    $this->pdo->rollback();
                }

                // Output debug information
                $this->dumpDebug(
                    __FUNCTION__,
                    $sql,
                    $placeholders,
                    $qry,
                    false,
                    $time,
                    $count,
                    $id
                );

                // Exit
                die();
            }

            // Commit the transaction
            if (!$existing_transaction) {
                $this->pdo->commit();
            }

            // If this was an INSERT...
            if ($insert) {
                // Hand back the last inserted ID
                $return = $id;
                $this->last_insert_id = $id;
            } else {
                // Query was successful
                $return = true;
            }
        } catch (\PDOException $e) { // If there was an error...
            $interpolated_sql = $this->interpolateQuery($sql, $placeholders);
            // Get the error
            $err = 'Database Error (' . __METHOD__ . '): '
                . $e->getMessage() . ' ' . $interpolated_sql;

            // Send the error to the error event handler
            $this->errorEvent($err, $e->getCode());

            // If we are in debug mode...
            if ($debug) {
                // Output debug information
                $this->dumpDebug(
                    __FUNCTION__,
                    $sql,
                    $placeholders,
                    $qry,
                    false,
                    $time,
                    $count,
                    $id,
                    $err
                );
            }

            // Rollback the transaction
            if (!$existing_transaction) {
                $this->pdo->rollback();
            }
        } catch (\Exception $e) { // If there was an error...
            // Get the error
            $err = 'General Error (' . __METHOD__ . '): ' . $e->getMessage();

            // Send the error to the error event handler
            $this->errorEvent($err, $e->getCode());

            // If we are in debug mode...
            if ($debug) {
                // Output debug information
                $this->dumpDebug(
                    __FUNCTION__,
                    $sql,
                    $placeholders,
                    $qry,
                    false,
                    $time,
                    $count,
                    $id,
                    $err
                );
            }

            // Rollback the transaction
            if (!$existing_transaction) {
                $this->pdo->rollback();
            }
        }

        // Clean up
        unset($qry);

        // If this was a successful INSERT with an ID...
        if ($return && $id) {
            // Return the ID instead
            $return = $id;
        }

        // Return [the ID or] true if success and false if failure
        return $return;
    }

    /**
     * Executes a SQL query using PDO
     *
     * @param string $sql SQL
     * @param array $placeholders [OPTIONAL] Associative array placeholders for binding to SQL
     *                            array('name' => 'Cathy', 'city' => 'Cardiff')
     * @param bool $debug [OPTIONAL] If set to true, will output results and query info
     * @return bool true if success otherwise false
     */
    public function query(
        $sql,
        $placeholders = false,
        $debug = false
    ) {

        // Set the variable initial values
        $this->query = false;
        $return      = false;
        $time        = false;

        // reset the global db_last_insert_id & db_row_count
        $this->last_insert_id = -1;
        $this->row_count = 0;

        try {
            // Create the query object
            $this->query = $this->pdo->prepare($sql);

            // If there are values in the passed in array
            if (!empty($placeholders) && is_array($placeholders)) {
                // Loop through the placeholders and values
                foreach ($placeholders as $field => $value) {
                    // Determine the datatype
                    if (is_int($value)) {
                        $datatype = \PDO::PARAM_INT;
                    } elseif (is_bool($value)) {
                        $datatype = \PDO::PARAM_BOOL;
                    } elseif (is_null($value)) {
                        $datatype = \PDO::PARAM_NULL;
                    } elseif ($value instanceof \DateTime) {
                        $value = $value->format('Y-m-d H:i:s');
                        $placeholders[$field] = $value;
                        $datatype = \PDO::PARAM_STR;
                    } else {
                        $datatype = \PDO::PARAM_STR;
                    }

                    // Bind the placeholder and value to the query
                    $this->query->bindValue($field, $value, $datatype);
                }
            }

            // Start a timer
            $time_start = microtime(true);

            // Execute the query
            $this->query->execute();

            // Find out how long the query took
            $time_end = microtime(true);
            $time = $time_end - $time_start;

            $this->row_count = $this->query->rowCount();

            // Query was successful
            $return = true;


            // Debug only
            if ($debug) {
                // Output debug information
                $this->dumpDebug(
                    __FUNCTION__,
                    $sql,
                    $placeholders,
                    $this->query,
                    $return,
                    $time,
                    $this->row_count
                );
            }
        } catch (\PDOException $e) { // If there was an error...
            // Get the error
            $err = 'Database Error (' . __METHOD__ . '): '
                . $e->getMessage() . ' ' . $sql;

            // Send the error to the error event handler
            $this->errorEvent($err, $e->getCode());

            // If we are in debug mode...
            if ($debug) {
                // Output debug information
                $this->dumpDebug(
                    __FUNCTION__,
                    $sql,
                    $placeholders,
                    $this->query,
                    $return,
                    $time,
                    false,
                    false,
                    $err
                );
            }

            // die($e->getMessage());
        } catch (\Exception $e) { // If there was an error...
            // Get the error
            $err = 'General Error (' . __METHOD__ . '): ' . $e->getMessage();

            // Send the error to the error event handler
            $this->errorEvent($err, $e->getCode());

            // If we are in debug mode...
            if ($debug) {
                // Output debug information
                $this->dumpDebug(
                    __FUNCTION__,
                    $sql,
                    $placeholders,
                    $this->query,
                    $return,
                    $time,
                    false,
                    false,
                    $err
                );
            }

            // die($e->getMessage());
        }

        // Clean up
        unset($query);

        // Return true if success and false if failure
        return $return;
    }

    /**
     * Executes a SQL query using PDO and returns one row
     *
     * @param string $sql SQL
     * @param array $placeholders [OPTIONAL] Associative array placeholders for binding to SQL
     *                            array('name' => 'Cathy', 'city' => 'Cardiff')
     * @param bool $debug [OPTIONAL] If set to true, will output results and query info
     * @param integer $fetch_parameters [OPTIONAL] PDO fetch style record options
     * @return mixed Array or object with values if success otherwise false
     */
    public function queryRow(
        $sql,
        $placeholders = false,
        $debug = false,
        $fetch_parameters = \PDO::FETCH_OBJ
    ) {

        // It's better on resources to add LIMIT 1 to the end of your SQL
        // statement if there are multiple rows that will be returned
        $this->query($sql, $placeholders, $debug);

        return $this->fetch($fetch_parameters);
    }

    /**
     * Executes a SQL query using PDO and returns a single value only
     *
     * @param string $sql SQL
     * @param array $placeholders Associative array placeholders for binding to SQL
     *                            array('name' => 'Cathy', 'city' => 'Cardiff')
     * @param bool $debug If set to true, will output results and query info
     * @return mixed A returned value from the database if success otherwise false
     */
    public function queryValue($sql, $placeholders = false, $debug = false)
    {

        // It's better on resources to add LIMIT 1 to the end of your SQL
        // if there are multiple rows that will be returned
        $results = $this->queryRow($sql, $placeholders, $debug, \PDO::FETCH_NUM);

        // If a record was returned
        if (is_array($results)) {
            // Return the first element of the array which is the first row
            return $results[0];
        } else {
            // No records were returned
            return false;
        }
    }

    /**
     * Selects records from a table using PDO
     *
     * @param string $table Table name
     * @param array $values [OPTIONAL] Array or string containing the field names
     *                            array('name', 'city') or 'name, city'
     * @param array/string [OPTIONAL] $where Array containing the fields and values or a string
     *                            $where = array();
     *                            $where['id >'] = 1234;
     *                            $where[] = 'first_name IS NOT NULL';
     *                            $where['some_value <>'] = 'text';
     * @param array/string [OPTIONAL] $order Array or string containing field order
     * @param bool $debug [OPTIONAL] If set to true, will output results and query info
     * @return bool true if success otherwise false
     */
    public function select(
        $table,
        $values = '*',
        $where = false,
        $order = false,
        $debug = false
    ) {

        // If the values are in an array
        if (is_array($values)) {
            // Join the fields
            $sql = 'SELECT ' . implode(', ', $values);
        } else { // It's a string
            // Create the SELECT
            $sql = 'SELECT ' . trim($values);
        }

        // Create the SQL WHERE clause
        $where_array = $this->whereClause($where);
        $sql .= ' FROM ' . trim($table) . $where_array['sql'];

        // If the order values are in an array
        if (is_array($order)) {
            // Join the fields
            $sql .= ' ORDER BY ' . implode(', ', $order);
        } elseif ($order) { // It's a string
            // Specify the order
            $sql .= ' ORDER BY ' . trim($order);
        }

        // Execute the query and return the results
        return $this->query(
            $sql,
            $where_array['placeholders'],
            $debug
        );
    }

    /**
     * Selects a single record from a table using PDO
     *
     * @param string $table Table name
     * @param array $values [OPTIONAL] Array or string containing the field names
     *                            array('name', 'city') or 'name, city'
     * @param array/string [OPTIONAL] $where Array containing the fields and values or a string
     *                            $where = array();
     *                            $where['id >'] = 1234;
     *                            $where[] = 'first_name IS NOT NULL';
     *                            $where['some_value <>'] = 'text';
     * @param bool $debug [OPTIONAL] If set to true, will output results and query info
     * @param integer $fetch_parameters [OPTIONAL] PDO fetch style record options
     * @return mixed Array with values if success otherwise false
     */
    public function selectRow(
        $table,
        $values = '*',
        $where = false,
        $debug = false,
        $fetch_parameters = \PDO::FETCH_OBJ
    ) {

        // If the values are in an array
        if (is_array($values)) {
            // Join the fields
            $sql = 'SELECT ' . implode(', ', $values);
        } else { // It's a string
            // Create the SELECT
            $sql = 'SELECT ' . trim($values);
        }

        // Create the SQL WHERE clause
        $where_array = $this->whereClause($where);
        $sql .= ' FROM ' . trim($table) . $where_array['sql'];

        // Make sure only one row is returned
        $sql .= ' LIMIT 1';

        // Execute the query and return the results
        return $this->queryRow(
            $sql,
            $where_array['placeholders'],
            $debug,
            $fetch_parameters
        );
    }

    /**
     * Selects a single record from a table using PDO
     *
     * @param string $table Table name
     * @param string $field The name of the field to return
     * @param array/string [OPTIONAL] $where Array containing the fields and values or a string
     *                            $where = array();
     *                            $where['id >'] = 1234;
     *                            $where[] = 'first_name IS NOT NULL';
     *                            $where['some_value <>'] = 'text';
     * @param bool $debug [OPTIONAL] If set to true, will output results and query info
     * @return mixed The value if success otherwise false
     */
    public function selectValue($table, $field, $where = false, $debug = false)
    {

        // Return the row
        $results = $this->selectRow($table, $field, $where, $debug, \PDO::FETCH_NUM);

        // If a record was returned
        if (is_array($results)) {
            // Return the first element of the array which is the first row
            return $results[0];
        } else {
            // No records were returned
            return false;
        }
    }

    /**
     * Inserts a new record into a table using PDO
     *
     * @param string $table Table name
     * @param array $values Associative array containing the fields and values
     *                      array('name' => 'Cathy', 'city' => 'Cardiff')
     * @param bool $debug [OPTIONAL] If set to true, will output results and query info
     * @return mixed Returns the last inserted ID or true otherwise false
     */
    public function insert($table, $values, $debug = false)
    {

        // Create the SQL statement with PDO placeholders created with regex
        $sql = 'INSERT INTO ' . trim($table) . ' ('
            . implode(', ', array_keys($values)) . ') VALUES ('
            . implode(', ', preg_replace('/^([A-Za-z0-9_-]+)$/', ':${1}', array_keys($values)))
            . ')';

        // Execute the query
        return $this->execute($sql, $values, $debug);
    }

    /**
     * Updates an existing record into a table using PDO
     *
     * @param string $table Table name
     * @param array $values Associative array containing the fields and values
     *                            array('name' => 'Cathy', 'city' => 'Cardiff')
     * @param array/string $where [OPTIONAL] Array containing the fields and values or a string
     *                            $where = array();
     *                            $where['id >'] = 1234;
     *                            $where[] = 'first_name IS NOT NULL';
     *                            $where['some_value <>'] = 'text';
     * @param bool $debug [OPTIONAL] If set to true, will output results and query info
     * @return bool true if success otherwise false
     */
    public function update($table, $values, $where = false, $debug = false)
    {

        // Create the initial SQL
        $sql = 'UPDATE ' . trim($table) . ' SET ';

        // Create SQL SET values
        $output = array();
        foreach ($values as $key => $value) {
            $output[] = $key . ' = :' . $key;
        }

        // Concatenate the array values
        $sql .= implode(', ', $output);

        // Create the SQL WHERE clause
        $where_array = $this->whereClause($where);
        $sql .= $where_array['sql'];

        // Execute the query
        return $this->execute(
            $sql,
            array_merge($values, $where_array['placeholders']),
            $debug
        );
    }

    /**
     * Deletes a record from a table using PDO
     *
     * @param string $table Table name
     * @param array/string $where [OPTIONAL] Array containing the fields and values or a string
     *                            $where = array();
     *                            $where['id >'] = 1234;
     *                            $where[] = 'first_name IS NOT NULL';
     *                            $where['some_value <>'] = 'text';
     * @param bool $debug [OPTIONAL] If set to true, will output results and query info
     * @return bool true if success otherwise false
     */
    public function delete($table, $where = false, $debug = false)
    {

        // Create the SQL
        $sql = 'DELETE FROM ' . trim($table);

        // Create the SQL WHERE clause
        $where_array = $this->whereClause($where);
        $sql .= $where_array['sql'];

        // Execute the query
        return $this->execute($sql, $where_array['placeholders'], $debug);
    }

    /**
     * Fetches the next row from a result set and returns it according to the $fetch_parameters format
     *
     * @param int $fetch_parameters
     * @return mixed then next row or false if we reached the end
     */
    public function fetch($fetch_parameters = \PDO::FETCH_OBJ)
    {
        return $this->query->fetch($fetch_parameters);
    }

    /**
     * Fetches all rows from a result set and return them according to the $fetch_parameters format
     *
     * @param int $fetch_parameters [OPTIONAL] PDO fetch style record options
     * @return mixed The rows according to PDO fetch style or false if no record
     */
    public function fetchAll($fetch_parameters = \PDO::FETCH_OBJ)
    {
        return $this->query->fetchAll($fetch_parameters);
    }

    /**
     * Begin transaction processing
     *
     */
    public function transactionBegin()
    {
        try {
            // Begin transaction processing
            $success = $this->pdo->beginTransaction();
        } catch (\PDOException $e) { // If there was an error...
            // Return false to show there was an error
            $success = false;

            // Send the error to the error event handler
            $this->errorEvent('Database Error (' . __METHOD__ . '): ' .
                $e->getMessage(), $e->getCode());
        } catch (\Exception $e) { // If there was an error...
            // Return false to show there was an error
            $success = false;

            // Send the error to the error event handler
            $this->errorEvent('General Error (' . __METHOD__ . '): ' .
                $e->getMessage(), $e->getCode());
        }

        return $success;
    }

    /**
     * Commit and end transaction processing
     *
     */
    public function transactionCommit()
    {
        try {
            // Commit and end transaction processing
            $success = $this->pdo->commit();
        } catch (\PDOException $e) { // If there was an error...
            // Return false to show there was an error
            $success = false;

            // Send the error to the error event handler
            $this->errorEvent('Database Error (' . __METHOD__ . '): ' .
                $e->getMessage(), $e->getCode());
        } catch (\Exception $e) { // If there was an error...
            // Return false to show there was an error
            $success = false;

            // Send the error to the error event handler
            $this->errorEvent('General Error (' . __METHOD__ . '): ' .
                $e->getMessage(), $e->getCode());
        }

        return $success;
    }

    /**
     * Roll back transaction processing
     *
     */
    public function transactionRollback()
    {
        try {
            // Roll back transaction processing
            $success = $this->pdo->rollback();
        } catch (\PDOException $e) { // If there was an error...
            // Return false to show there was an error
            $success = false;

            // Send the error to the error event handler
            $this->errorEvent('Database Error (' . __METHOD__ . '): ' .
                $e->getMessage(), $e->getCode());
        } catch (\Exception $e) { // If there was an error...
            // Return false to show there was an error
            $success = false;

            // Send the error to the error event handler
            $this->errorEvent('General Error (' . __METHOD__ . '): ' .
                $e->getMessage(), $e->getCode());
        }

        return $success;
    }

    /**
     * Converts a Query() or Select() array of records into a simple array
     * using only one column or an associative array using another column as a key
     *
     * @param array $array The array returned from a PDO query using fetchAll
     * @param string $value_field The name of the field that holds the value
     * @param string $key_field [OPTIONAL] The name of the field that holds the key
     *                          making the return value an associative array
     * @return array Returns an array with only the specified data
     */
    public function convertQueryToSimpleArray($array, $value_field, $key_field = false)
    {
        // Create an empty array
        $return = array();

        // Loop through the query results
        foreach ($array as $element) {
            // If we have a key
            if ($key_field) {
                // Add this key
                $return[$element[$key_field]] = $element[$value_field];
            } else { // No key field
                // Append to the array
                $return[] = $element[$value_field];
            }
        }

        // Return the new array
        return $return;
    }

    /**
     * This function returns a SQL query as an HTML table
     *
     * @param string $sql SQL
     * @param array $placeholders [OPTIONAL] Associative array placeholders for binding to SQL
     *                            array("name' => 'Cathy', 'city' => 'Cardiff')
     * @param bool $showCount (Optional) true if you want to show the row count,
     *                           false if you do not want to show the count
     * @param string $styleTable (Optional) Style information for the table
     * @param string $styleHeader (Optional) Style information for the header row
     * @param string $styleData (Optional) Style information for the cells
     * @return string HTML containing a table with all records listed
     */
    public function getHTML(
        $sql,
        $placeholders = false,
        $showCount = true,
        $styleTable = null,
        $styleHeader = null,
        $styleData = null
    ) {

        // Set default style information
        if ($styleTable === null) {
            $tb = "border-collapse:collapse;empty-cells:show";
        } else {
            $tb = $styleTable;
        }
        if ($styleHeader === null) {
            $th = "border-width:1px;border-style:solid;background-color:navy;color:white";
        } else {
            $th = $styleHeader;
        }
        if ($styleData === null) {
            $td = "border-width:1px;border-style:solid";
        } else {
            $td = $styleData;
        }

        // Get the records
        $this->query($sql, $placeholders);
        $records = $this->fetchAll(\PDO::FETCH_ASSOC);

        // If there was no error...
        if (is_array($records)) {
            // If records were returned...
            if (!empty($records)) {
                // Begin the table
                $html = "";
                if ($showCount) {
                    $html = "Total Count: " . count($records) . "<br />\n";
                }
                $html .= "<table style=\"$tb\" cellpadding=\"2\" cellspacing=\"2\">\n";

                // Create the header row
                $html .= "\t<tr>\n";
                foreach (array_keys($records[0]) as $value) {
                    $html .= "\t\t<td style=\"$th\"><strong>" . htmlspecialchars($value) . "</strong></td>\n";
                }
                $html .= "\t</tr>\n";

                // Create the rows with data
                foreach ($records as $row) {
                    $html .= "\t<tr>\n";
                    foreach ($row as $value) {
                        $html .= "\t\t<td style=\"$td\">" . htmlspecialchars($value) . "</td>\n";
                    }
                    $html .= "\t</tr>\n";
                }

                // Close the table
                $html .= "</table>";
            } else { // No records were returned
                $html = "No records were returned.";
            }
        } else { // There was an error with the SQL
            $html = false;
        }

        // Return the table HTML code
        return $html;
    }

    /**
     * Converts empty values to NULL
     *
     * @param         $value Any value
     * @param bool $includeZero Include 0 as NULL?
     * @param bool $includeFalse Include false as NULL?
     * @param bool $includeBlankString Include a blank string as NULL?
     * @return unknown_type The value or NULL if empty
     */
    public function emptyToNull(
        $value,
        $includeZero = true,
        $includeFalse = true,
        $includeBlankString = true
    ) {
        $return = $value;
        if (!$includeFalse && $value === false) {
            // Skip
        } elseif (!$includeZero && ($value === 0 || trim($value) === '0')) {
            // Skip
        } elseif (!$includeBlankString && trim($value) === '') {
            // Skip
        } elseif (is_string($value)) {
            if (strlen(trim($value)) == 0) {
                $return = null;
            } else {
                $return = trim($value);
            }
        } elseif (empty($value)) {
            $return = null;
        }
        return $return;
    }

    public function error()
    {
        return $this->error;
    }

    public function getLastInsertId()
    {
        if ($this->last_insert_id > 0) {
            return $this->last_insert_id;
        }

        return false;
    }

    public function rowCount()
    {
        return $this->row_count;
    }

    /**
     * Returns a quoted string that is safe to pass into an SQL statement
     *
     * @param string $value A string value or DateTime object
     * @return string The newly encoded string with quotes
     */
    public function safe($value)
    {

        // If it's a string...
        if (is_string($value)) {
            // Use PDO to encode it
            return $this->pdo->quote($value);

            // If it's a DateTime object...
        } elseif ($value instanceof \DateTime) {
            // Format the date as a string for MySQL and use PDO to encode it
            return $this->pdo->quote($value->format('Y-m-d H:i:s'));

            // It's something else...
        } else {
            // Return the original value
            return $value;
        }
    }

    /**
     * This is an event function that is called every time there is an error.
     * You can add code into this function to do things such as:
     * 1. Log errors into the database
     * 2. Send an email with the error message
     * 3. Save out to some type of log file
     * 4. Make a RESTful API call
     * 5. Run a script or program
     * 6. Set a session or global variable
     * Or anything you might want to do when an error occurs.
     *
     * @param string $error The error description [$exception->getMessage()]
     * @param int $error_code [OPTIONAL] The error number [$exception->getCode()]
     */
    protected function errorEvent($error, $error_code = 0)
    {

        // Send this error to the PHP error log
        if (empty($error_code)) {
            error_log($error, 0);
        } else {
            error_log('DB error ' . $error_code . ': ' . $error, 0);
        }

        // register the error
        $this->error = '<p style="padding: 1rem;"><strong style="color:#70131E; margin-right: 1rem;">Database error ' . $error_code . '</strong>: <em>' . $error . '</em></p>';

        if ($this->show_errors) {
            echo $this->error;
        }
    }

    /**
     * Builds a SQL WHERE clause from an array
     *
     * @param       $where Array containing the fields and values or a string
     *                            $where = array();
     *                            $where['id >'] = 1234;
     *                            $where[] = 'first_name IS NOT NULL';
     *                            $where['some_value <>'] = 'text';
     * @return array An associative array with both a 'sql' and 'placeholders' key
     */
    protected function whereClause($where)
    {

        // Create an array to hold the place holder values (if any)
        $placeholders = array();

        // Create a variable to hold SQL
        $sql = '';

        // If an array was passed in...
        if (is_array($where)) {
            // Create an array to hold the WHERE values
            $output = array();

            // loop through the array
            foreach ($where as $key => $value) {
                // If a key is specified for a PDO place holder field...
                if (is_string($key)) {
                    // Extract the key
                    $extracted_key = preg_replace(
                        '/^(\s*)([^\s=<>]*)(.*)/',
                        '${2}',
                        $key
                    );

                    $extracted_key = str_replace('.', '_', $extracted_key);

                    // If no < > = was specified...
                    if (trim(str_replace('.', '_', $key)) == $extracted_key) {
                        // Add the PDO place holder with an =
                        $output[] = trim($key) . ' = :' . $extracted_key;
                    } else { // A comparison exists...
                        // Add the PDO place holder
                        $output[] = trim($key) . ' :' . $extracted_key;
                    }

                    // Add the placeholder replacement values
                    $placeholders[$extracted_key] = $value;
                } else { // No key was specified...
                    $output[] = $value;
                }
            }

            // Concatenate the array values
            $sql = ' WHERE ' . implode(' AND ', $output);
        } elseif ($where) {
            $sql = ' WHERE ' . trim($where);
        }

        // Set the place holders to false if none exist
        if (empty($placeholders)) {
            $placeholders = false;
        }

        // Return the sql and place holders
        return array(
            "sql" => $sql,
            "placeholders" => $placeholders
        );
    }

    /**
     * Dump debug information to the screen
     *
     * @param string $source The source to show on the debug output
     * @param string $sql SQL
     * @param array $placeholders [OPTIONAL] Placeholders array
     * @param object $query [OPTIONAL] PDO query object
     * @param int $count [OPTIONAL] The record count
     * @param int $id [OPTIONAL] Last inserted ID
     * @param string $error [OPTIONAL] Error text
     */
    private function dumpDebug(
        $source,
        $sql,
        $placeholders = false,
        $query = false,
        $records = false,
        $time = false,
        $count = false,
        $id = false,
        $error = false
    ) {

        // Format the source
        $source = strtoupper($source);

        // If there was an error specified
        if ($error) {
            // Show the error information
            print "\n<br>\n--DEBUG " . $source . " ERROR FROM DB--\n<pre><code>";
            print_r($error);
        }

        // If the number of seconds is specified...
        if ($time !== false) {
            // Show how long it took
            print "</code></pre>\n--DEBUG " . $source . " TIMER FROM DB--\n<pre><code>\n";
            echo number_format($time, 6) . ' ms';
        }

        // Output the SQL
        print "</code></pre>\n--DEBUG " . $source . " SQL FROM DB--\n<pre><code>";
        print_r($sql);

        // If there were placeholders passed in...
        if ($placeholders) {
            // Show the placeholders
            print "</code></pre>\n--DEBUG " . $source . " PARAMS FROM DB--\n<pre><code>";
            print_r($placeholders);
        }

        // If a query object exists...
        if ($query) {
            // Show the query dump
            print "</code></pre>\n--DEBUG " . $source . " DUMP FROM DB--\n<pre><code>";
            print_r($query->debugDumpParams());
        }

        // If records were returned...
        if ($count !== false) {
            // Show the count
            print "</code></pre>\n--DEBUG " . $source . " ROW COUNT FROM DB--\n<pre><code>";
            print_r($count);
        }

        // If this was an INSERT with an ID...
        if ($id) {
            // Show the last inserted ID
            print "</code></pre>\n--DEBUG LAST INSERTED ID FROM DB--\n<pre><code>";
            print_r($id);
        }

        // If records were returned...
        if ($records) {
            // Show the rows returned
            print "</code></pre>\n--DEBUG " . $source . " RETURNED RESULTS FROM DB--\n<pre><code>";
            print_r($records);
        }

        // End the debug output
        print "</code></pre>\n--DEBUG " . $source . " END FROM DB--\n<br>\n";
    }

    private function interpolateQuery($query, $params)
    {
        $keys = array();
        $values = $params;

        # build a regular expression for each parameter
        foreach ($params as $key => $value) {
            if (is_string($key)) {
                $keys[] = '/:' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }

            if (is_string($value)) {
                $values[$key] = "'" . $value . "'";
            }

            if (is_array($value)) {
                $values[$key] = "'" . implode("','", $value) . "'";
            }

            if (is_null($value)) {
                $values[$key] = 'NULL';
            }
        }

        $query = preg_replace($keys, $values, $query);

        return $query;
    }
}
