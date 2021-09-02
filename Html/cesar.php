<?php


include "../Service/convert.php";

?>
<!DOCTYPE html PUBLIC
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!DOCTYPE html>
    <html lang="en">

    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> VSCT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="keywords">
    <meta content="" name="description">
        <title>AES in PHP test harness</title>
            <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">



    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <!-- Main Stylesheet File -->
    <link href="../css/style_vsct.css" rel="stylesheet">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




	<title>Criptografie : Caesar Cipher </title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
	<style type="text/css">
	a:link {color: #000000; text-decoration: none}
	a:visited {color: #000000; text-decoration: none}
	a:hover {color: #FF0000; text-decoration: underline}
	</style>
	<script type="text/javascript">
	function SelectAll(id){
		document.getElementById(id).focus();
		document.getElementById(id).select();
	}
	function InfoCaesar(){
		alert("Cheia este doar o combinație de numere, cifrul Caesar implicit folosește cheia: 3, „+ '\ n' +”, iar textul planului nu poate conține numere!");
	}
	</script>

<header id="header">
    <div class="container">



        <nav align='right'>

            <ul class="nav-menu">
                <div class="topleft"> <img src="../Img/Logo.png" align='left' class="resposive" width="350" height="350">
                </div>


                <button align='right'> 🞬 </button>
                <li class="menu-active"><a style="color:blue" href="http://localhost/Proiect_pw/Public/">Home</a></li>
                <li class="menu-active"><a style="color:blue" href="http://localhost/Proiect_pw/Public/Intrebari">Intrebari</a></li>
                <li class="menu-active"><a style="color:blue" href="http://localhost/Proiect_pw/Public/login">Admin</a></li>
                <li class="menu-has-children"><a style="color:blue" href="#Altgorithm">Algorithm</a>
                    <ul>
                        <li><a href="http://localhost/Proiect_pw/Public/Aes">AES</a></li>
                        <li>
                            <a href="http://localhost/Proiect_pw/Public/Caesar">Caesar</a>
                        </li>
                    </ul>
        
            </ul>
			    </nav>
    </div>

    <!-- #nav-menu-container -->
    </div>
    </div>
</header>
<script>
    /* only execute this script when the document is ready */
    $(document).ready(function() { /* function called when you click of the button */
        $("button").click(function() { /* this if else to change the text in the button */
            if ($("button").text() == "☰") {
                $("button").text("🞬");
            } else {
                $("button").text("☰");
            } /* this function toggle the visibility of our "li" elements */
            $("li").toggle("slow");
        });
    });
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").slideToggle("slow");
  });
});
$(document).ready(function(){
  $("#flip1").click(function(){
    $("#panel1").slideToggle("slow");
  });
});
</script>
<br><br><br><br><br>
    <body>

    <section id="intro">


<div class="intro-text">
    <p>Pe acestă pagină veți învăța despre algoritmul Caesar</p>
    <a href="#Teoria" class="btn-get-started scrollto">Să începem </a>
</div>
</section>


<style>
        p{
            display: inline-block;
            padding-left: 0;
            text-align: left;
        }
        #panel, #flip {
  padding: 5px;
  text-align: center;
  border: solid 1px #c3c3c3;
}

#panel {
  padding: 50px;
  display: none;
}
    </style>



<body>
<header>
	<h4><a onclick="Info()"></a></h4>
	</header>

   <section id="Teoria">
        <div class="w3-card-4" style="width:100%" id="flip">
            <header class="w3-container w3-light-grey">
                <H2 style="background: #07c5f8" align="center">Caesar Teoria</H2>
            </header>
            <div class="w3-container" style="background: white ; color:black"  id="panel">
			<p align='left'>Cifrul Cezar este unul dintre cele mai vechi si simple cifre
cunoscute.<br>
Este un tip de cifru bazat pe substituții în care fiecare literă din
textul initial este „deplasată” un anumit număr de locuri în jos,
avand in vedere alfabetul.<br>
De exemplu, cu o schimbare de 1, A ar fi înlocuit cu B, B ar deveni
C și așa mai departe. Metoda poartă numele lui Iulius Cezar, care
se pare că a folosit-o pentru a comunica cu generalii săi.<br>
Cifrul Cezar nu oferă în esență nicio securitate de comunicare și
se va arăta că poate fi ușor descifrat chiar și manual.<br>
Schemele de criptare mai complexe, cum ar fi cifrul Vigenère,
folosesc cifrul Cezar ca un element al procesului de criptare.</p>
</div>
</div>
</div>
</section>
<div class="w3-card-4" style="width:100%" id="flip1">
            <header class="w3-container w3-light-grey" >
                <H2 style="background: #07c5f8" align="center">Exemplu criptare și decriptare Caesar:</H2>
            </header>
            <div class="w3-container" style="background: white ; color:black" id="panel1">
             <iframe src="../Html/exemplu_caesar.html" width="100%" height="700" style="border:1px solid black;">
</iframe>

</div>
</div>
</div>
<br>

<br>
	<section id="cesar_implementat">
        <div class="w3-card-4" style="width:100%" >
            <header class="w3-container w3-light-grey">
                <H2 style="background: #07c5f8" align="center">Cesar</H2>
            </header>
			<div class="w3-container w3-center" >
	<div class="wrap">
	<div class="conteudo">
	<table width="500" align="center">
	<tr><td width="50%" valign="top">
	<fieldset>
	<legend><b>Caesar</b></legend>

	<form action="" method="post" >
	<input type="text" name="key_caesar" id="key_caesar" value="3" onclick="SelectAll('key_caesar')" />
	<input type="submit" value="?" onclick="InfoCaesar()" /><br/>
	<textarea rows="4" name="plantext_caesar" id="plantext_caesar" cols="25" onclick="SelectAll('plantext_caesar')" > text simplu...</textarea><br/>
	<input type="submit" name="encrypt_caesar" value="Criptare" /><input type="submit" name="decrypt_caesar" value="Decriptare" /><input type="reset" value="Resetare" />
	</form>

	<form action="http://localhost/Proiect_pw/Public/upload" method="post" enctype="multipart/form-data">
  Select txt to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload txt" name="Upload">
</form>

	</fieldset>
	</td><td valign="top" colspan="3">
	<fieldset>
	<legend><b>Rezultat</b></legend>
	<form action="http://localhost/Proiect_pw/Public/rezultat_caesar" method="post">
	<?php
	//----------------------------------------------------------------//
	// caesar														  //
	//----------------------------------------------------------------//
		if((isset($_POST['key_caesar'])) && (isset($_POST['plantext_caesar'])) && isset($_POST['encrypt_caesar'])){
			$key=$_POST['key_caesar'];
			$plantext=$_POST['plantext_caesar'];
			$split_key=str_split($key);
			$i=0;
			$split_chr=str_split($plantext);
			while ($key>52){
				$key=$key-52;
			}
			foreach($split_chr as $chr){
				if (char_to_dec($chr)!=null){
					$split_nmbr[$i]=char_to_dec($chr);
				} else {
					$split_nmbr[$i]=$chr;
				}
				$i++;
			}
			echo '<textarea rows="4" name="result" id="result" cols="25" onclick="SelectAll(\'result\')" >';
			foreach($split_nmbr as $nmbr){
				if (($nmbr+$key)>52){
					if (dec_to_char($nmbr)!=null){
						echo dec_to_char(($nmbr+$key)-52);
					} else {
						echo $nmbr;
					}
				} else {
					if (dec_to_char($nmbr)!=null){
						echo dec_to_char($nmbr+$key);
					} else {
						echo $nmbr;
					}
				}
			}
			echo '</textarea><br/>';
		} else if ((isset($_POST['key_caesar'])) && (isset($_POST['plantext_caesar'])) && isset($_POST['decrypt_caesar'])){
			$key=$_POST['key_caesar'];
			$plantext=$_POST['plantext_caesar'];
			$i=0;
			$split_chr=str_split($plantext);
			while ($key>52){
				$key=$key-52;
			}
			foreach($split_chr as $chr){
				if (char_to_dec($chr)!=null){
					$split_nmbr[$i]=char_to_dec($chr);
				} else {
					$split_nmbr[$i]=$chr;
				}
				$i++;
			}
			echo '<textarea rows="4" name="result" id="result" cols="25" onclick="SelectAll(\'result\')" >';
			foreach($split_nmbr as $nmbr){
				if (($nmbr-$key)<1){
					if (dec_to_char($nmbr)!=null){
						echo dec_to_char(($nmbr-$key)+52);
					} else {
						echo $nmbr;
					}
				} else {
					if (dec_to_char($nmbr)!=null){
						echo dec_to_char($nmbr-$key);
					} else {
						echo $nmbr;
					}
				}
			}
			echo '</textarea><br/>';



			echo '</textarea><br/>';

		} else {
			echo "rezultat este aici...";
		}
	?>

	<input type="submit" value="Save">
	</form>
	</fieldset>
	</td></tr>
	</table>
	</div>
	</div>
	</div>
	</div>
	</div>
	</section>
</body>
</html>
