<?php
$dir = $_REQUEST['d'];

$d_set = isset($dir);

$root = $_SERVER{'DOCUMENT_ROOT'};

if (!$d_set) {
  exit();
}
  
?>

 <html>
 
 <head>
 <title>Select trend to display</title>
 </head>
 <body>

<?php

function findexts ($filename) 
{ 
$filename = strtolower($filename) ; 
$exts = split("[/\\.]", $filename) ; 
$n = count($exts)-1; 
$exts = $exts[$n]; 
return $exts; 
} 

echo "<table align='top' width='50%' height='100%' border='0' cellspacing='0' bordercolor='#AAAAAA'>";

echo "<tr><td valign='top' height='100%'>";
// New file
  
echo "<form id='select_plot' style='margin:0px;padding:0px;' target='plot_top' action='plot.php' method='get'>";
//Looks into the directory and returns the files, no subdirectories

echo "<select name='f'>";
//The path to the style directory
$dirpath = "$root/online/$dir";
if (file_exists($dirpath)) {
  $dh = opendir($dirpath);
  while (false !== ($file = readdir($dh))) {
    //List model files only
    preg_match("/\.([^\.]+)$/", $file, $matches);
    $ext = $matches[1];
    if (!is_dir("$dirpath/$file") and ($ext=='xml')) {
      //Translate to html characters
      echo "<option value='$file'>" . htmlspecialchars($file) . '</option>';
    }
  }
  closedir($dh);
}
//Close Select
echo "</select>";
echo "<input type='hidden' name='d' value='" . $dir . "' />";
echo "<input type='submit' value='Select' name='load' tabindex='1' />";


echo "</form>";

echo "</td></tr>";
echo "</table>";

?>

 </body>
 </html>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-494092-1");
pageTracker._trackPageview();
} catch(err) {}</script>