<?php include_once 'includes/header.php';
include_once 'db/connect2.php';
$state4 = $_SESSION['chosedquiz'];
$limit = $_SESSION['total']; ?>


<div class="containerk" id="anc">
<h3 class="h1">Correct Answers:</h3>
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
                            $result = $connection->query("SELECT * FROM questions WHERE quizid='$state4'");
                            if(!$result) throw new Exception($connection->error);
                            $g=1;
                            while($fetching = mysqli_fetch_array($result))
                            {   
                                echo '
                                
                                    <h3 class="questionview-text">'.$fetching['questionText'].'</h3>
                                ';
                                
                                $result2 = $connection->query("SELECT * FROM choices WHERE quizid='$state4' AND questionNumber='$g'");
                                if(!$result2) throw new Exception($connection->error);
                                while($fetching2 = mysqli_fetch_array($result2))
                                {
                                    if($fetching2['isCorrect'] == 1){
                                        $special = "bggreen";
                                    }else{
                                        $special = "bgred";
                                    }
                                    echo '

                                    <p class="questionview-choice '.$special.'">
                                        '.$fetching2['choiceText'].'
                                    </p>
                                    ';
                                }
                                $g++;
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
<style>


.containerk{
    margin-top:10px;
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
    border-radius:20px;
}
.bggreen{
    background-color:rgb(159, 255, 167);
    border-radius:20px;
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


</style>
<?php include_once 'includes/footer.php'; ?>