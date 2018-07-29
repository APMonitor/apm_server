<html>
<head>
<title>Info File Edit</title>
</head>
<body>
<font face='Arial' size=2>

<?php 

$dir = $_REQUEST['d'];
$name = $_REQUEST['n'];
$value = $_REQUEST['v'];

if (isset($value)) {
  $action = 'add';
} else {
  $action = 'remove';
}

$info = $dir . ".info";
chdir($dir);

if ($action=='add') {
  echo "<br>Add <b>" . $name . "</b> as <b>" . $value . "</b> to <b>" . $info . "</b>";
  $fh = fopen($info, 'a') or fopen($info, 'w');
  $new_line = $value . ", " . $name . "\n";
  fwrite($fh, $new_line);
  fclose($fh);
} else {
  echo "<br>Eliminate <b>" . $name . "</b> from <b>" . $info . "</b>";
  $lines = file($info); 
  if (count($lines) > 0) {
    $fh = fopen($info, 'w');
    foreach($lines as $entry)
    {
      $part = explode(",",$entry);
      if (strtolower(trim($part[1]))!=$name) {
        fwrite($fh, $entry);
      }
    }
    fclose($fh);
  }
}

// show contents of new info file
echo "<br>";
echo "<hr>";
echo "New Info File";
echo "<font size=3>";
echo "<br>";
echo "<pre>";
echo "<br>";
include($info);
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