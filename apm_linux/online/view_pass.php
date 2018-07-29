<?php 
$ip = $_SERVER['REMOTE_ADDR'];

// check for access to ../ or ..\ in directory or file name
$check = '..';

$banned = array("24.38.42.231", "217.172.180.18");
if (in_array($ip, $banned)) {
   die('Your IP address ' . $ip . ' has been blocked due to unauthorized access');
}

$dir = $_REQUEST['d']; 
$file = $_REQUEST['f']; 
$opt1 = $_REQUEST['view']; 
$opt2 = $_REQUEST['edit']; 
$include_path = $dir . "/" . $file; 

$d_set = isset($dir); 
$f_set = isset($file); 

if (!$d_set or !$f_set) { 
  $demo = True;
  $num = rand(10, 99); 
  $include_path = 'web/hs0'.$num.'.apm'; 
} else {
  $demo = False;
}

if (!$d_set) { 
   $dir = '1Demo' . $ip . '_' . rand(1,999999999); 
   $opt2 = 'edit'; 
   if ($f_set) { 
      $include_path = "web/" . $file; 
      if ((strpos($include_path, $check)!==false)) {
         die('Unauthorized File Access<br>From IP Address ' . $ip);
      }
   } 
   $file = $dir . '.apm'; 
} 

// use === or !== for comparison operators for strpos because it can
//   return either an integer or a boolean
if ((strpos($dir, $check)!==false) or (strpos($file, $check)!==false)) {
   die('Unauthorized File Access');
}

$path = $dir . "/" . $file; 
?> 

 <html> 

 <style type="text/css"> 
 body             { padding-left:5px; background:#FFFFFF; font-family:arial;}
 input, textarea  { font-family:courier new; color:black; background:white; font-size: 12px; }
 #content         { font-size:12px; width:100%; text-align:left; margin-left:20px; }
  
 #mytext          { border:1px solid #aaaaaa; padding:4px; background:white; color:black;  width:100%; font-family:courier new;}
 #mytext2         { border: none; border-bottom:1px solid #aaaaaa; padding:4px; background:#DDDDDD;}
  
 #info            { text-align:left; padding-left:0px; font-family:arial; }
 #info td         { font-size:12px; padding-right:10px; color:#FFFFFF;  }
 #info .small     { font-size:12px; padding-left:10px; padding-right:0px;}
 #info .reg       { font-size:12px; padding-left:10px; padding-right:0px;}
  
 #info a          { text-decoration:none; color:white; }
 #info a:hover    { text-decoration:underline; color:#CF9700;}
 </style>
   
 <script type="text/javascript">  
 <!-- 

 function jsolve() 
 { 
 var url = '/cgi-bin/solve.py';
 var rand = encodeURIComponent(parseInt(Math.random()*99999999)); 
 var content = encodeURIComponent(document.getElementById('model').value);
 var imode   = encodeURIComponent(document.getElementById('imode').value);
 var solver  = encodeURIComponent(document.getElementById('solver').value);
 var parameters = "content="+content+"&solver="+solver+"&imode="+imode;

 var xmlHttp; 

 //alert(parameters);
  
 // Firefox, Opera 8.0+, Safari, IE7.0+ 
 try { xmlHttp=new XMLHttpRequest(); 
     } 
 catch (e) 
   // Older Internet Explorer 
   { try { xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); 
         } 
   catch (e) 
     { try { xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); 
           } 
     catch (e) 
       { alert("This browser does not support XMLHttpRequest."); 
       return false; 
       } 
     } 
   } 
   xmlHttp.onreadystatechange=function() 
     { 
     if(xmlHttp.readyState<=3)
       {
         document.getElementById('sbox').innerHTML= '<img src="busy16.gif">';
       }
     if(xmlHttp.readyState==4) 
       { 
	 document.getElementById('sbox').innerHTML=xmlHttp.responseText; 
       } 
     } 
   xmlHttp.open("POST",url,true); 
   xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xmlHttp.send(parameters); 
   } 
 //--> 
 </script>  
  
  
 <script type="text/javascript"> 
 <!-- 
   function menu(item,image) 
     { 
     var f = document.getElementById(item); 
  
     f.src = image; 
     } 

   function toggle_visibility(item) 
     { 
     var f = document.getElementById(item); 

     f.style.visibility = "visible"; 

     //if (f.style.visibility == "visible") 
     //  f.style.visibility == "hidden"; 
     //else 
     //  f.style.visibility == "visible"; 
     } 
 //--> 
 </script> 


 <script type="text/javascript"> 
 <!-- 
 function popup(mylink, windowname) 
 { 
 if (! window.focus)return true; 
 var href; 
 if (typeof(mylink) == "string") 
   href=mylink; 
 else 
   href=mylink.href; 
   window.open(href,windowname,"height=800,width=100%,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes"); 
   return false; 
 } 
 //--> 

 <!-- 
 function popup_print(mylink, windowname) 
 { 
 if (! window.focus)return true; 
 var href; 
 if (typeof(mylink) == "string") 
   href=mylink; 
 else 
   href=mylink.href; 
   window.open(href,windowname,"height=800,width=100%,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes"); 
   return false; 
 } 
 //--> 
 </script> 

 <script type="text/javascript">  

 <!--myField accepts an object reference, myValue accepts the text string to insert at the cursor  

 function insertatcursor(myField, myValue) {  
 if (document.selection) {  
 myField.focus();  
 sel = document.selection.createRange();  
 sel.text = myValue;  
 }  

 else if (myField.selectionStart == 0 || myField.selectionStart == '0') {  
 var startPos = myField.selectionStart;  
 var endPos = myField.selectionEnd;  
 myField.value = myField.value.substring(0, startPos)+ myValue+ myField.value.substring(endPos, myField.value.length);  
 }  
 else {  
 myField.value += myValue;  
 }  
 }  
 //--> 
 </script>  

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.tae.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("textarea").inputexpander();
	});
</script>
  
 <head> 
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php 
echo "<title>APMonitor Online Optimization</title>"; 
?> 

 </head> 
 <body>
 <?php include_once('../analytics.php') ?> 

<?php 

function findexts ($filename)  
{  
$filename = strtolower($filename) ;  
$exts = split("[/\\.]", $filename) ;  
$n = count($exts)-1;  
$exts = $exts[$n];  
return $exts;  
}  


if (isset($opt1)) { 
  $action = 'view'; 

  echo "<br>"; 
  echo "<font face='Arial' size=2>"; 
  echo "<table align='center' width='90%' border='0' cellspacing='0'>"; 
  echo "<tr><td align='left'>"; 
  echo "<pre>"; 
  echo "<span style='color: blue;'>A</span><span  style='color: red;'>P</span><span  style='color: black;'>Monitor Document</span>"; 
  echo '<img id="print_button" src="/icon/print_out.png" onClick="JavaScript:window.print();" onmouseover="menu(' . "'print_button','/icon/print_over.png')" . '" onmouseout="menu(' . "'print_button','/icon/print_out.png'" . ')">'; 
  echo '<img src="/icon/break.png">'; 
  echo '<img id="close_button" src="/icon/close_out.png" onClick="history.back()" onmouseover="menu(' . "'close_button','/icon/close_over.png')" . '" onmouseout="menu(' . "'close_button','/icon/close_out.png'" . ')">'; 
  echo "</pre>"; 
  echo "</td><td align='right'>"; 
  echo "<pre>"; 
  echo date('l jS \of F Y h:i:s A'); 
  echo "</pre>"; 
  echo "</td></tr>"; 
  echo "</table>"; 
  echo "<hr width='90%'>"; 
  echo "<table align='center' width='90%' border='0' cellspacing='0' bordercolor='#AAAAAA'>"; 
  echo "<tr bgcolor='#EEEEEE'>"; 
  echo "<td>"; 

  echo "<pre>"; 
  echo "<a href=$path><b>" . $file . "</b></a><img src='download25.jpg'>"; 
  echo "<br>"; 
  echo "Directory: <b>" . $dir . "</b>"; 
  echo "</pre>"; 

  echo "</td>"; 
  echo "</tr>"; 
  echo "<tr>"; 
  echo "<td>"; 
  echo "<hr>"; 
  echo "<pre>"; 
  include($path); 
  echo "</pre>"; 
  echo "<hr>"; 
  echo "</td>"; 
  echo "</tr>"; 
  echo "</table>"; 
  echo "</font>"; 

  echo "</body>"; 
   
} else if (isset($opt2)) { 
  $action = 'edit'; 

  echo "<table align='center' width='90%' border='0' cellspacing='0' bordercolor='#AAAAAA'>"; 
  echo "<tr bgcolor='#FFFFFF'>"; 
  echo "<td>"; 
   
  echo "<table style='background-color: #fff; padding: 0px;' cellspacing=0><tr><td>";
  echo "<a href='http://apmonitor.com'><img src='apm_learn_50.png'></a></td><td nowrap>"; 
  echo "<b><span style='color: blue;'>A</span><span  style='color: red;'>P</span><span  style='color: black;'>Monitor Modeling Language</span></b>  ";
  echo "<a href='http://apmonitor.com/wiki'><img src='apm_wiki_50.png'></a>  <a href='http://apmonitor.com/wiki/index.php/Main/ApplicationWebinars'><img src='apm_users_50.png'></a>  <a href='http://apmonitor.com/me575'><img src='apm_learn_50.png'></a>  <a href='https://www.youtube.com/user/APMonitorCom'><img src='apm_youtube_50.png'></a>"; 
  echo "</td><td>";
  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  echo "</td></tr></table>"; 
  echo ""; 
  echo ""; 
   
  echo "</td></tr>"; 
  echo "<tr><td>"; 

  echo "<form name='myInput' onsubmit='javascript:return false'>";  // action='/cgi-bin/solve.py' target'sbox' method='post'> ";

  echo '<span title="Load New Problem">'; 
  echo '<input style="vertical-align:bottom;margin:0px;padding:0px;" type="image" name="Load" id="load_button" onClick="window.location.reload()" src="/icon/new_out.png" onmouseover="menu(' . "'load_button','/icon/new_over.png')" . '" onmouseout="menu(' . "'load_button','/icon/new_out.png'" . ')">'; 
  echo '</span>'; 

  echo '<span title="Download Benchmark Problems">'; 
  echo '<input style="vertical-align:bottom;margin:0px;padding:0px;" type="image" name="Save" id="save_button" onClick="window.location.href=' . "'../download/solver_benchmarks.zip'" . '" src="/icon/save_out.png" onmouseover="menu(' . "'save_button','/icon/save_over.png')" . '" onmouseout="menu(' . "'save_button','/icon/save_out.png'" . ')">'; 
  echo '</span>'; 

  echo '<img style="vertical-align:bottom;margin:0px;padding:0px;" src="/icon/break.png">'; 

  echo '<span title="Select Solver">'; 
  echo "<select style='vertical-align:bottom;border-width:2px;border-style:solid;border-color:#8888FF;margin:0px;padding:0px;' name='solver' id='solver'>"; 
  echo "<optgroup label='Active Set'>";
  echo "<option selected value='1'>APOPT</option>";
  if (!$demo) {
  echo "<option value='5'>MINOS</option>";
  echo "<option value='4'>SNOPT</option>";
  }
  echo "</optgroup>";
  echo "<optgroup label='Interior Point'>";
  echo " <option value='2'>BPOPT</option>";
  echo " <option value='3'>IPOPT</option>";
  echo "</optgroup>";
  echo "<optgroup label='Benchmark'>";
  echo "<option value='0'>Try All</option>";
  echo "</optgroup>";
  echo "</select>";
  echo "</span>";
   
  echo '<span title="Select Solution Mode">'; 
  echo "<select style='vertical-align:bottom;border-width:2px;border-style:solid;border-color:#8888FF;margin:0px;padding:0px;' name='imode' id='imode'>"; 
  echo "<optgroup label='Steady State'>";
  echo " <option value='1'>Simulate</option>";
  echo " <option value='2'>Estimate</option>";
  echo " <option selected value='3'>Optimize</option>";
  echo "</optgroup>";
  echo "<optgroup label='Dynamic'>";
  echo "<option value='4'>Simulate</option>";
  echo "<option value='5'>Estimate</option>";
  echo "<option value='6'>Optimize</option>";
  echo "</optgroup>";
  echo "<optgroup label='Sequential'>";
  echo "<option value='7'>Simulate</option>";
  echo "</optgroup>";
  echo "</select>";
  echo "</span>";

  echo '<span title="Solve Optimization Problem">'; 
  echo '<input style="vertical-align:bottom;margin:0px;padding:0px;" type="image" name="Run" id="run_button" onclick="jsolve()" src="/icon/run_out.png" onmouseover="menu(' . "'run_button','/icon/run_over.png')" . '" onmouseout="menu(' . "'run_button','/icon/run_out.png'" . ')">'; 
  echo '</span>'; 

  echo '<img style="vertical-align:bottom;margin:0px;padding:0px;" src="/icon/break.png">'; 

  echo '<span title="View Solution">'; 
  echo '<a href="#sbox"><img style="vertical-align:bottom;margin:0px;padding:0px;" id="results_button" src="/icon/results_out.png" onmouseover="menu(' . "'results_button','/icon/results_over.png')" . '" onmouseout="menu(' . "'results_button','/icon/results_out.png'" . ')"></a>'; 
  echo '</span>'; 

  echo '<img style="vertical-align:bottom;margin:0px;padding:0px;" src="/icon/break.png">'; 

  echo '<span title="Print Document">'; 
  echo '<a href="/online/view_pass.php?d=' . $dir . '&f=' . $file . '&view=yes"><img style="vertical-align:bottom;margin:0px;padding:0px;" id="print_button" src="/icon/print_out.png" onmouseover="menu(' . "'print_button','/icon/print_over.png')" . '" onmouseout="menu(' . "'print_button','/icon/print_out.png'" . ')"></a>'; 
  echo '</span>'; 

  echo '<img style="vertical-align:bottom;margin:0px;padding:0px;" src="/icon/break.png">'; 

  echo '<span title="Documentation">'; 
  echo '<a href="/wiki"><img style="vertical-align:bottom;margin:0px;padding:0px;" id="help_button" src="/icon/help_out.png" onmouseover="menu(' . "'help_button','/icon/help_over.png')" . '" onmouseout="menu(' . "'help_button','/icon/help_out.png'" . ')"></a>'; 
  echo '</span>'; 

  echo '<img style="vertical-align:bottom;margin:0px;padding:0px;" src="/icon/blank.png">'; 

  //echo '<img style="vertical-align:bottom;margin:0px;padding:0px;" src="/icon/blank.png">'; 
  //echo '<img style="vertical-align:bottom;margin:0px;padding:0px;" src="/icon/blank.png">'; 
  //echo '<img style="vertical-align:bottom;margin:0px;padding:0px;" src="/icon/blank.png">'; 
  //echo '<img style="vertical-align:bottom;margin:0px;padding:0px;" src="/icon/blank.png">'; 
  //echo '<img style="vertical-align:bottom;margin:0px;padding:0px;" src="/icon/blank.png">'; 

  echo '<span title="Close File without Saving">'; 
  echo '<img style="vertical-align:bottom;margin:0px;padding:0px;" id="close_button" src="/icon/close_out.png" onClick="history.back()" onmouseover="menu(' . "'close_button','/icon/close_over.png')" . '" onmouseout="menu(' . "'close_button','/icon/close_out.png'" . ')">'; 
  echo '</span>'; 

  echo "<br>"; 

  //$ext = findexts($file); 
  //if ($ext=='apm') { 
  //echo '<img id="paste_button" src="/icon/paste_out.png" onmouseover="menu(' . "'paste_button','/icon/paste_over.png')" . '" onmouseout="menu(' . "'paste_button','/icon/paste_out.png'" . ')">'; 
  //echo '<button onclick="'."insertatcursor(document.getElementById('mytext'),'Objects\\n\\nEnd Objects\\n\\n')".'">Objects</button>'; 
  //echo '<button onclick="'."insertatcursor(document.getElementById('mytext'),'Compounds\\n\\nEnd Compounds\\n\\n')".'">Compounds</button>'; 
  //echo '<button onclick="'."insertatcursor(document.getElementById('mytext'),'Connections\\n\\nEnd Connections\\n\\n')".'">Connections</button>'; 
  //echo '<button onclick="'."insertatcursor(document.getElementById('mytext'),'Model my_model\\n\\nEnd Model\\n\\n')".'">Model</button>'; 
  //echo '<button onclick="'."insertatcursor(document.getElementById('mytext'),'  Parameters\\n    my_parameter = default, < upper, > lower\\n  End Parameters\\n\\n')".'">Parameters</button>'; 
  //echo '<button onclick="'."insertatcursor(document.getElementById('mytext'),'  Variables\\n    my_variable = default, < upper, > lower\\n  End Variables\\n\\n')".'">Variables</button>'; 
  //echo '<button onclick="'."insertatcursor(document.getElementById('mytext'),'  Intermediates\\n    my_intermediate = my_parameter + my_variable, < upper, > lower\\n  End Intermediates\\n\\n')".'">Intermediates</button>'; 
  //echo '<button onclick="'."insertatcursor(document.getElementById('mytext'),'  Equations\\n    my_variable = my_parameter\\n  End Equations\\n\\n')".'">Equations</button>'; 
  //} 

  echo "<textarea id='model' name='content' class='tae' style='border:1px solid #aaaaaa; height:300px; min-height:300px; width:100%; overflow-x: hidden; overflow-y: hidden; font-family:courier new;'>"; 
  include($include_path); 
  echo "</textarea><br>"; 
  echo "<input type='hidden' name='d' value='" . $dir . "' />"; 
  echo "<input type='hidden' name='f' value='" . $file . "' />"; 
  // code to stop link spammers
  $code = date("dYm");
  echo "<input type='hidden' name='code' value='" . $code . "' />"; 
  echo "</form>"; 

  echo "</td></tr>"; 
  echo "</table>"; 
   

  echo "<table align='center' width='90%' border='0' cellspacing='0'>"; 
  echo "<tr><td>";
  echo "<pre><div width='90%' id='sbox'>";

  echo "<h3>Results section</h3>";
  echo "<b><span style='color: blue;'>A</span><span  style='color: red;'>P</span><span  style='color: black;'>Monitor Modeling Language</span></b>";
  echo "<br>";
  echo "<b>Step 1:</b> Click the arrow <img src='/icon/run_over.png'> in the menu bar above to solve.<br><br>";
  echo "<b>Step 2:</b> View the solver output in this area.<br>";
  echo "<b>Step 3:</b> Once the solution is complete, results are accessible through the table <img src='table25.jpg'> icon.<br>";
  echo "<a href=http://apmonitor.com/wiki/index.php/Main/TermsConditions>Terms and Conditions</a>"; 
  echo "</div></pre>";
  echo "</td></tr>";  
  echo "</table>"; 
} 

?> 

 </body> 
 </html> 
