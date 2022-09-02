<?php
/*Sprawdzanie statusu zalogowania i funkcja przekierowania na stronę aplikacji*/
session_start();
require_once 'db/connectlogin.php';
if(isset($_SESSION['logged'])&& ($_SESSION['logged']==true)){
    header('Location: dashboard.php');
    exit(); 
};
/*----------------------------------------------------------------------------*/
?>

<html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit-no">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <title>Login</title>
        </head>
        <body>

        <!-- Nagłówek stały nie includowany -->
        <header class="padding">
            <div class="container">
                <div class="row rowspec">
                    <div class="col-6"><a class="a" href="dashboard.php">PHP QUIZZER</a></div>
                    <div class="col-6"><a class="logout logoutt mx-3" href="about.php">About us</a>
                    <a class="logout mx-3" href="register.php">Register</a></div>
                </div>
            </div>
        </header>
        <!-- ------------------------------ -->

            
        <form action="index.php" method="post" class='form1'>
            <h1 class="h1-1">Login</h1>
            <label class="label1" for="login">Login:</label>
            <input class="input1" type="text" name="login" placeholder="Enter your Login" required>
        <br>
            <label class="label1" for="password">Password:</label>
            <input class="input1" type="password" name="password" placeholder="Enter your Password" required>
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
</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Secular+One&display=swap');
    .padding{
        padding:15px;
    }
    .a{
        
    font-family: 'Secular One', sans-serif;
    font-size:2em;
}
.logoutt{
    padding:10px 15px;
    border:none;
    color:white;
    background-color:rgb(143, 223, 255) ;
    border-radius: 3px;
    margin:70px 10px;
    text-decoration:none;

}
.logoutt:hover{ 
    padding:10px 15px;
    border:none;
    background-color:rgb(143, 223, 255) ;
    color:rgb(223, 223, 223);
    border-radius: 3px;
    text-decoration:none;
}
</style>
</html>

<?php
include_once 'includes/footer.php';
?>