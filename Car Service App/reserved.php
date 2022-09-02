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

<div class="reserveinfo">
<i class="fa-solid fa-file-signature ico-reserve"></i>    
<p class="p-reserve">Rezerwacja na termin: <span class="span-reserve"><?php echo $_SESSION['reservedterm']?></span> Przebiegła pomyślnie</p>
<a href="account.php" class="toaccount">Zobacz rezerwacje</a>
</div>




<?php include_once './includes/footer.php';?>
<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>