<html>
<head>
<title>DBS File Overrides</title>
</head>
<body>
<font face='Arial' size=2>

<?php 

$dir = $_REQUEST['d'];
$name = $_REQUEST['n'];
$old_value = $_REQUEST['v'];
$value = $_REQUEST['nv'];

// check for add or remove
$action = 'remove';
if (isset($value)) {
  if (trim($value)!='') {
    $action = 'add';
  }
}

$dbs = "overrides.dbs";
chdir($dir);

// eliminate from overrides.dbs
$lines = file($dbs); 
if (count($lines) > 0) {
  $fh = fopen($dbs, 'w');
  foreach($lines as $entry)
  {
    $part = explode("=",$entry);
    if (trim(strtolower($part[0]))!=strtolower($name)) {
      fwrite($fh, $entry);
    }
  }
  fclose($fh);
}

// add to overrides.dbs
if ($action=='add') {
  echo "<br>Overrides.dbs: Change <b>" . $name . "</b> from <b>" . $old_value . "</b> to <b>" . $value . "</b>";
  $fh = fopen($dbs, 'a') or fopen($dbs, 'w');
  $new_line = "  " . $name . " = " . $value . "\n";
  fwrite($fh, $new_line);
  fclose($fh);
} else {
  echo "<br>Eliminate <b>" . $name . "</b> from <b>" . $dbs . "</b>";
}

// show contents of new dbs file
echo "<br>";
echo "<hr>";
echo "New Overrides File";
echo "<font size=3>";
echo "<br>";
echo "<pre>";
echo "<br>";
include($dbs);
echo "</pre>";
echo "</font>";

?>

</font>
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