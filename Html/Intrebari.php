<?php
session_start();
error_reporting(0);
include('../config/config.php');
if(isset($_POST['Intrebari']))
{
$name=$_POST['name'];
$username=$_POST['username'];
$email=$_POST['email'];	
$mobile=$_POST['mobile'];
$subject=$_POST['subject'];	
$description=$_POST['description'];
$sql= "INSERT INTO intrebari (name,username,email,mobile,Subject,Description) VALUES(:name,:username,:email,:mobile,:subject,:description)";
$query = $dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':username',$username,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':subject',$subject,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->execute();
//$lastInsertId = $dbh->lastInsertId();
//if($lastInsertId)
//{
//$msg="Enquiry  Successfully submited";
//}
//else 
//{
//$error="Something went wrong. Please try again";
//}

}

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
        <title>Intrebari</title>
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





	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
	<style type="text/css">
	a:link {color: #000000; text-decoration: none}
	a:visited {color: #000000; text-decoration: none}
	a:hover {color: #FF0000; text-decoration: underline}
	</style>


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
</script>
<style>
       body {
        background: linear-gradient(45deg, rgba(200, 100, 224, 0.8), rgba(29, 253, 239, 0.8)), url("../Img/background_vsct.jpg") center top no-repeat;
            color: #666666;
            font-family: "Open Sans", sans-serif;
            overflow-x: hidden;
        }
        
        a {
            color: #1dc8cd;
            transition: 0.5s;
        }
        

</style>

<br>
<br>	
<br>
<br>
<div class="container">
		<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;color:#07c5f8">Intrebari </h3>
		<form name="Intrebari" method="post" action='http://localhost/Proiect_pw/Public/Intrebari'>
		 <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
	<p style="width: 350px;" >
		
			<b style="color:#07c5f8">Nume</b>  <input type="text" name="name" class="form-control" id="name" placeholder="Introduce numele" required="">
	</p> 
    <p style="width: 350px;">
		
        <b style="color:#07c5f8">Prenume</b>  <input type="text" name="username" class="form-control" id="username" placeholder="Introduce prenumele" required="">
</p> 
<p style="width: 350px;">
<b style="color:#07c5f8">Email</b>  <input type="email" name="email" class="form-control" id="email" placeholder="Introduce adresa email" required="">
	</p> 

	<p style="width: 350px;">
<b style="color:#07c5f8">Număr telefon</b>  <input type="text" name="mobile" class="form-control" id="mobile" maxlength="10" placeholder="Inroduce numărul de telefon " required="">
	</p> 

	<p style="width: 350px;">
<b style="color:#07c5f8">Subject</b>  <input type="text" name="subject" class="form-control" id="subject"  placeholder="Introduce subjectul" required="">
	</p> 
	<p style="width: 350px;">
<b style="color:#07c5f8">Întrebare</b>  <textarea name="description" class="form-control" rows="6" cols="50" id="description"  placeholder="Introduce întebarea"></textarea> 
	</p> 

			<p style="width: 350px;">
<button type="submit" name="Intrebari" class="btn-primary" style="background-color:#07c5f8">Submit</button>
			</p>
			</form>

		
	</div>
</div>	</div>