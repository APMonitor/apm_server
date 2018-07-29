<?php   
        $ip = $_SERVER["REMOTE_ADDR"];

        // tag name
        $n = $_REQUEST["n"];
        $n = trim(strtolower(stripslashes(htmlspecialchars($n))));

        // directory name
        $d = $_REQUEST["d"];
        if ($d=="") {
                // application name
                $p = $_REQUEST["p"];
            if (isset($p)) {
           $p = trim(stripslashes(htmlspecialchars($p)));
           $d = $ip . "_" . $p;
        } else {
          $d = $ip;
        }
        } else {
                $d = trim(stripslashes(htmlspecialchars($d)));
        }

        // file name
        $f = $d . "/" . $n;
        if (file_exists($f)) {
           include($f);
    } else {

       // look for value in overrides.dbs file
       $dbs = $d . "/overrides.dbs";
       if (file_exists ($dbs)) {
         if (($h = fopen($dbs,"r")) !== FALSE) {
           while (($line = fgetcsv($h, 1000, ",")) !== FALSE) {
                 $first = strtolower($line[0]);
             $parts = explode("=",$first);
                 if (strtolower(trim($parts[0]))==trim($n)) {
               echo trim($parts[1]);
                   fclose($h);
                   exit();
                 }
               }
               fclose($h);
         }
       }

       // look for value in measurements.dbs file
       $dbs = $d . "/measurements.dbs";
       if (file_exists ($dbs)) {
         if (($h = fopen($dbs,"r")) !== FALSE) {
           while (($line = fgetcsv($h, 1000, ",")) !== FALSE) {
                 $first = strtolower($line[0]);
             $parts = explode("=",$first);
                 if (strtolower(trim($parts[0]))==trim($n)) {
               echo trim($parts[1]);
                   fclose($h);
                   exit();
                 }
               }
               fclose($h);
         }
       }

       // look for value in DBS file
       $dbs = $d . "/" . $d . ".dbs";
       if (($h = fopen($dbs,"r")) !== FALSE) {
         while (($line = fgetcsv($h, 1000, ",")) !== FALSE) {
               $first = strtolower($line[0]);
           $parts = explode("=",$first);
               if (strtolower(trim($parts[0]))==trim($n)) {
             echo trim($parts[1]);
                 fclose($h);
                 exit();
               }
             }
             fclose($h);
       }

           // didn't find a value
       echo "-999999";
    }
?>
