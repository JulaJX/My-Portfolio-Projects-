<div class="container-results">
<?php 
$quiznamee = $_GET['quizname'];
?>
<h1>Results for <?php echo $quiznamee;?> quiz</h1>
<?php 
 include_once 'includes/header.php';
 include_once 'db/connect2.php';
 $quizid = $_GET['id'];

 mysqli_report(MYSQLI_REPORT_STRICT);
 try
        {
            $connection = new mysqli($dbHostName, $dbHostUser,$dbHostPasswd,$dbName);
            if($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                $result = $connection->query("SELECT * FROM results WHERE quizid='$quizid'");
                $total = $result->num_rows;
                if($total<1){
                    echo '<p class="alert">There is no student results for your quiz</p>';
                }
                if(!$result) throw new Exception($connection->error);
                while($fetching = mysqli_fetch_array($result))
                {   
                    echo( 
                    '
                        <div class="element">
                        <p class="e-p">Student: '.$fetching['studentname'].'</p>
                        <p class="e-p">Result: '.$fetching['result'].'</p>
                        <p class="e-p">Date: '.$fetching['date'].'</p>
                        <p class="e-p">Class: '.$fetching['class'].'</p>
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
        
?>
<?php include_once 'includes/footer.php'; ?>   
</div>
<style>
    h1{
        margin:20px;
        text-align:center;
    }
    .container-results{
        margin-top:200px;
        
    }
    .results{
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
    }
    .element{
        display:flex;
        flex-direction:row;
        justify-content:center;
        align-items:center;
        max-width:600px;
        margin: 0 auto;
        background-color:rgb(117, 216, 255);
        color:White;
        font-weight:400;
    }
    .e-p{
        margin:10px;

    }
    .alert{
        text-align:center;
        font-size:20px;
        color:red;
    }
</style>