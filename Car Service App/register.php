<?php
session_start();
include_once 'includes/rconnect.php';
/*Kod wykonywany w momencie gdy użytkownik prześle formularz rejestracji*/
if(isset($_POST['name'])){
    $validation=true;

    //Weryfikacja poprawności podanego imienia
    $name = $_POST['name'];
    if(strlen($name)<1)
    {
        $validation=false;
        $_SESSION['e_name']= "Wprowadź imię";
    }
        //Weryfikacja poprawności podanego imienia
        $surname = $_POST['surname'];
        if(strlen($surname)<1)
        {
            $validation=false;
            $_SESSION['e_surname']= "Wprowadź nazwisko";
        }

    //Weryfikacja poprawności podanego Maila
    $email = $_POST['email'];
    $emailS = filter_var($email,FILTER_SANITIZE_EMAIL);

    if((filter_var($emailS,FILTER_VALIDATE_EMAIL)==false)|| ($emailS!=$email)){
        $validation=false;
        $_SESSION['e_email']="Wprowadź poprawny adres e-mail";
    }

    //Weryfikacja poprawności podanych Haseł
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if(strlen($password1)<8){
        $validation = false;
        $_SESSION['e_password']= "Hasło musi posiadać minimum 8 znaków";
    }
    if($password1 != $password2){
        $validation = false;
        $_SESSION['e_password']= "Podane hasła nie są takie same";
    }
    $password_hash = password_hash($password1, PASSWORD_DEFAULT);
    //Weryfikacja poprawności Numeru Telefonu
    $phone = $_POST['phone'];
    if((strlen($phone)<9) || (strlen($phone)>9)){
        $validation = false;
        $_SESSION['e_phone']= "Wprowadź poprawny numer telefonu";
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
                    $_SESSION['e_email']= "Ten e-mail jest przypisany do innego konta";
                }
                    //Weryfikacja całego formularza czy wszystkie inputy so poprawnie wypełnione
                if($validation==true)
                    {
                        if($connection->query("INSERT INTO users VALUES(NULL,'$email','$password_hash','$name','$surname','$phone')"))
                            {
                                $_SESSION['registersuccess']=true;
                                $_SESSION['logged'] = true;
                                $_SESSION['instance2'] = 1;
                                $_SESSION['useremail'] = $email;
                                $_SESSION['username'] = $name;
                                $_SESSION['usersurname'] = $surname;
                                $_SESSION['userphone'] = $phone;
                                header('Location:index.php');
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

<div class="register">
    <form method="post" class="form2">
            <h1 class="h1-1">Rejestracja</h1>
  
            <div class="flex">
            <i class="fa-solid fa-signature ico2"></i>
            <input class="input1" type="text" name="name" placeholder="Imię">
            </div>
            
            <?php if(isset($_SESSION['e_name'])){
                echo '<div class="error">'. $_SESSION['e_name'] .'</div>';
                unset($_SESSION['e_name']);
            }; ?>

            <div class="flex">
            <i class="fa-solid fa-signature ico2"></i>
            <input class="input1" type="text" name="surname" placeholder="Nazwisko">
            </div>
            
            <?php if(isset($_SESSION['e_surname'])){
                echo '<div class="error">'. $_SESSION['e_surname'] .'</div>';
                unset($_SESSION['e_surname']);
            }; ?>

            <div class="flex">
            <i class="fa-solid fa-at ico2"></i>
            <input class="input1" type="email" name="email" placeholder="E-mail">
            </div>
            
            <?php
             if(isset($_SESSION['e_email']))
                {
                echo '<div class="error">'. $_SESSION['e_email'] .'</div>';
                unset($_SESSION['e_email']);
                };
            ?>

            <div class="flex">
            <i class="fa-solid fa-lock ico2"></i>
            <input class="input1" type="password" name="password1" placeholder="Hasło">
            </div>

            
            <div class="flex">
            <i class="fa-solid fa-lock ico2"></i>
            <input class="input1" type="password" name="password2" placeholder="Powtórz hasło">
            </div>

            <?php if(isset($_SESSION['e_password'])){
                echo '<div class="error">'. $_SESSION['e_password'] .'</div>';
                unset($_SESSION['e_password']);
            }; ?>

            <div class="flex">
            <i class="fa-solid fa-phone ico2"></i>
            <input class="input1" type="text" name="phone" placeholder="Numer Telefonu">
            </div>
            <?php if(isset($_SESSION['e_phone'])){
                echo '<div class="error">'. $_SESSION['e_phone'] .'</div>';
                unset($_SESSION['e_phone']);
            }; ?>

            <input type="submit" value="Zarejestruj się" class="submitbtn1">
        </form>
</div>


<?php include_once './includes/footer.php';?>
<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>