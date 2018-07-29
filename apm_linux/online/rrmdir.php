<?php
  function rrmdir($path) {
     $path = rtrim($path, '/').'/';
     $handle = opendir($path);
     echo "Path: $path \n";
     while(false !== ($file = readdir($handle))) {
        echo "File Delete: $file \n";
        if($file != '.' and $file != '..' ) {
            $fullpath = $path.$file;
            if(is_dir($fullpath)) rrmdir($fullpath); else unlink($fullpath);
        }
     }
     closedir($handle);
     rmdir($path);
  }
?>