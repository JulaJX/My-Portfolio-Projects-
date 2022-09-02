<?php
// $dbHostName= "localhost";
// $dbHostUser="root";
// $dbHostPasswd="";
// $dbName="quizbaza";
$dbHostName= "sql4.5v.pl";
$dbHostUser="julekpro100_quizerphpjj";
$dbHostPasswd="reah5jgz2u";
$dbName="julekpro100_quizerphpjj";
/*Nawiązywanie Połaczenie z bazą (Wyciszanie błedu @)*/
if(isset($_POST['login'])){
    $connection = @new mysqli($dbHostName,$dbHostUser,$dbHostPasswd,$dbName);
    if($connection->connect_errno!=0){
    echo "Error:" . $connection -> connect_errno;
    }
    else{
        /*Pobieranie danych z formularza*/
        $login = $_POST['login'];
        $password = $_POST['password'];

        /*Zabezpiecznie przed wstrzykiwaniem SQL + zapytanie do bazy danych*/
        $login = htmlentities($login,ENT_QUOTES,"UTF-8");
        
        if($result = @$connection->query(sprintf("SELECT * FROM users WHERE userlogin='%s'",
        mysqli_real_escape_string($connection,$login))))
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
                    $_SESSION['userlogin'] = $record['userlogin'];
                    $_SESSION['useremail'] = $record['useremail'];
                    $_SESSION['username'] = $record['username'];
                    $_SESSION['usertype'] = $record['usertype'];
                    $_SESSION['userclass'] = $record['class'];
                    $_SESSION['userschool'] = $record['school'];

                    /*Wygaszanie błędu + czyszczenie wyników dostępu do bazy*/
                    unset($_SESSION['error']);
                    $result->free_result();
                    header('Location:dashboard.php');
                } else
                    {
                        /*Bład zgodnosci loginu i hasła PRZYPADEK 1*/
                        $_SESSION['error'] = '<span style="color:red">Nieprawodłowy login lub hasło</span>';
                        header('Location:index.php');
                     }
            } else
                {
                    /*Bład zgodnosci loginu i hasła PRZYPADEK 2 */
                    $_SESSION['error'] = '<span style="color:red">Nieprawodłowy login lub hasło</span>';
                    header('Location:index.php');
                }
        };
        /*Zamykanie połaczenia do bazy danych*/
        $connection -> close();
        /*-----------------------------------*/
    }
    }
?>