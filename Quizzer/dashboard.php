<?php 
 include_once 'db/connect2.php';
 include_once 'includes/header.php';
 if(isset($_GET['end'])){
     unset($_SESSION["chosedquiz"]);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
<div class="bg">
<h2 class="tryour">Hello, <?php echo $_SESSION['username']; echo'<br>'?></h2> <p class="hp">Click <a href="#anc" class="blue">here</a> to check quizzes created for your class!</p>
</div>
<h2 class="tryour3">Try one of our quizzes!</h2>

<div class="quiz-container">  
<?php

 mysqli_report(MYSQLI_REPORT_STRICT);
 try
        {
            $connection = new mysqli($dbHostName, $dbHostUser,$dbHostPasswd,$dbName);
            if($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                $result = $connection->query("SELECT * FROM quizes WHERE id<4");
                if(!$result) throw new Exception($connection->error);
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
                    <a class="quizgo" href="quiz.php?id='.$fetching['id'].'">
                    <div class="box" quiz-card">
                    <div class="w'.$i.' quiz-card"></div>
                        <h1 class="quiz-h1">'.$fetching['quizname'].'</h1>
                        <h2 class="quiz-h2">Author: '.$fetching['quizauthor'].'</h1>
                    </div>
                    </a>
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
?>
</div>
<h2 class="tryour3">Quizes created by community!</h2>
<div class="quiz-container">  
<?php

 mysqli_report(MYSQLI_REPORT_STRICT);
 try
        {
            $connection = new mysqli($dbHostName, $dbHostUser,$dbHostPasswd,$dbName);
            if($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                $result = $connection->query("SELECT * FROM quizes WHERE id>3 AND class='community'");
                if(!$result) throw new Exception($connection->error);
                $total2=$result->num_rows;
                $i=1222342;
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
                    <a class="quizgo" href="quiz.php?id='.$fetching['id'].'">
                    <div class="box" quiz-card">
                    <div class="w'.$i.' quiz-card"></div>
                        <h1 class="quiz-h1">'.$fetching['quizname'].'</h1>
                        <h2 class="quiz-h2">Author: '.$fetching['quizauthor'].'</h1>
                    </div>
                    </a>
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
?>
</div>
    <?php
        if($total2==0)
        {
            echo "<h3 class='grey' id='anc'>There are no community quizzes created yet</h3>";
        }
    ?>
<div class="colors">
<div class="didyouknow">
<h1 class="h1de">Random fun fact</h1>
<h3 class="h1d">Did you know that ?</h3>
<?php
try
        {
            $connection = new mysqli($dbHostName, $dbHostUser,$dbHostPasswd,$dbName);
            if($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                $idf = rand(1,40);
                $result = $connection->query("SELECT * FROM interestingfacts WHERE id='$idf'");
                if(!$result) throw new Exception($connection->error);
                while($fetching = mysqli_fetch_array($result))
                {   
                    
                    echo( 
                    '
                    <p class="interestingfacts">'.$fetching['content'].'</p>
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
?>

</div>
</div>
<h2 class="tryour2">Quizes created by teachers for <span class="blue"><?php echo $_SESSION['userclass']?></span> class</h2>
<div class="quiz-container2">
<?php

        try
        {
            $connection2 = new mysqli($dbHostName, $dbHostUser,$dbHostPasswd,$dbName);
            if($connection2->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                $school = $_SESSION['userschool'];
                $class = $_SESSION['userclass'];
                $result = $connection2->query("SELECT * FROM quizes WHERE id>3 AND class='$class' AND school='$school'");
                $total=$result->num_rows;
                if(!$result) throw new Exception($connection2->error);
                
                $i=4;
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
                    <a class="quizgo" href="quiz.php?id='.$fetching['id'].'">
                    <div class="box" quiz-card" id="anc">
                    <div class="w'.$i.' quiz-card"></div>
                        <h1 class="quiz-h1">'.$fetching['quizname'].'</h1>
                        <h2 class="quiz-h2">Author: '.$fetching['quizauthor'].'</h1>
                    </div>
                    </a>
                    ' 
                    );

                }

                $connection2->close();
            }
        }
        catch(Exception $e)
        {
        echo 'Server error! We apologize for inconveniences. Try to register later!';
        echo '<br>Dev inf:'.$e;
        }

    
 ?> 
 
    </div>
    <?php
        if($total==0)
        {
            echo "<h3 class='grey' id='anc'>Teacher didn't create quizes for your class</h3>";
        }
    ?>
<style>
.colors {
     background-color: rgb(117, 216, 255);
     color:White;
     margin-top:230px;
     min-height:200px;
     
}
.interestingfacts{
    font-size:20px;
}

.bg{
    background-color:rgba(1,1,1,0.03);
    
}
.bg:hover{
    background-color:rgba(1,1,1,0.05);
    
}
.quiz-container{
margin-top:20px;
max-width:900px;
margin:30px auto;
display:grid;
grid-template-columns:1fr 1fr 1fr;
justify-content:center;
align-items:center;
}
.quiz-container2{
margin-top:20px;
max-width:900px;
margin:30px auto;
display:grid;
grid-template-columns:1fr 1fr 1fr;
justify-content:center;
align-items:center;
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
    display:flex;
    justify-content:center;
    align-items:center;
    text-decoration:none;
    border-radius:1.1em;
}
.quizgo:hover{
    background-color:rgb(223, 223, 223);
    transition:200ms ease-in;
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
.tryour{
    margin-top:150px;
    text-align:center;
    color:rgb(83, 83, 83);
    padding:20px 0 0 0;
}
.tryour3{
    margin-top:50px;
    text-align:center;
    color:rgb(83, 83, 83);
}
.tryour2{
    margin-top:180px;
    text-align:center;
    color:rgb(83, 83, 83);
}
.blue{
    color:rgb(117, 216, 255);
    font-weight:bold;
    text-decoration:none;
}
.hp{
    font-size:20px;
    text-align:center;
    padding:0 0 20px;
}
.didyouknow{
    margin:120px auto;
    text-align:center;
    padding:20px;
    max-width:600px;

}
.h1d{
    margin:20px;
    font-size:20px;
}
.grey{
    color:red;
    font-size:20px;
    text-align:center;
    margin-bottom:300px;
}
@media only screen and (max-width: 1000px){
    .quiz-container{
    grid-template-columns:1fr;
}  
.quiz-container2{
    grid-template-columns:1fr;
}  
}
header{
        background-color:rgb(117, 216, 255);
    }
</style>

<?php
include_once 'includes/footer.php';
?>
</body>
</html>