<?php       
        include 'rrmdir.php';

        // get ip    
        $ip = $_SERVER['REMOTE_ADDR'];    
        $root = $_SERVER{'DOCUMENT_ROOT'};    
                    
        // application name 
        $p = $_REQUEST["p"]; 
        // generate directory name 
        if($p=="") { 
            $d = $ip; 
        } else { 
            $p = trim(stripslashes(htmlspecialchars($p)));
            $d = $ip . "_" . $p; 
        } 
             
        // path
        $path = "$root/online/$d";

        // create new    
        if( !file_exists($path))  {     
                echo "Creating new application $d<br>";    
                mkdir ($path, 0777);    
        }

        // get line for addition 
        // don't remove right-side spaces or carriage returns   
        $add = $_REQUEST['a'];    
        // remove double and single quotes 
        //$add = str_replace("\"", "", $add);    
        //$add = str_replace("'", "", $add);    
            
        // filename and absolute path    
        $fn = $d . "/" . $d . ".apm";    
        // open file in write or append mode    
        if ( !file_exists($fn)) {    
                $handle = fopen ($fn, 'w');     
        } else {    
                $handle = fopen ($fn, 'a');     
        }            

        if (strtolower($add)=="solve") {    
                //$solve = "! Solve command issued";
                //fwrite ($handle, "\n".$solve);    
                fclose($handle);    

                // solve    
                chdir($d);
                $solve = 'apm.exe ' . $d;    
                echo $solve . ' <br>';
	        while (@ ob_end_flush()); // end all output buffers (if any)
                $proc = popen($solve, 'r');
                echo "<pre>";    
                while (!feof($proc))
		{
		  echo fread($proc, 4096);
                  @ flush();
	        }
                //echo passthru("$solve");    
                echo "</pre>";    
        } elseif (strtolower($add)=="clear all") {    
                // close apm file    
                fclose($handle);
                // recursively remove directory, don't save zip file    
                rrmdir ($path);
                echo "Cleared application";    
        } elseif (strtolower($add)=="clear apm") {    
                // close apm file (may have been append mode)    
                fclose($handle);    
                // clear file contents by opening in write mode    
                $handle = fopen ($fn, 'w');     
                $clear = "! Cleared file contents";
                fwrite ($handle, "\n".$clear);    
                fclose($handle);    
                echo "Cleared APM file";    
        } elseif (strtolower($add)=="clear csv") {    
                // clear file contents by opening in write mode    
                $fn_csv = $d . "/" . $d . ".csv";  
                $csv_file = fopen ($fn_csv, 'w');     
                // write a space to the file to clear contents  
                fwrite ($csv_file, " ");  
                fclose ($csv_file);  
                  
                //$clear = "! Cleared CSV file contents";    
                //fwrite ($handle, "\n".$clear);    
                fclose($handle);    
                echo "Cleared CSV file";
        } elseif  (strtolower($add)=="clear meas") {    
                // clear file contents by opening in write mode    
                $fn_csv = $d . "/measurements.dbs";  
                $meas_file = fopen ($fn_csv, 'w');     
                // write a space to the file to clear contents  
                fwrite ($meas_file, " ");  
                fclose ($meas_file);  
                  
                //$clear = "! Cleared measurements.dbs file contents";    
                //fwrite ($handle, "\n".$clear);    
                fclose($handle);    
                echo "Cleared measurements.dbs file";    
        } elseif (strtolower(substr($add, 0, 7))=="option ") {    
                $option = trim(substr($add,7)); // starting at 7th position - extract option    
                $fn_opt = $d . "/overrides.dbs";    
                if ( !file_exists($fn_opt)) {    
                    $overrides = fopen ($fn_opt, 'w');     
                } else {    
                    $overrides = fopen ($fn_opt, 'a');     
                }            
                fwrite ($overrides, "\n".$option);    
                fclose($overrides);    
                echo "Successfully added option: " . $option;    
                fclose($handle);    
        } elseif (strtolower(substr($add, 0, 5))=="meas ") {    
                $option = trim(substr($add,5)); // starting at 5th position - extract option    
                $fn_opt = $d . "/measurements.dbs";    
                if ( !file_exists($fn_opt)) {    
                    $meas = fopen ($fn_opt, 'w');     
                } else {    
                    $meas = fopen ($fn_opt, 'a');     
                }            
                fwrite ($meas, "\n".$option);    
                fclose($meas);    
                echo "Successfully added meas: " . $meas;    
                fclose($handle);    
        } elseif (strtolower(substr($add, 0, 5))=="info ") {    
                $info = trim(substr($add,5)); // starting at 5th position - extract info file addition    
                $fn_info = $d . "/" . $d . ".info";    
                if ( !file_exists($fn_info)) {    
                    $info_file = fopen ($fn_info, 'w');     
                } else {    
                    $info_file = fopen ($fn_info, 'a');     
                }            
                fwrite ($info_file, "\n".$info);    
                fclose($info_file);    
                echo "Successfully added variable classification: " . $info;    

                // Log addition to APM file    
                //$opt_log = "! Added variable classification $info";    
                //fwrite ($handle, "\n".$opt_log);    
                fclose($handle);   
        } elseif (strtolower(substr($add, 0, 6))=="ss.t0 ") {    
                $ss_t0 = substr($add,6); // extract ss.t0 file addition    
                $fn_ss_t0 = $d . "/" . "ss.t0";  
                if ( !file_exists($fn_ss_t0)) {    
                    $ss_t0_file = fopen ($fn_ss_t0, 'w');     
                } else {    
                    $ss_t0_file = fopen ($fn_ss_t0, 'a');     
                }            
                fwrite ($ss_t0_file, "\n" . $ss_t0);    
                fclose($ss_t0_file);    
                echo "Successfully added variable classification: " . $ss_t0;    

                // Log addition to APM file    
                //$opt_log = "! Added steady state value $ss_t0";    
                //fwrite ($handle, "\n".$opt_log);    
                fclose($handle);   
        } elseif (strtolower(substr($add, 0, 5))=="csva ") {    
                $csv = substr($add,5); // starting at 6th position - extract csv file addition    
                $fn_csv = $d . "/" . $d . ".csv";    
                if ( !file_exists($fn_csv)) {    
                    $csv_file = fopen ($fn_csv, 'w');     
                } else {    
                    $csv_file = fopen ($fn_csv, 'a');     
                }            
                fwrite ($csv_file, $csv);    
                fclose($csv_file);    

                // Return status    
                echo "Successfully added data to CSV file";    
                // don't log data flow to APM file   
                fclose($handle);  
        } elseif (strtolower(substr($add, 0, 4))=="csv ") {    
	        $csv = rtrim(substr($add,4)); // starting at 5th position - extract 'csv ' file addition    
                $fn_csv = $d . "/" . $d . ".csv";    
                if ( !file_exists($fn_csv)) {    
                    $csv_file = fopen ($fn_csv, 'w');     
                } else {    
                    $csv_file = fopen ($fn_csv, 'a');     
                }            
                fwrite ($csv_file, $csv."\n");    
                fclose($csv_file);    

                // Return status    
                echo "Successfully added data to CSV file: " . $csv;    
                // don't log data flow to APM file   
                fclose($handle);  
        } elseif (strtolower(substr($add, 0, 4))=="apm ") {    
                // write line to apm file without line return 
                $apm = substr($add,4); // starting at 5th position - extract 'apm ' file addition  
                fwrite ($handle, $apm);    
                fclose($handle);    
                echo "Successfully added to APM file"; 
        } else {    
                // write line to apm file with line return 
                fwrite ($handle, "\n".$add);    
                fclose($handle);    
                echo "Successfully added line: " . $add;    
        }    

?>
