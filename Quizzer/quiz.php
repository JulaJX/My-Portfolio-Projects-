<?php
include_once 'db/connect.php';
include_once 'includes/header.php';
$state = strval($_GET['id']);
$_SESSION['chosedquiz'] = $state;
$_SESSION['number'] = 1;

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit-no">
    <link rel="stylesheet" href="style.css">
    <title>Quiz</title>
</head>

<body>
    <div class="quiz-menu">
        <?php
            $query='SELECT * FROM questions WHERE quizid='.strval($state).' ';
            $results= $mysqli->query($query) or die($mysqli_error.__LINE__);
            $total=$results->num_rows;
            $_SESSION['total'] = $total;
            $query='SELECT * FROM quizes WHERE id='.strval($state).' ';
            $results= $mysqli->query($query) or die($mysqli_error.__LINE__);
            while($fetching = mysqli_fetch_array($results)){
            $name = $fetching['quizname'];
            $_SESSION['checkanswers'] = $fetching['allow'];
            echo('
            <style>
            .magic
            {
                background-image: url("imgs/'.$fetching['quizbg'].'");
                background-repeat: no-repeat;
                background-size: cover;
                padding:90px 150px;
                display:flex;
                align-items:center;
                justify-content:center;
                flex-direction:column;
                border-radius:20px;
            }
            
            </style>');
            }
        ?>

        <main>
            <div class="box">
            <div class="magic"></div>
            <div class="move">
            <h2><?php echo $name;?></h2>
                <ul>
                    <li><strong> Number of Questions: </strong><?php echo $total;?> </li>
                    <li><strong> Type Of Quiz: </strong> Multiple Choice</li>
                    <li><strong> Estimated time: </strong><?php echo $total * 0.25; ?> Minutes </li>
                </ul>
                <?php if($_SESSION['chosedquiz']>3){echo '<p class="infoo">Reminder: Only your first try will be saved in teacher result</p>';} ?>
                <?php echo '<a href="question.php" class="btn">Start Quiz</a>' ?>
            </div>
            </div>
        </main>
        <?php
include_once 'includes/footer.php';
             
?>
        <style>
            li,h2{
                color:black;
                margin:10px;
            }
            .box{
                background-color: rgba(0,0,0,0.1);
                height:550px;
                display:flex;
                align-items:center;
                justify-content:center;
                flex-direction:column;
                margin:0 auto 0 auto;
                max-width:550px;
                border-radius:10px;
            }
            .infoo{
                color:red;
                font-size:16px;
                font-weight:700;
                text-align:center;
            }
            .move{

                display:flex;
                align-items:center;
                justify-content:center;
                flex-direction:column;
                border-radius:30px;
                font-size:20px;
                border-radius:20px;
                color:black;

            }

            .btn{
                padding:8px 30px;
                background-color: rgb(117, 216, 255);
                color:white;
                border-radius:5px;
            }
        </style>
</body>
