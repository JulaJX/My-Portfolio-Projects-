<?php session_start();
include_once './includes/rconnect.php';
if(!isset($_SESSION['logged'])){
    header('Location:register.php');
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

<div class="account-container">
<div class="account-title">
    <i class="fa-solid fa-user-check account-ico"></i>
    <h1 class="account-main-h1">Twoje Konto</h1>  
</div>

<div class="account-item">
    <h3 class="account-h3">Imię i nazwisko: <span class="account-span"><?php echo $_SESSION['username'];echo ' '.$_SESSION['usersurname'] ?></span></h3>
    <h3 class="account-h3">E-mail: <span class="account-span"><?php echo $_SESSION['useremail'] ?></span></h3>
    <h3 class="account-h3">Numer Telefonu: <span class="account-span"><?php echo $_SESSION['userphone'] ?></span></h3>
</div>
<div class="account-title2">
    <i class="fa-solid fa-calendar-check account-ico"></i>
    <h1 class="account-main-h1">Twoje rezerwacje</h1>  
</div>
<div class="account-item2">

<?php 

$temail = $_SESSION['useremail'];

mysqli_report(MYSQLI_REPORT_STRICT);
try
       {
           $connection = new mysqli($dbHostName, $dbHostUser,$dbHostPasswd,$dbName);
           if($connection->connect_errno!=0){
               throw new Exception(mysqli_connect_errno());
           }
           else
           {
               $result = $connection->query("SELECT * FROM schedule WHERE email='$temail'");
               if(!$result) throw new Exception($connection->error);
               $total = $result->num_rows;
               while($fetching = mysqli_fetch_array($result))
               {   

                   echo( 
                    '
                    <div class="account-reserve-box">
                        <i class="fa-solid fa-check account-ico"></i>
                        <p class="account-res">Rezerwacja na termin: '.$fetching['scheduledate'].'</p>
                        <a href="delete.php?id='.$fetching['scheduledate'].'">
                        <input type="submit" value="Anuluj Rezerwacje" class="deletebtn1">
                        </a>
                    </div>
                    '
                   );

               }

               $connection->close();
           }
       }
       catch(Exception $e)
       {
       echo 'Server error! We apologize for inconveniences. Try to register later!';
       echo '<br>Dev inf:'.$e;
       }
       if($total<1){
           echo '<p class="nores-p">Nie posiadasz zarezerwowanych terminów</p>';
       }
               
               ?>    

</div>




</div>



<?php include_once './includes/footer.php';?>
<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>