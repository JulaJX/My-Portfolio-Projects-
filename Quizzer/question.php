<?php include_once 'includes/header.php'; ?>
<?php include_once 'db/connect.php'; ?>




<?php
$state2 = $_SESSION['chosedquiz'];
$query="SELECT * FROM questions WHERE quizid = $state2 ";
$results= $mysqli->query($query) or die($mysqli_error.__LINE__);
$total=$results->num_rows;
$number = $_SESSION['number'];

if($number==1){($_SESSION)['score']=0;}
    

$query = "SELECT * FROM questions WHERE QuestionNumber = $number AND quizid = $state2  ";
$result= $mysqli->query($query) or die($mysqli_error.__LINE__);
$question=$result->fetch_assoc();

$query = "SELECT * FROM choices WHERE questionNumber = $number AND quizid = $state2  ";
$choices = $mysqli -> query($query) or die ($mysqli-> error.__LINE__);
?>
<body>
    <main>
        <div class="box">
            
            <h1 class="h1-question">Question <?php echo $question['questionNumber']?> of <?php echo $total; ?> </h1>
            <div class="timercontainer">
            <div id="timer">Time Left: 15</div><i class="far fa-clock clock"></i>
            </div>
            <?php echo('<style> .image-div{
            background-image: url("imgs/'.$question['image'].'");
            background-size: cover;
            border-radius:1.2em;
            width:400px;
            height:250px;
            margin:40px;
            }   
            </style>') ?>
            <div class="image-div">
        
        </div>

         <?php $nb=1 ?>
            <p class="p-question"><?php echo $question['questionText'];?> </p>
            <form action="process.php" method="post">
                <ul class="choices-question">
                    <?php while($row = $choices-> fetch_assoc()): ?>
                    <li><input type="radio" name="choice" value="<?php echo $nb;?>"><?php echo "      ".$row['choiceText'];?></li>
                    <?php

                    if($row['isCorrect'] == 1){
                    $_SESSION['cChoice'] = $nb;
                    }
                    if($nb > 4){
                        $nb=1;
                    }
                    $nb++; 

                    endwhile; ?>
                </ul>
                    <input type="submit" value="Submit Answer" class="btn-question"/>
                    <input type="hidden" name="number" value="<?php echo $number;?>" />
             </form>

        
        </div>
    </main>
</div>
                </body>

<style>
    main{
     margin-top:20px;
    }
    .box{
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        text-align:center;
        
    }
    .h1-question{
        text-align:center;
        font-size:2em;
    }
    .p-question{
        text-align:center;
        font-size:1.7em;
    }
    .choices-question{
        list-style: none;
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        text-align:center;
        padding-left:0;
    }
    .btn-question    
    {
    padding:10px 15px;
    border:none;
    color:white;
    background-color:rgb(117, 216, 255);
    border-radius: 3px;
    margin-top:10px;
    }
    .clock{
        font-size:22px;
        text-align:center;
        transition:300ms ease-in;
    }
    #timer{
        font-size:20px;
        margin:10px;
        text-align:center;
        font-size:22px;
        transition:300ms ease-in;
        
    }
    .timercontainer{
        display:flex;
        justify-content:center;
        align-items:center;
        color:rgb(88, 255, 88);
    }
.orange{
color:rgb(255, 172, 77);
}
.red{
color:rgb(255, 106, 106);
}



</style>
<script>
var timeLeft = 15;
var elem = document.getElementById('timer');
var elem2 = document.querySelector(".clock");
var timerId = setInterval(countdown, 1000);

function countdown() {
    if (timeLeft == -1) {
        clearTimeout(timerId);
        nextquestion();
    } else {
        elem.innerHTML =  "Time Left: "+ timeLeft;
        timeLeft--;
        if(timeLeft < 10){
            elem.classList.add('orange');
            elem2.classList.add('orange');
        }
        if(timeLeft < 5){
            elem.classList.add('red');
            elem2.classList.add('red');
        }
    }
}

function nextquestion() {
    window.location='/process.php';
}
</script>
<?php include_once 'includes/footer.php'; ?>
