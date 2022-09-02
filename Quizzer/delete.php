<?php 
 $quizid = $_GET['id'];
 include_once 'db/connect2.php';
 mysqli_report(MYSQLI_REPORT_STRICT);
 try
        {
            $connection = new mysqli($dbHostName, $dbHostUser,$dbHostPasswd,$dbName);
            if($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                $result = $connection->query("DELETE FROM quizes WHERE id='$quizid'");
                if(!$result) throw new Exception($connection->error);

                $result = $connection->query("DELETE FROM questions WHERE quizid='$quizid'");
                if(!$result) throw new Exception($connection->error);

                $result = $connection->query("DELETE FROM choices WHERE quizid='$quizid'");
                if(!$result) throw new Exception($connection->error);

                $result = $connection->query("DELETE FROM results WHERE quizid='$quizid'");
                if(!$result) throw new Exception($connection->error);

                $connection->close();
            }
        }
        catch(Exception $e)
        {
        echo 'Server error! We apologize for inconveniences. Try to register later!';
        echo '<br>Dev inf:'.$e;
        }
        header('Location:account.php');

?>
