<?php
  $dir = $_REQUEST['d'];
  $file = $_REQUEST['f'];
  $path = $dir . "/" . $file;
?>

<HTML>
<HEAD>
<Title>APMonitor Chart</Title>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">

</HEAD>

<BODY bgcolor="#FFFFFF">

<!--For Internet Explorer -->
<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
	codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" 
	WIDTH="525" 
	HEIGHT="250" 
        SCALE="NOSCALE" 
        ALLOWFULLSCREEN="TRUE"
	QUALITY="HIGH"
	ID="CHARTS" 
	ALIGN="LEFT">
<?php
  echo "<PARAM NAME=movie VALUE='../charts5/charts.swf?license=F1OZF6MEF2BA8F76D5J6.FNAH2VORK&library_path=../charts5/charts_library&xml_source=$path'>\r";
?>
<PARAM NAME=quality VALUE=high>
<PARAM NAME=bgcolor VALUE=#FFFFFF>

<!--For Firefox -->
<?php
  echo "<EMBED src=../charts5/charts.swf?library_path=../charts5/charts_library&license=F1OZF6MEF2BA8F76D5J6.FNAH2VORK&xml_source=$path\r";
?>
       ALIGN="LEFT"
       QUALITY="HIGH" 
       ALLOWFULLSCREEN="TRUE"
       BGCOLOR="#ffffff"  
       WIDTH="525"
       SCALE="NOSCALE"
       HEIGHT="250" 
       NAME="charts" 
       swLiveConnect="true" 
       TYPE="application/x-shockwave-flash" 
       PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">
</EMBED>
</OBJECT>

</BODY>
</HTML>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-494092-1");
pageTracker._trackPageview();
} catch(err) {}</script>
