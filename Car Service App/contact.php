<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project K</title>
    <!--Główne style procesowane z SCSS (main.scss)-->
    <link rel="stylesheet" href="./css/main.css">
    <!--Link CDN do FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <!--NOTKA BootStrap CSS zainstalowany lokalnie poprzez NPM (Node Package Manager)-->
</head>
<body>
<?php include_once './includes/nav.php';?>
<div class="contact-container">
    <h1 class="contact-main-h1">Dane kontaktowe</h1>
<div class="contact-row">

    <div class="contact-col">
            <div class="contact-title">
                <i class="fa-solid fa-phone contact-ico"></i>
                <h1 class="contact-h1"> Telefon<h1>   
            </div>
            <p class="contact-p">Lorem ipsum dolor sit amet.</p>
    </div>

    <div class="contact-col">
            <div class="contact-title">
            <i class="fa-solid fa-envelope contact-ico"></i>    
                <h1 class="contact-h1">E-mail<h1>   
            </div>
            <p class="contact-p">Lorem ipsum dolor sit amet.</p>
    </div>
</div>
<div class="contact-row">

        <div class="contact-col">
            <div class="contact-title">
                <i class="fa-solid fa-location-dot contact-ico"></i>
                <h1 class="contact-h1">Miejscowość<h1>   
            </div>
            <p class="contact-p">Lorem ipsum dolor sit amet.</p>
        </div>

        <div class="contact-col">
            <div class="contact-title">
                <i class="fa-brands fa-facebook contact-ico"></i>
                <h1 class="contact-h1"> Facebook<h1>   
            </div>
            <p class="contact-p">Lorem ipsum dolor sit amet.</p>
        </div>
</div>
</div>



<?php include_once './includes/footer.php';?>
<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>