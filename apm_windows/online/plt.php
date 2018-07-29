<html>
<head>
<title>Plot Configuration</title>
</head>
<body>
<font face='Arial' size=2>

<?php 

$dir = $_REQUEST['d'];
$name = $_REQUEST['n'];

if (isset($name)) {
  $action = 'add';
} else {
  $action = 'new';
}

$plt = $dir . ".plt";
chdir($dir);

if ($action=='add') {
  echo "<br>Add <b>" . $name . "</b> to plot configuration <b>" . $plt . "</b>";
  $fh = fopen($plt, 'a') or fopen($plt, 'w');
  $new_line = $name . "\n";
  fwrite($fh, $new_line);
  fclose($fh);
} else {
  echo "<br>Add new trend to plot configuration <b>" . $plt . "</b>";
  $fh = fopen($plt, 'a') or fopen($plt, 'w');
  $new_line = "New Trend\n";
  fwrite($fh, $new_line);
  fclose($fh);
}

// show contents of new plt file
echo "<br>";
echo "<hr>";
echo "Modified Plot Configuration File";
echo "<font size=3>";
echo "<br>";
echo "<pre>";
echo "<br>";
include($plt);
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