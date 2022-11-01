<?php

use phpformbuilder\Form;
use dragNDropFormGenerator\FormGenerator;

session_start();
include_once '../FormGenerator.php';
include_once '../../phpformbuilder/Form.php';
$json = json_decode($_POST['data']);
/* foreach ($json as $var => $val) {
    ${$var} = $val;
    echo '<h3 class="text-white fw-light bg-secondary px-2 py-1">' . $var . '</h3>';
    var_dump(${$var});
} */

$generator = new FormGenerator($_POST['data'], false);
file_put_contents("../../../forms/form_". $json->formName. ".php", $generator->outputPureFormCode($json->title));

?>

<?php echo "success" ?>
<!-- JavaScript -->
<script src="../public/assets/formbuilder/assets/javascripts/get-code.js"></script>
