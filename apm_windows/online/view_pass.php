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
$demo = False;

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

?> 

 </body> 
 </html> 
