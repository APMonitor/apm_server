<?php   
        $ip = $_SERVER["REMOTE_ADDR"];

        // control number of lines in measurements.dbs
        // measurements.dbs will be processed and erased every cycle
        $maxlines = 100000;
        $n_max = 50;
        $v_max = 50;
        
        /* Get name and value */
        // directory name (optional)
        $d = $_REQUEST["d"];
        $d = trim(stripslashes(htmlspecialchars($d)));

        if ($d=="") {
                // optional application name
                $p = $_REQUEST["p"];
                if ($p=="") {
                    $d = $ip;
                } else {
                    $p = trim(stripslashes(htmlspecialchars($p)));
                    $d = $ip . "_" . $p;
                }
                
                $root = $_SERVER{'DOCUMENT_ROOT'};
                // see if IP address directory exists, if not create new
                if( !file_exists( $root . "/online/$d"))  { 
                        mkdir ($root . "/online/$d", 0777);
                }
        }
        // specify filename
        $fn = $d."/measurements.dbs";

        $n = $_REQUEST["n"];
        $n = trim(stripslashes(htmlspecialchars($n)));

        $v = $_REQUEST["v"];
        $v = str_replace("+", "", $v);
        $v = str_replace(" ", "", $v);
        $v = trim(stripslashes(htmlspecialchars($v)));

        if ($n != "" && $v != "")  {
                if (strlen($n) > $n_max) { die(); }
                if (strlen($v) > $v_max) { die(); }
                                
                $handle = fopen ($fn, 'r'); 
                $filetext = fread($handle, filesize($fn)); fclose($handle);
                
                $arr1 = explode("\n", $filetext);

                if (count($arr1) > $maxlines) {
                        /* Pruning */
                        $arr1 = array_reverse($arr1);
                        for ($i=0; $i<$maxlines; $i++) { $arr2[$i] = $arr1[$i]; }
                        $arr2 = array_reverse($arr2);                   
                } else {
                        $arr2 = $arr1;
                }
                
                $filetext = implode("\n", $arr2);
                 
                $out = $filetext . $n . " = " . $v . ", 1, none\n";
                //$out = str_replace("\\\"", "\"", $out);
                
                $handle = fopen ($fn, 'w'); fwrite ($handle, $out); fclose($handle);
                // write tag file
                $tag = $d."/".strtolower($n);
                $handle = fopen ($tag, 'w'); fwrite ($handle, $v); fclose($handle);                

                echo "Successfully recorded: " . $n . ' = ' . $v;
        }
?>
