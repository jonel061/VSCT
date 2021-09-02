<html>
<head>
	<title>= Caesar Cipher</title>
</head>
<body>
<?php  

 $namefile = "encrypted.txt";  
 $isi      = trim($_POST['result']);  
 $file = fopen($namefile,"w");  
 fwrite($file,$isi);  
 fclose($file);  
 echo "<header>";
 echo "<h2>Result Encrypt Text</h2>";  
 echo "</header></br><br>";  
 echo "Result : <a href='$namefile'> Open (Encrypt Text)</a>";  
 ?>  
<p><a href="./download?path=../Public/encrypted.txt">Download (Encrypt Text)</a></p>
 </body>
 </html>