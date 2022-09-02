<?php  require_once 'includes/lconnect.php'; ?>
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
<div class="login">
    <form action="login.php" method="post" class='form1'>
            <h1 class="h1-1">Zaloguj się</h1>
            <div class="flex">
            <i class="fa-solid fa-at ico2"></i>
            <input class="input1" type="email" name="email" placeholder="Wprowadź swój e-mail" required>
            </div>
        <br>
        
            <div class="flex">
            <i class="fa-solid fa-lock ico2"></i>
            <input class="input1" type="password" name="password" placeholder="Wprowadź swoje hasło" required>
            </div>
        <br>
            <button class="submitbtn1" type="submit">Login</button>
            
            <?php
            /*Aktywowanie informacji o błedzie loginu badź hasła z pliku connectlogin.php*/
            if(isset($_SESSION['error'])){
                echo '<br>';
                echo $_SESSION['error'];
            };
            /*---------------------------------------------------------------------------*/
            ?>

    </form>
</div>

<?php include_once './includes/footer.php';?>
<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>