<?php

function generateRandomString($length = 13) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (!isset($_POST['data'])) {
    exit('ERROR');
}

// if (!preg_match('`^[A-Za-z0-9\s\\\/_-]+$`', json_decode($_POST['filepath']))) {
//     exit('WRONG FILE PATH');
// }

$form_data = json_decode($_POST['data']);
// $filepath = preg_replace('`(.*)json-forms`', '../json-forms', json_decode($_POST['filepath']));
// $filepath = rtrim($filepath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
// $filepath = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $filepath);
$output = array(
    'status' => '',
    'msg'    => ''
);

$json_error = '';
switch (json_last_error()) {
    case JSON_ERROR_NONE:
    break;
    case JSON_ERROR_DEPTH:
        $json_error = 'JSON error - Maximum stack depth exceeded';
    break;
    case JSON_ERROR_STATE_MISMATCH:
        $json_error =  'JSON error - Underflow or the modes mismatch';
    break;
    case JSON_ERROR_CTRL_CHAR:
        $json_error =  'JSON error - Unexpected control character found';
    break;
    case JSON_ERROR_SYNTAX:
        $json_error =  'JSON error - Syntax error, malformed JSON';
    break;
    case JSON_ERROR_UTF8:
        $json_error =  'JSON error - Malformed UTF-8 characters, possibly incorrectly encoded';
    break;
    default:
        $json_error =  'JSON error - Unknown error';
    break;
}

if (!empty($json_error)) {
    $output = array(
        'status' => 'danger',
        'msg'    => $json_error
    );
}

// if (!is_writable($filepath)) {
//     $output = array(
//         'status' => 'danger',
//         'msg'    => 'The target directory is not writable'
//     );
// }

// All ok
if ($output['status'] !== 'danger') {
    // $form_id = $form_data->userForm->id;
    $fileName = generateRandomString();
    $dist_path = __DIR__ . DIRECTORY_SEPARATOR . "../../../builders/";
    file_put_contents($dist_path . $fileName . '.json', json_encode($form_data));

    // file_put_contents($filepath . $form_id . '.json', json_encode($form_data));
    $output = array(
        'status' => 'success',
        'msg'    => $fileName
    );;
}

echo json_encode($output);
