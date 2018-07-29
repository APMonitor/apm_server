<?php   
        $ip = $_SERVER["REMOTE_ADDR"];

        // control number of lines in measurements.dbs
        // measurements.dbs will be processed and erased every cycle
        $maxlines = 100000;
        $n_max = 50;
        $v_max = 50;
        
        /* IP's to block */
        $blockip[] = "72.60.167.89";
        
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

                // test for blocked IP addresses
                foreach ($blockip as $a) {
                        if ($ip == $a) { die(); }
                }
                                
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
                //$play_sound = "START/min mplay32 /play /close %windir%\media\ding.wav";
                //passthru($play_sound);
                
                // write tag file
                $tag = $d."/".strtolower($n);
                $handle = fopen ($tag, 'w'); fwrite ($handle, $v); fclose($handle);                

                echo "Successfully recorded: " . $n . ' = ' . $v;
        }

        // pass values to another computer - will pause script if other computer is down
        //if ($d == "bass_lite")  {
        //        $forward = 'c:\apache\wget\wget.exe --tries=1 --delete-after --spider "http://69.15.156.61/online/meas.php?d=bass_lite&n=' . $n . '&v=' . $v . '"';
        //        passthru($forward);
        //}
?>
