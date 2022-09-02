<?php
session_start();
$dbHostName= "localhost";
$dbHostUser="root";
$dbHostPasswd="";
$dbName="kbaza";
/*Nawiązywanie Połaczenie z bazą (Wyciszanie błedu @)*/
if(isset($_POST['email'])){
    $connection = @new mysqli($dbHostName,$dbHostUser,$dbHostPasswd,$dbName);
    if($connection->connect_errno!=0){
    echo "Error:" . $connection -> connect_errno;
    }
    else{
        /*Pobieranie danych z formularza*/
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        /*Zabezpiecznie przed wstrzykiwaniem SQL + zapytanie do bazy danych*/
        $email = htmlentities($email,ENT_QUOTES,"UTF-8");
        
        if($result = @$connection->query(sprintf("SELECT * FROM users WHERE useremail='%s'",
        mysqli_real_escape_string($connection,$email))))
        /*---------------------------------------*/
        {
            $user_count = $result->num_rows;
            if($user_count>0)
            {
                /*Pobieranie wyników zapytania z bazy*/
                $record = $result->fetch_assoc();
                /*Weryfikacja hasla podanego do hasla zahashowanego z bazy*/
                if(password_verify($password,$record['userpassword']))
                {
                    /*Śledzenie statusu zalogowania*/
                    $_SESSION['logged'] = true;
                    /*Przekazywanie danych o użytkowniku do aplikacji*/
                    $_SESSION['userid'] = $record['id']; 
                    $_SESSION['useremail'] = $record['useremail'];
                    $_SESSION['username'] = $record['username'];
                    $_SESSION['usersurname'] = $record['usersurname'];
                    $_SESSION['userphone'] = $record['userphone'];


                    /*Wygaszanie błędu + czyszczenie wyników dostępu do bazy*/
                    unset($_SESSION['error']);
                    $result->free_result();
                    $_SESSION['instance'] = 1;
                    header('Location:index.php');
                } else
                    {
                        /*Bład zgodnosci loginu i hasła PRZYPADEK 1*/
                        $_SESSION['error'] = '<span style="color:red">Nieprawodłowy e-mail lub hasło</span>';
                        header('Location:login.php');
                     }
            } else
                {
                    /*Bład zgodnosci loginu i hasła PRZYPADEK 2 */
                    $_SESSION['error'] = '<span style="color:red">Nieprawodłowy e-mail lub hasło</span>';
                    header('Location:login.php');
                }
        };
        /*Zamykanie połaczenia do bazy danych*/
        $connection -> close();
        /*-----------------------------------*/
    }
    }
?>