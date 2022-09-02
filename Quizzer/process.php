<?php
use function PHPSTORM_META\type;
include_once 'includes/header.php'; 
?>

<?php include_once 'db/connect.php'; ?>


<?php
$state3 = $_SESSION['chosedquiz'];
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;

}

if($_SESSION['number'] > $_SESSION['total']){
    $_SESSION['number'] = 0;
}

if($_POST['choice'] == $_SESSION['cChoice'])
{
    $selectChoice = 1;
}
else
{
    $selectChoice = 0;  
}


    $number = $_SESSION['number'];
    $_SESSION['number'] = $number + 1;


$query = "SELECT * FROM questions WHERE quizid = $state3 ";
$result= $mysqli->query($query) or die($mysqli_error.__LINE__);
$total=$result->num_rows;
$query = "SELECT * FROM choices WHERE questionNumber = $number AND isCorrect = 1 AND quizid = $state3 ";
$result = $mysqli-> query($query) or die ($mysqli->error.__LINE__);
$row = $result->fetch_assoc();
$correctChoice = $row['id'];
$end = $selectChoice == '1';

if($end) {
    
    $_SESSION['score']++;

}

if($total == $number){
    header("Location: final.php");
}
else{
    header("Location: question.php");
}

?>

<main>
    <div class="container">
    <   h1>Process PHP</h1>
    </div>
</main>

<?php 
include_once 'includes/footer.php'; 
?>