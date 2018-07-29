<?php        
        // get ip     
        $ip = $_SERVER['REMOTE_ADDR'];     
        $root = $_SERVER{'DOCUMENT_ROOT'};     
        
        // filename without t0
        $f = $_REQUEST["f"];
        // if no filename is given, use ss.t0
        if (trim($f)=="") {
            $f = 'ss';
        }
        $f = trim($f) . '.t0';
                         
        // application name  
        $p = $_REQUEST["p"];  

        // get line for addition  
        $add = $_REQUEST['a'];     
        $add_lower = strtolower($add);

        // generate directory name  
        if($p=="") {  
            $d = $ip;  
        } else {  
            $p = trim(stripslashes(htmlspecialchars($p)));  
            $d = $ip . "_" . $p;  
        }
              
        // create new application if directory doesn't exist
        if( !file_exists( $root . "/online/$d"))  {      
            echo "Creating new application $d<br>";     
            mkdir ($root . "/online/$d", 0755);     
        }     

        // add .t0 to the end of the filename
        $fn = $d . "/" . trim($f);
             
        // open file in write or append mode     
        if ( !file_exists($fn) || $add_lower=="clear") {
                $handle = fopen ($fn, 'w');
        } else {
                $handle = fopen ($fn, 'a');
        }
        
        if (strtolower($add)=="clear") {     
                // clear file contents by writing " " in write mode
                fwrite ($handle, " ");     

                // Close file
                fclose($handle);     

                // Print Status Message
                echo "Cleared T0 file: " . $f;
        } else {
                // Write values
                fwrite ($handle, $add);

                // Close file
                fclose($handle);   

                // Print Status Message     
                echo "Successfully added to T0 file: " . $f;     
        }     
?>