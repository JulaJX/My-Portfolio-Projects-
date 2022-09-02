<?php
session_start();
include_once 'db/connect2.php';
/*Kod wykonywany w momencie gdy użytkownik prześle formularz logowania*/
if(isset($_POST['login'])){
    $validation=true;

    //Weryfikacja poprawności podanego Loginu
    $login = $_POST['login'];

    if((strlen($login)<3) || (strlen($login)>20)){
        $validation=false;
        $_SESSION['e_login']= "Login has to contain from 3 to 20 characters";
    }
    if(ctype_alnum($login)==false){
        $validation = false;
        $_SESSION['e_login']= "Login has to contain only letters and digits (No special Characters)";
    }
    
    //Weryfikacja poprawności podanego Maila
    $email = $_POST['email'];
    $emailS = filter_var($email,FILTER_SANITIZE_EMAIL);

    if((filter_var($emailS,FILTER_VALIDATE_EMAIL)==false)|| ($emailS!=$email)){
        $validation=false;
        $_SESSION['e_email']="Enter correct email";
    }

    //Weryfikacja poprawności podanych Haseł
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if((strlen($password1)<8) || (strlen($password2)>20)){
        $validation = false;
        $_SESSION['e_password']= "Password has to contain from 8 to 20 characters";
    }
    if($password1 != $password2){
        $validation = false;
        $_SESSION['e_password']= "Passwords are not identical";
    }
    $password_hash = password_hash($password1, PASSWORD_DEFAULT);
    
    //Weryfikacja poprawności google CAPTCHA
    $secret = "6LdkbbsdAAAAALQWY74QzUidohYc7r6XeTDPeuEr";
    $checkcaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);   
    $resp = json_decode($checkcaptcha);
    if($resp->success==false)
    {
        $validation = false;
        $_SESSION['e_captcha']= "Confirm you're not a robot";
    }
    //Zapisanie szkoły
    $school = $_POST['school'];
    //Zapisanie klasy
    $class = $_POST['class'];
    //Weryfikacja poprawności podanego imienia
    $name = $_POST['name'];
    if((strlen($name)<1) || (strlen($name)>30))
    {
        $validation=false;
        $_SESSION['e_name']= "Name has to contain from 1 to 30 characters";
    }
    
    //Weryfikacja poprawności typu konta i kodu nauczyciela
    if($_POST['account']=='teacher' && $_POST['tcode'] != "3egk43scfe" )
    {
        $validation=false;
        $_SESSION['e_type'] = "Wrong teacher code";
    }
    elseif($_POST['account']=='teacher' && $_POST['tcode'] == "3egk43scfe")
    {
        $type='teacher';
    }
    else{
        $type='student';
    }

    
    /*Nawiązywanie Połaczenie z bazą (Wyciszanie błedu metodą TRY CATCH)*/

        mysqli_report(MYSQLI_REPORT_STRICT);
        try
        {
            $connection = new mysqli($dbHostName, $dbHostUser,$dbHostPasswd,$dbName);
            if($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                /*Sprawdzenie czy podany email znajduje się w bazie*/
                $result = $connection->query("SELECT id FROM users WHERE useremail='$email'");
                if(!$result) throw new Exception($connection->error);

                $countmails = $result->num_rows;
                if($countmails>0)
                {
                    $validation=false;
                    $_SESSION['e_email']= "This email is alredy registered";
                }
                
                /*Sprawdzenie czy podany login znajduje się w bazie*/
                $result = $connection->query("SELECT id FROM users WHERE userlogin='$login'");
                if(!$result) throw new Exception($connection->error);
                $countlogins = $result->num_rows;
                if($countlogins>0)
                {
                    $validation=false;
                    $_SESSION['e_login']= "This login is alredy registered";
                }
                    //Weryfikacja całego formularza czy wszystkie inputy so poprawnie wypełnione
                if($validation==true)
                    {
                        if($connection->query("INSERT INTO users VALUES(NULL,'$login','$email','$password_hash','$name','$type','$class','$school')"))
                            {
                                $_SESSION['registersuccess']=true;
                                header('Location:welcome.php');
                            }
                        else
                            {
                                throw new Exception($connection->error);
                            }
                    }
                $connection->close();
            }
        }
        catch(Exception $e)
        {
        echo 'Server error! We apologize for inconveniences. Try to register later!';
        echo '<br>Dev inf:'.$e;
        }
}
?>
<html>  
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <!-- Nagłówek stały nie includowany -->
        <header class="padding">
            <div class="container">
                <div class="row rowspec">
                <div class="col-6"><a class="a" href="dashboard.php">PHP QUIZZER</a></div>
                    <div class="col-6">
                    <a class="logout logoutt mx-3" href="about.php">About us</a>    
                    <a class="logout mx-3" href="index.php">Login</a></div>
                </div>
            </div>
        </header>
        <!-- ------------------------------ -->
        <form method="post" class="form2">
            <h1 class="h1-1">Register</h1>
            <div class="flex">
            
            <input class="input1" type="text" name="login" placeholder="Enter your Login">
            </div>
            <?php if(isset($_SESSION['e_login'])){
                echo '<div class="error">'. $_SESSION['e_login'] .'</div>';
                unset($_SESSION['e_login']);
            }; ?>
            <div class="flex">
            <input class="input1" type="email" name="email" placeholder="Enter your Email">
            </div>
            <?php
             if(isset($_SESSION['e_email']))
                {
                echo '<div class="error">'. $_SESSION['e_email'] .'</div>';
                unset($_SESSION['e_email']);
                };
            ?>
            <div class="flex">
            <input class="input1" type="password" name="password1" placeholder="Enter your Password">
            </div>
            <?php if(isset($_SESSION['e_password'])){
                echo '<div class="error">'. $_SESSION['e_password'] .'</div>';
                unset($_SESSION['e_password']);
            }; ?>
            
            <div class="flex">
            <input class="input1" type="password" name="password2" placeholder="Repeat your password">
            </div>
            
            <div class="flex">
            <input class="input1" type="text" name="name" placeholder="Enter your Full Name">
            </div>
            <?php if(isset($_SESSION['e_name'])){
                echo '<div class="error">'. $_SESSION['e_name'] .'</div>';
                unset($_SESSION['e_name']);
            }; ?>

            <div class="flex">
            <label class="label1" for="school">School:</label>
            <select name="school" required>
            <option value="Technikum Elektroniczne Nr1"> Technikum Elektroniczne Nr1 </option>
            </select>
            </div>

            <div class="flex">
            <label class="label1" for="class">Class:</label>
            <select name="class" id="class-select" required>
            <?php 
            for($b=1;$b<=4;$b++){
                $letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N");
            for($i=0; $i<14;$i++){
                echo 
                '
                <option value="'.$b.$letters[$i].'">'.$b.$letters[$i].'</option>
                ';
            }
            }
            ?>
            </select>
            </div>

            <div class="flex">
            <label class="label1" for="account">Account type:</label>
            <select name="account" id="account-select">
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
            </div>
            

            <input class="input1" type="text" name="tcode" placeholder="Enter teacher access code   *In case of teacher type account* ">
            <?php if(isset($_SESSION['e_type'])){
                echo '<div class="error">'. $_SESSION['e_type'] .'</div>';
                unset($_SESSION['e_type']);
            }; ?>
           
            

            <div class="g-recaptcha move" data-sitekey="6LdkbbsdAAAAAGA90Fis1Jn-789vkJrVa1bbV2E1"></div>
            <?php if(isset($_SESSION['e_captcha'])){
                echo '<div class="error">'. $_SESSION['e_captcha'] .'</div>';
                unset($_SESSION['e_captcha']);
            }; ?>

            <input type="submit" value="Register" class="submitbtn1">
        </form>
</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Secular+One&display=swap');
    .move{
        margin:15px;
    }
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
.error1{
    color:red;
}
</style>
</html>

<?php
include_once 'includes/footer.php';
?>