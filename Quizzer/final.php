<?php 
include_once 'db/connect2.php';
include_once 'includes/header.php'; 
$score = $_SESSION['score'];
$state4 = $_SESSION['chosedquiz'];
$limit = $_SESSION['total'];
$percent = intval($_SESSION['score']) / intval($_SESSION['total']) *100;
?>

<head> 
<style>


.containerk{
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    
}
.h1{
    padding:50px 10px;
}
.bgred{
    background-color:rgb(255, 157, 157);
}
.bggreen{
    background-color:rgb(159, 255, 167);
}
.questionview-choice{
    padding:20px 30px;
}
.questionview-text{
    padding:20px 30px;
}
p,h1{
    font-size:1.4em;
}
.container-final{
    margin-top:120px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
}
.box{
    display:flex;
    justify-content:center;
    align-items:center;

}
.btn-final{
    padding:10px 15px;
    border:none;
    color:white;
    background-color:rgb(117, 216, 255) ;
    border-radius: 3px;
    margin:10px 10px;
    text-decoration:none;
}
.btn-final:hover{
    padding:10px 15px;
    border:none;
    color:rgb(223, 223, 223);
    background-color:rgb(117, 230, 255) ;
    border-radius: 3px;
    margin:10px 10px;
    text-decoration:none;
}
progress[value] {
  width: 250px;
  height: 30px;
  margin:20px;
}
.percent{
margin:15px 0 30px 0;
margin:10px 0 25px 0;
}
.green{
color:rgb(88, 255, 88);
margin: 0 15px;
font-size:25px;
}
.blue{
color:rgb(27, 159, 211);
margin: 0 15px;
font-size:25px;
}
.orange{
color:rgb(255, 172, 77);
margin: 0 15px;
font-size:25px;
}
.red{
color:rgb(255, 106, 106);
margin: 0 15px;
font-size:25px;
}
.reaction{
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:row;
    margin:0 0 20px 0;
}
.iconn{
    font-size:46px;
}
</style>
</head>
<?php

?>
<body>
<main>
    <div class="container-final">
        <?php
        if($percent >= 80){
            echo '
            <div class="reaction green">
            <h1>Excellent!</h1>
            <i class="fas fa-smile-beam green iconn"></i>
            </div>
                ';
                $_SESSION['color'] = 'green';
        }
        if($percent > 50 && $percent < 80){
            echo '
            <div class="reaction blue">
            <h1>Nice job!</h1>
            <i class="fas fa-smile-wink blue iconn"></i>
            </div>
                ';
                $_SESSION['color'] = 'blue';
        }
        if($percent >= 25 && $percent <= 50){
            echo '
            <div class="reaction orange">
            <h1>Not bad</h1>
            <i class="fas fa-meh orange iconn"></i>
            </div>
                ';
                $_SESSION['color'] = 'orange';
        }
        if($percent < 25){
            echo '
            <div class="reaction red">
            <h1>Study harder</h1>
            <i class="fas fa-frown red iconn"></i>
            </div>
                ';
                $_SESSION['color'] = 'red';
        }
        ?>

        
        <p> Congrats ! You have completed the test </php>
        <p class="<?php echo $_SESSION['color'];?>"><?php echo $score ." correct of ". $_SESSION['total']." total" ; ?> </p>
        <div id="lifebar">
           <?php echo '<progress value="'.$score.'" max="'.$limit.'" class="scorebar"></progress>'; ?>
        </div>
        <?php
         echo '<h1 class="percent">'.$percent.'%</h1>'  ; 
        ?>  
        <div class="box">
                <?php 
                if($state4<=3){
                    echo '<a href="question.php" class="btn-final"> Take Again</a> ';
                }
                ?>
                <a href="dashboard.php?end=1" class="btn-final"> Go back to menu</a>
                <?php
                if($_SESSION['checkanswers'] == 'on'){
                    echo '<a href="correctanswers.php" class="btn-final">Check Correct Answers</a>';
                }
                ?>  
            </div>
    </div>
</main>
<?php
$quizidd = $_SESSION['chosedquiz'];
$cname = $_SESSION['username'];
$date = date('Y-m-d H:i:s');
$class = $_SESSION['userclass'];

 mysqli_report(MYSQLI_REPORT_STRICT);
 
 try
        {
            $connection = new mysqli($dbHostName, $dbHostUser,$dbHostPasswd,$dbName);
            if($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                // $query = "SELECT * FROM results WHERE quizid = $state4 AND studentname = $cname";
                $query="SELECT * FROM results WHERE quizid = '$state4' AND studentname = '$cname'";
                $results= $connection->query($query) or die($mysqli_error.__LINE__);
                $total=$results->num_rows;
                if($total < 1){
                if($connection->query("INSERT INTO results VALUES(NULL,'$cname','$percent','$date','$quizidd','$class')")){}
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
        $_SESSION['number'] = 1;
?>


<?php include_once 'includes/footer.php'; ?>