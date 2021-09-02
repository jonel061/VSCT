<?php
    require '../Service/aes.class.php';     // AES PHP implementation
    require '../Service/aesctr.class.php';  // AES Counter Mode implementation


    $timer = microtime(true);

    // initialise password & plaintext if not set in post array
    $pw = empty($_POST['pw']) ? 'Ana '              : $_POST['pw'];
    $pt = empty($_POST['pt']) ? 'are mere!' : $_POST['pt'];
    $cipher = empty($_POST['cipher']) ? '' : $_POST['cipher'];
    $plain  = empty($_POST['plain'])  ? '' : $_POST['plain'];

    // perform encryption/decryption as required
    $encr = empty($_POST['encr']) ? $cipher : AesCtr::encrypt($pt, $pw, 256);
    $decr = empty($_POST['decr']) ? $plain  : AesCtr::decrypt($cipher, $pw, 256);
?>


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

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Main Stylesheet File -->
    <link href="../css/style_vsct.css" rel="stylesheet">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    </head>

    <header id="header">
    <div class="container">



        <nav align='right'>

            <ul class="nav-menu">
                <div class="topleft"> <img src="../Img/Logo.png" align='left' class="resposive" width="350" height="350">
                </div>


                <button align='right' id="button"> 🞬 </button>
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
        $("#button").click(function() { /* this if else to change the text in the button */
            if ($("#button").text() == "☰") {
                $("#button").text("🞬");
            } else {
                $("#button").text("☰");
            } /* this function toggle the visibility of our "li" elements */
            $("li").toggle("slow");
        });
    });
    $(document).ready(function(){
  $("#hide").click(function(){
    $(".w3-container").hide();

  });
  $("#show").click(function(){
    $(".w3-container").show();

  });
});

</script>
<script>
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
$(document).ready(function(){
  $("#flip2").click(function(){
    $("#panel2").slideToggle("slow");
  });
});
$(document).ready(function(){
  $("#flip3").click(function(){
    $("#panel3").slideToggle("slow");
  });
});
$(document).ready(function(){
  $("#flip4").click(function(){
    $("#panel4").slideToggle("slow");
  });
});
$(document).ready(function(){
  $("#flip5").click(function(){
    $("#panel5").slideToggle("slow");
  });
});
$(document).ready(function(){
  $("#flip6").click(function(){
    $("#panel6").slideToggle("slow");
  });
});
$(document).ready(function(){
  $("#flip7").click(function(){
    $("#panel7").slideToggle("slow");
  });
});
</script>

<br><br><br><br><br>
<body>
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

<section id="intro">
<div class="intro-text">
    <p>Pe acestă pagină veți învăța despre algoritmul AES(Advanced encryption standard)</p>
    <a href="#Teoria" class="btn-get-started scrollto">Să începem </a>
</div>
</section>
   <section id="Teoria">
        <div class="w3-card-4" style="width:100%" id="flip" >
            <header class="w3-container w3-light-grey">
                <H2 style="background: #07c5f8" align="center" >AES Teoria</H2>
            </header>
            <div class="w3-container" style="background: white ; color:black"  id="panel" >
         <p align='left'>   AES(Advanced Encryption standard) sau Rijndael este un algoritm standrdizat pentru criptarea simetrică, pe blocuri.
             Este foarte folosit în aplicații și adoptat ca standard de organizașia guvernamentală americană NIST.<br>
             Standardul oficializează algoritmul dezvoltat de doi criptografi belgieni, Joan Daemen și Vincent Rijmen și trimis la NIST pentru selecție sub numele Rijndael.
             În propunerea avansată NIST, cei doi autori ai algoritmului Rijndael au definit un algoritm de criptare pe blocuri în care lungimea blocului și a cheii puteau fi independente, de 128 de biți, 192 de biți, sau 256 de biți.
             Specificația AES standardizează toate cele trei dimensiuni posibile pentru lungimea cheii, dar restricționează lungimea blocului la 128 de biți.[4] Astfel, intrarea și ieșirea algoritmilor de criptare și decriptare este un bloc de 128 de biți.
             În publicația FIPS numărul 197, operațiile AES sunt definite sub formă de operații pe matrice, unde atât cheia, cât și blocul sunt scrise sub formă de matrice.[5] La începutul rulării cifrului, blocul este copiat într-un tablou denumit stare (în engleză state), primii patru octeți pe prima coloană, apoi următorii patru pe a doua coloană, și tot așa până la completarea tabloului.
             </p>
             </div>
</div>
</div>
        <div class="w3-card-4" style="width:100%" id="flip1">
            <header class="w3-container w3-light-grey">
                <H2 style="background: #07c5f8" align="center">Pseudo code aes criptare:</H2>
            </header>
            <div class="w3-container" style="background: white ; color:black" id="panel1" >
             <iframe src="../Html/PseudoCodeAes.html" width="100%" height="700" style="border:1px solid black;">
</iframe>

</div>
</div>

<br>





        <div class="w3-card-4" style="width:100%" id="flip2">
            <header class="w3-container w3-light-grey">
                <H2 style="background: #07c5f8" align="center">Pseudo code aes decriptare:</H2>
            </header>
            <div class="w3-container" style="background: white ; color:black"   id="panel2">
             <iframe src="../Html/PseudoCodeAesDecriptare.html" width="100%" height="700" style="border:1px solid black;">
</iframe>
</div>
</div>
<br>
        <div class="w3-card-4" style="width:100% " id="flip3">
            <header class="w3-container w3-light-grey">
                <H2 style="background: #07c5f8" align="center">SubBytes</H2>
            </header>
            <div class="w3-container" style="background: white ; color:black"  id="panel3">
            <div class="w3-container w3-center">
                <div class='ul'>

<p align='left'> Transformarea SubBytes(stare) este o substituţie neliniară de octeţi care
operează independent pe fiecare octet cu ajutorul unui S-box. Acest S-box este
construit prin compunerea a două transformări:
1. Calcularea inversului multiplicativ pentru fiecare octet nenul în corpul finit
GF(28
), elementul {0,0} rămânând neschimbat;

2. Rezultatul este modificat printr-o transformare afin ̆a peste Z2:Această
transformare scrisă în forma matriceală arată astfel:</p>
<img src='../Img/S_box.png' class="responsive" width="300" height="300"><br>
<p align='left'>de exemplu dacă s1,1={53}-> S-box->s’

1,1={ed} elementul aflat la intersecţia liniei

5 cu coloana 3<br>
S- boxul este o funcţie neliniară, bijectivă (singura parte neliniară a cifrului).<br>
S- boxul din AES foloseşte următoarea transformare afină:<br>
y = Ax ⊕ C mod m(x) unde: m(x) = x<sup>8</sup> + x<sup>4</sup> + x<sup>3</sup> + x + 1<br>
<br>
A = [f8, 7c, 3e, 1f, 8f, c7, e1, f1]<sup>T</sup>, matrice 8x8 în GF(2)<br>
C = [63]<sup>T</sup>, matrice coloană în GF(2).<br>
<br>
Pentru a fi generatoare pentru S-box matricea A trebuie să fie nesingulară.<br>
Putem genera aproximativ 263 astfel de matrici nesingulare cu fiecare dintre
polinoamele ireductibile.<br> Polinoamele rezultate în matricile nesingulare sunt [01,
02, 04, 08, 10, 20, 40, 80],<br> marginea inferioară şi [fe, 7f, bf, df, ef, f7, fb, fd],
margine superioară.<br>
Pentru a satisface efectul de avalanşă înseamnă ca modificarea unui singur<br>
bit la intrare să implice modificarea a cel puţin 50% din biţii de ieşire. Pentru a<br>
satisface Strict Criterion Avalanche este echivalent a spune că dacă modificăm un<br>
bit la intrare se vor altera exact 50% din biţii de ieşire.<br>
Criterii în proiectarea S-boxului:</p>

<ol >
<li  >Neliniaritate - Corelaţia intrări-ieşiri să fie cât mai mică posibil</li>
<li > Complexitatea algebrică.</li>
</ol>


<p align='left'>Pentru transformarea tuturor octeţilor se foloseşte un singur S-box. Cu siguranţă<br>
asta nu este o necessitate, transformarea SubBytes putînd fi cu uşurinţă definită cu<br>
S-boxuri diferite pentru fiecare octet<br>
Inversa transformării se obţine aplicând fiecărui octet transformarea afină<br>
inversă, după care se ia inversul multiplicativ din GF(2<sup>8</sup>)(dacă octetul nu este nul).

) (dacă octetul nu este nul).</p>
</div>
</div>
</div>
</div>


        <div class="w3-card-4" style="width:100%" id="flip4">
            <header class="w3-container w3-light-grey">
                <H2 style="background: #07c5f8" align="center">Transformarea ShiftRows (stare)SubBytes</H2>
            </header>
            <div class="w3-container" style="background: white ; color:black" >
            <div class="w3-container w3-center" id="panel4">
            <p align='center'>Transformarea ShiftRows (stare) modifică octeţii ultimilor 3 linii
permutându-i ciclic cu un număr diferit de octeţi. Prima linie rămâne nemodificată
.<br>
Metoda transpoziţiei asigură, în cadrul sistemelor criptografice, realizarea
difuziei: împrăştierea proprietăţilor statistice ale textului clar în textul cifrat.</p>
<img src='../Img/Shift_rows.png' class="responsive" width="300" height="300"><br>
<p align='center'>Observăm că se modifică doar poziţia octeţilor nu şi valoarea lor.<br>
Inversa transformării ShiftRow constă în permutarea ciclică spre stânga cu Nb -Ci<br>
octeţi pentru linia i (1 < i < 3); în acest fel, fiecare octet aflat pe poziţia j în linia i <br>
se deplasează pe poziţia j + Nb - Ci (mod Nb) .</p>
</div>
</div>
</div>
</div>
     
        <div class="w3-card-4" style="width:100%" id="flip5">
            <header class="w3-container w3-light-grey">
                <H2 style="background: #07c5f8" align="center">Transformarea MixColumns(stare)</H2>
            </header>
            <div class="w3-container" style="background: white ; color:black" >
            <div class="w3-container w3-center" id="panel5">
            <p align='center'>Această transformare modifică coloana matricei de stare, transformand fiecare
coloana intr-un polinom cu patru termeni peste GF(2<sup>8</sup>).</p>
<img src='../Img/Mix_columns.png' class="responsive" width="300" height="300"><br>
<p align='left'>1. Dimensiunea. Transformarea operează pe coloane de patru octeţi.<br>
2. Liniaritate. Este de preferat liniară peste GF(2).<br>
3. Difuzia. Trebuie să aibă putere de difuzie.<br>
4. Performanţe pe procesoare de 8 biţi.<br>
Coloanele matricei de stare sunt considerate polinoame peste GF(2<sup>8</sup>) şi sunt<br>
înmulţite modulo x4 +1 cu un polinom fixat c(x), unde:<br>
c(x) = 03x<sup>3</sup> + 01x<sup>2</sup> + 01x + 02.<br>
Criteriul de performanţă poate fi atins dacă coeficienţii au valori simple.<br>
Înmulţirile cu 00, 01 nu implică procesare.<br>
Bazat pe înmulţirea polinoamelor în GF(2<sup>8</sup>). Această înmulţire se face modulo<br>
polinomul generator al corpului GF(2<sup>8</sup>) care este:<br>
m(x) = x<sup>8</sup>  + x<sup>4</sup> + x<sup>3</sup> + x + 1.<br>
Operaţia inversă este similară. <br>Fiecare coloană este transformată prin
înmulţire cu polinomul invers lui c(X) modulo X4 + 1; acesta este:
d(X) = 0BX<sup>3</sup> +0DX<sup>2</sup> + 09X + 0E</p>
            </div>
            </div>
            </div>
      </div>
     
     
     
          
        <div class="w3-card-4" style="width:100%" id="flip6">
            <header class="w3-container w3-light-grey">
                <H2 style="background: #07c5f8" align="center">AddRoundKey(Stare, Cheie)</H2>
            </header>
            <div class="w3-container" style="background: white ; color:black"  id="panel6">
            <p align='left'>AddRoundKey(Stare, Cheie): Această transformare constă în aplicarea
unui XOR între starea curentă şi cheia de rundă. Cheia de rundă are lungimea Nb
şi este dedusă din cheia de criptare pe baza unui procedeu pe care îl descriem mai
jos.</p>
</div>
</div>
            </div>
        


</section>

<br>

        <br>

<br>
<br>
            <div class="w3-container" align="center" id="flip7">
        <div class="w3-card-4" style="width:100%" >
            <header class="w3-container w3-light-grey">
                <H2 style="background: #07c5f8" align="center">AES</H2>
            </header>
            <form method="post">
            <table>
                <tr>
                    <td>cheia:</td>
                    <td><input type="text" name="pw" size="25" value="<?= $pw ?>"></td>
                </tr>
                <tr>
                    <td>Textul:</td>
                    <td><input type="text" name="pt" size="25" value="<?= htmlspecialchars($pt) ?>"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="encr" value="Encrypt it">criptare</button></td>
                    <td><input type="text" name="cipher" size="25" value="<?= $encr ?>"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="decr" value="Decrypt it">Decriptare</button></td>
                    <td><input type="text" name="plain" size="25" value="<?= htmlspecialchars($decr) ?>"></td>
                </tr>
            </table>
        </form>
        <p>
            <?= round(microtime(true) - $timer, 3) ?>s</p>
</div>
                 </div>
    </body>

    </html>