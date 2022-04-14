<?php 
require_once 'files.php';

$files = new Files();
if(isset($_POST['deleteFiles'] )) {
    $files->delete($_POST['id'], $_POST['deleteFiles']);
}

if(isset($_POST['shareFiles'] )) {
    // get text after = in formData
    $text = explode("=", $_POST['formData']);
    $text = $text[1];

    $randomLink = $files->share($_POST['id'], $text, $_POST['shareFiles']);
    echo $randomLink;
}

if(isset($_POST['archiveFiles'] )) {
    $files->archive($_POST['archiveFiles'], $_POST['shared_files_id']);
}

if(isset($_POST['shared_id'] )) {
    $files->deleteSharedid($_POST['shared_id']);
}

