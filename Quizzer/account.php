<?php
include_once 'db/connect2.php';
include_once 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <div class="account-container"> 
      <h1 class="acount-info">Account info</h1>
    <p>Account Login:<span class="info"> <?php echo $_SESSION['userlogin'] ?></span></p>
    <p>Account Email:<span class="info"> <?php echo $_SESSION['useremail'] ?></span></p>
    <p>Account Type: <span class="info"> <?php echo $_SESSION['usertype'] ?></span></p>
    <p>Assigned School: <span class="info"> <?php echo $_SESSION['userschool'] ?></span></p>
    <p>Assigned Class: <span class="info"> <?php echo $_SESSION['userclass'] ?></span></p>
<?php           
                if($_SESSION['usertype'] == 'teacher'){
                    echo '
                    <h1 class="account-info">Your quizes</h1>
                    ';
?>
    <div class="account-container-2">

  <?php 

 

 mysqli_report(MYSQLI_REPORT_STRICT);
 $user = $_SESSION['username'];
 try
        {
            $connection = new mysqli($dbHostName, $dbHostUser,$dbHostPasswd,$dbName);
            if($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                $result = $connection->query("SELECT * FROM quizes WHERE quizauthor='$user'");
                if(!$result) throw new Exception($connection->error);
                $total=$result->num_rows;
                $i=0;
                while($fetching = mysqli_fetch_array($result))
                {   
                    
                    $i++;

                    echo('                    
                    <style>
                    .w'.$i.'{
                    background-image: url("imgs/'.$fetching['quizbg'].'");
                    background-size: cover;
                    }
                    </style>');
                    echo( 
                    '
                    <div class="box">
                    <a class="quizgo" href="quiz.php?id='.$fetching['id'].'">
                    <div class="box" quiz-card">
                    <div class="w'.$i.' quiz-card"></div>
                        <h1 class="quiz-h1">'.$fetching['quizname'].'</h1>
                        <h2 class="quiz-h2">Author: '.$fetching['quizauthor'].'</h2>
                        <h2 class="quiz-h2">For class: '.$fetching['class'].'</h2>
                    </div>
                    </a>
                    <div class="box2">
                    <a href="delete.php?id='.$fetching['id'].'">
                    <input type="submit" value="Delete" class="deletebtn1">
                    </a>
                    <a href="testresults.php?id='.$fetching['id'].'&quizname='.$fetching['quizname'].'">
                    <input type="submit" value="Check Students Results" class="checkbtn1">
                    </a>
                    </div>
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
                }
                ?>    
    </div>
    <?php
        if($_SESSION['usertype']=='teacher'){
        if($total==0)
        {
            echo "<h3 class='grey'>You don't have any quizes</h3>";
        }
        }
    ?>
    </div>

<style>
    .box{
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        background-color:rgb(243, 243, 243);
        border-radius:10px;
        margin:10px;
    }
.account-container{
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
    margin-top:150px;
}
.account-container-2{
    margin-top:20px;
    max-width:900px;
    margin:30px auto;
    display:grid;
    grid-template-columns:1fr 1fr 1fr;
    justify-content:center;
    align-items:center;
}
.account-info{
   
}

.info{
    font-weight:bold;
    color:blue;

}
.deletebtn1{
    border:none;
    background-color:rgb(117, 216, 255);
    padding:10px;
    border-radius:5px;
    color:white;
    margin:10px;
    
}
.deletebtn1:hover{
    background-color:rgb(255, 160, 160);
    transition:200ms ease-in;
    
}
.checkbtn1{
    border:none;
    background-color:rgb(117, 216, 255);
    padding:10px;
    border-radius:5px;
    color:white;
    margin:10px;
    
}
.checkbtn1:hover{
    background-color:rgb(177, 255, 177);
    transition:200ms ease-in;
    
}
.quiz-container{
margin-top:20px;
display:flex;
justify-content:center;
align-items:center;

}
.quiz-container2{
margin-top:20px;
display:flex;
justify-content:center;
align-items:center;
margin-bottom:300px;
}
.quiz-card{
    height:200px;
    width:300px;
    background-color:rgb(226, 226, 226);
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
    box-shadow: 10px 20px 20px rgb(223, 223, 223);
    margin:30px 30px 15px 30px;
    border-radius:20px;

}
.quizgo{
    text-decoration:none;
    border-radius:1.1em;
}

.quiz-h1{
    color:black;
    font-size:23px;
    margin:5px;
    text-align:center;
} 
.quiz-h2{
    color:black;
    font-size:16px;
    margin:5px;
    text-align:center;
} 
.box2{
    display:flex;
    justify-content:center;
    align-items:center;
}
.grey{
    color:red;
    font-size:20px;
}
@media only screen and (max-width: 1000px){

    .account-container-2{
        flex-direction:column;
    }
}
</style>

<?php include_once 'includes/footer.php'; ?>
</body>
</html>