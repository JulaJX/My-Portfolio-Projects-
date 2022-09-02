<?php
include_once 'db/connect2.php';
include_once 'includes/header.php';
if($_SESSION['usertype'] == "student")
{
    header('Location:dashboard.php');
    exit();
}
?>


<main>

    <div class="max-container">

    <h1 class="lineheight"><span class="info info24"><i class="fas fa-school ic1"></i> <?php echo $_SESSION['userschool']; ?></span><span class="info info23"><i class="fas fa-users"></i> Community</span> <br>Create a Quiz</h1>
    <form class="add-questions" action="addquiz.php" method="POST" enctype="multipart/form-data">
       
        <div class="small-cont">
            <label>Quiz name <span class="info2">(1-40 characters)</span></label>
            <input type="text" name="quizname" required>
        </div>
        <div class="small-cont">
            <label>Number of questions <span class="info2">(from 1 to 20)</span></label>
            <select name="numberofquestions" required>
            <?php
            for($i=1;$i<=20;$i++){
                echo '<option value="'.$i.'">'.$i.'</option> ';
            }
            ?>   
            </select>      
        </div>
        <div class="small-cont">
            <label>Quiz image <span class="info2">(jpg,jpeg,png)</span></label>
            <input type="file" name="qimage">            
        </div>
        <div class="small-cont">
            <label>Community quiz <span class="info2">(make quiz for everyone without class restriction)</span></label>
            <input type="checkbox" name="comm" class="community" value="Yes">            
        </div> 
        <div class="small-cont">
            <label>Allow Students to check correct answers</label>
            <input type="checkbox" name="allow">            
        </div> 
        <div class="small-cont communitycontainer">
        <label class="label1" for="class">Class:</label>
        <select name="class" id="class-select">
        <?php for($b=1;$b<=4;$b++){
                $letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N");
            for($i=0; $i<14;$i++){
                echo 
                '
                <option value="'.$b.$letters[$i].'">'.$b.$letters[$i].'</option>
                ';
            }
        }     
        ?> 
        </select>
        </div>   
        
        <input type="submit" class="btn-add" name="submit-add" value="Set quiz">
    </form>

    <div class = "container-add">
    <form action="addquiz.php" method="POST" enctype="multipart/form-data" class="scf">
    

    <?php  

if(isset($_POST['numberofquestions'])){
    $_SESSION['class'] = $_POST['class'];
  
    if (isset($_POST['comm']) && $_POST['comm'] == 'Yes') 
{
    $_SESSION['comm'] = 'yes';
}
else
{
    $_SESSION['comm'] = 'no';
}   


    if(isset($_POST['allow'])){
    $_SESSION['check'] = $_POST['allow'];
    }else{
        $_SESSION['check'] = 'off'; 
    }
    $validation = true;
    $qname = $_POST['quizname'];
    $_SESSION['quiznamee'] = $_POST['quizname'];
    $qnumber = $_POST['numberofquestions'];
    //Walidacja ilości pytań
        if(($qnumber>20) || ($qnumber<1))
        {
        $validation = false;
        echo('<p class="alert">Number of questions should be from number 1 to 20</p>');
        }
    //Walidacja dlugosci nazwy quizu
        if((strlen($qname)<1) || (strlen($qname)>40))
        {
        $validation = false;
        echo('<p class="alert">Quiz name should be from 1 to 40 characters long</p>');
        }
        //Walidacja pliku
        if(is_uploaded_file($_FILES['qimage']['tmp_name'])){
            if($_FILES['qimage']['size']>10000*10000)
            {
                echo('<p class="alert">File size is too large!</p>');
                $validation = false;
            }
            $name = $_FILES['qimage']['name'];
            $_SESSION['name2'] = $_FILES['qimage']['name'];
            $read = pathinfo($name);
            $extension = $read['extension'];
            if( ($extension == "jpg") || ($extension == "png") || ($extension == "jpeg") )
            {
               
            }
            else{
                $validation=false;
                echo('<p class="alert">File extension ( '.$extension.' ) is incorrect! <br> please use file with jpg, png or jpeg extension </p>');
            }
        }
        
        
        //Końcowa walidacja statusu
        if($validation == true)
        {   
            move_uploaded_file($_FILES['qimage']['tmp_name'],
            $_SERVER['DOCUMENT_ROOT'].'/imgs/'.$_FILES['qimage']['name']);
            
            if(isset($_POST['numberofquestions']))
            {   
                
                echo('<h2 class="title-quiz2">Quiz: '.$_POST['quizname'].'</h2><br><h3 class="title-quiz">For');
                if($_SESSION['comm']=='yes'){echo ' Community';}
                if($_SESSION['comm']=='no'){echo ' class: '.$_SESSION['class'];}
                echo('</h3>');
            }

                 
                    echo('<div class="grid-container1">');
            $y=1;
            $value = $_POST['numberofquestions']; 
            $_SESSION['value'] = $value;   
            
            while($y != intval($value)+1)
            {    
                echo ' 
                <div class="grid-item">
                <h3>Question '.$y.'</h3>
                    <p>
                        <label for="questionText-'.$y.'">Question (1-90 characters) </label>
                        <input type="text" name="questionText-'.$y.'" required>
                    </p>
                    <p>
                        <label for="choice1-'.$y.'">First Answer (1-40 characters) </label>
                        <input type="text" name="choice1-'.$y.'" required>
                    </p>
                    <p>
                        <label for="choice2-'.$y.'">Second Answer (1-40 characters) </label>
                        <input type="text" name="choice2-'.$y.'" required>
                    </p>
                    <p>
                        <label for="choice3-'.$y.'">Third Answer (1-40 characters) </label>
                        <input type="text" name="choice3-'.$y.'" required>
                    </p>
                    <p>
                        <label for="choice4-'.$y.'">Fourth Answer (1-40 characters )</label>
                        <input type="text" name="choice4-'.$y.'" required>
                    </p>
                    <p>
                    <label for="correctChoice-'.$y.'">Correct Answer Number (from 1 to 4) </label>
                    <select name="correctChoice-'.$y.'" required>
                    <option value="1">1</option>   
                    <option value="2">2</option>   
                    <option value="3">3</option>   
                    <option value="4">4</option>     
                   </select>  
                    </p>
                    <p>
                    <label for="questionimage-'.$y.'">Question image (jpg,jpeg,png) </label>
                    <input type="file" name="questionimage-'.$y.'">
                </p>
                </div>
                ';
                $y+=1;
            }

            echo('</div>');
            echo('<input type="submit" class="btn-add2" name="submit-quiz" value="Create quiz"><br>');
        }
        if($validation == false)
        {
            echo('<p class="alert">Please try once again!</p>');
        }
}
       
if(isset($_POST['questionText-1'])){
        if($_SESSION['comm']=='yes'){
            $class2 = 'community';
        }else{
            $class2 = $_SESSION['class'];
        }
        $school2 = $_SESSION['userschool'];
        $check2 = $_SESSION['check'];
        $value = $_SESSION['value'];


        $b = 1;
        while($b != intval($value)+1){
        $questionTexts[] = $_POST['questionText-'.$b.'']; 
        $_SESSION['questionTexts'] = $questionTexts;
        $correctChoices[] = $_POST['correctChoice-'.$b.''];
        $choices[] = $_POST['choice1-'.$b.''];
        $choices[] = $_POST['choice2-'.$b.''];
        $choices[] = $_POST['choice3-'.$b.''];
        $choices[] = $_POST['choice4-'.$b.''];
        $b+=1;
        }





        
        $p=1;
        while($p <= 20){
        if(isset($_POST['choice1-'.$p.''])){
            $_SESSION['choice1-'.$p.''] = $_POST['choice1-'.$p.''];
        }
        if(isset($_POST['choice2-'.$p.''])){
            $_SESSION['choice2-'.$p.''] = $_POST['choice2-'.$p.''];
        }
        if(isset($_POST['choice3-'.$p.''])){
            $_SESSION['choice3-'.$p.''] = $_POST['choice3-'.$p.''];
        }
        if(isset($_POST['choice4-'.$p.''])){
            $_SESSION['choice4-'.$p.''] = $_POST['choice4-'.$p.''];
        }
        if(isset($_POST['correctChoice-'.$p.''])){
            $_SESSION['correctChoice-'.$p.''] = $_POST['correctChoice-'.$p.'']; 
        }

        $p++;
    }


            /*Nawiązywanie Połaczenie z bazą (Wyciszanie błedu metodą TRY CATCH)*/

            mysqli_report(MYSQLI_REPORT_STRICT);
            try
            {
                $connection = new mysqli($dbHostName, $dbHostUser,$dbHostPasswd,$dbName);
                if($connection->connect_errno!=0){
                    throw new Exception(mysqli_connect_errno());
                }
                else
                {
                    $validation2 = true;
                    
                    //Walidacja plików
                        $x=1;
                        while($x != intval($value)+1){
                            
                            if(is_uploaded_file($_FILES['questionimage-'.$x.'']['tmp_name'])){
                                if($_FILES['questionimage-'.$x.'']['size']>10000*10000){
                                    $validation2 = false;
                                    $_SESSION['error3'] = "File size is too large!";
                                }
                                $name = $_FILES['questionimage-'.$x.'']['name'];
                                $read = pathinfo($name);
                                $extension = $read['extension'];
                                if( ($extension == "jpg") || ($extension == "png") || ($extension == "jpeg") ){
                                   
                                }
                                else{
                                    $validation2=false;
                                    $_SESSION['error4'] = '<p class="alert">File extension ( '.$extension.' ) is incorrect! <br> please use file with jpg, png or jpeg extension </p>';
                                }
                            }

                        $x+=1;
                        }


                    //Walidacja innych inputów
                    foreach($questionTexts as $check){
                        if((strlen($check)<1)||(strlen($check)>90)){
                            $validation2 = false;
                            $_SESSION['error2'] = "Questions should be from 1 to 90 characters long";
                        }
                    }
                    foreach($correctChoices as $check){
                        if((intval($check)<1)|| (intval($check)>4)){
                            $validation2 = false;
                            $_SESSION['error5'] = "Correct Answer should be from number 1 to 4";
                        }
                    }
                    foreach($choices as $check){
                        if((strlen($check)<1)|| (strlen($check)>40)){
                            $validation2 = false;
                            $_SESSION['error6'] = "Answers should be from 1 to 40 characters long";
                        }
                    }
                    
                
                    if($validation2 == true)
                    {
                        $result = $connection->query("SELECT * FROM quizes WHERE id = (SELECT MAX(id) FROM quizes)");
                        while($fetching = mysqli_fetch_array($result)){
                            $quizidd = intval($fetching['id'])+1;
                        }
                        //wysyłanie zdjęć do plików lokalnych
                            $h=1;
                            $value3 = $_SESSION['value'];     
                        while($h <= intval($value3))
                            {
                                if(is_uploaded_file($_FILES['questionimage-'.$h.'']['tmp_name'])){   
                                    move_uploaded_file($_FILES['questionimage-'.$h.'']['tmp_name'],
                                    $_SERVER['DOCUMENT_ROOT'].'/imgs/'.$_FILES['questionimage-'.$h.'']['name']);
                                }
                                $h++;
                            }
                        //dane do tabeli quizes 
                        $qname = $_SESSION['quiznamee'];
                        $uname = $_SESSION['username'];

                        if(isset($_SESSION['name2'])){
                        $file = $_SESSION['name2'];
                        }else{
                            $file = 'default.png';
                        }
                
                        
                        if($connection->query("INSERT INTO quizes VALUES('$quizidd','$qname','$uname','$file','$class2','$check2','$school2')")){}
                        else{
                            throw new Exception($connection->error);
                        }
                        unset($_SESSION['name2']);
                        //dane do tabeli questions

                        $k = 1;
                        $number = 1;
                        $f = 0;
                        while($k <= intval($value3))
                        {   
                            $questionimage = $_FILES['questionimage-'.$k.'']['name'];
                            if($questionimage == ''){
                                $questionimage = 'default.png';
                            }
                            if($connection->query("INSERT INTO questions VALUES(NULL,'$number','$questionTexts[$f]','$quizidd','$questionimage')")){}
                            else{
                                throw new Exception($connection->error);
                            }


                            if($number == $value3){
                                $number = 0;
                            }
                            $k++;
                            $number++;
                            $f++;
                        }
                        //dane do tabeli choices 
                        
                        $z=1;
                        $number=1;
                        $instance = 0;
                        while($z <= intval($value3))
                        {
                            $correctChoice = $_SESSION['correctChoice-'.$z.''];
                            for($d=1; $d<5;$d++){
                            $choiceText = $_SESSION['choice'.$d.'-'. $z .''];
                            if($d == $correctChoice){
                                $instance = 1;
                            }
                            if($connection->query("INSERT INTO choices VALUES(NULL,'$number','$instance','$choiceText','$quizidd')")){}
                            else
                            {
                                throw new Exception($connection->error);
                            }    
                            $instance=0;                 
                        }
                        if($number == 20){
                            $number = 0;
                        }
                        $number++;
                            $z++;
                        }
                        //Reset Sesji 
                        $p=1;
                        while($p <= intval($value3)){
                                unset($_SESSION['choice1-'.$p.'']);
                                unset($_SESSION['choice2-'.$p.'']);
                                unset($_SESSION['choice3-'.$p.'']);
                                unset($_SESSION['choice4-'.$p.'']);
                                unset($_SESSION['correctChoice-'.$p.'']); 
                        $p++;
                         }

                        
                         
                        $_SESSION['infoadd'] = '<div class="cont">
                                                    <div class="item">
                                                        Quiz '.$qname.' has been added successfully! <br> for students dashboard for '.$class2.'
                                                    </div>
                                                    <i class="fas fa-check ico"></i>
                                                </div> ';
                    }
                    else
                    {
                        echo('<p class="alert">Please try once again!</p>');
                    }
                    if(isset($_SESSION['infoadd'])){
                        echo('<p class="infoadd"> '.$_SESSION['infoadd'].'</p>');
                        unset($_SESSION['infoadd']);
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
            </form>
            
                            <div class="centera">
            <?php

                                if(isset($_SESSION['error'])){
                                    echo('<p class="alert"> '.$_SESSION['error'].'</p>');
                                    unset($_SESSION['error']);
                                }
                                if(isset($_SESSION['error2'])){
                                    echo('<p class="alert"> '.$_SESSION['error2'].'</p>');
                                    unset($_SESSION['error2']);
                                }
                                if(isset($_SESSION['error3'])){
                                    echo('<p class="alert"> '.$_SESSION['error3'].'</p>');
                                    unset($_SESSION['error3']);
                                }
                                if(isset($_SESSION['error4'])){
                                    echo('<p class="alert"> '.$_SESSION['error4'].'</p>');
                                    unset($_SESSION['error4']);
                                }
                                if(isset($_SESSION['error5'])){
                                    echo('<p class="alert"> '.$_SESSION['error5'].'</p>');
                                    unset($_SESSION['error5']);
                                }
                                if(isset($_SESSION['error6'])){
                                    echo('<p class="alert"> '.$_SESSION['error6'].'</p>');
                                    unset($_SESSION['error6']);
                                }
                                unset($_SESSION['community']);
                                
            ?>
                        </div>
        </div>
    </div>
</main>
<?php
include_once 'includes/footer.php';
?>

<script>
 const checkbox = document.querySelector(".community");
 const classContainer = document.querySelector(".communitycontainer");
 const info1 = document.querySelector(".info24");
 const info2 = document.querySelector(".info23");
 checkbox.addEventListener("click",clicked);
 function clicked() {
    classContainer.classList.toggle("display-none");
    info2.classList.toggle("info23");
    info1.classList.toggle("display-none");
 }
</script>

<style>
    .info23{
        display:none;
    }
    .display-none{
        display:none;
    }
    .centera{
        display:flex;
        align-items:center;
        justify-content:center;
        flex-direction:column;
        text-align:center;
    }
    .max-container{
        margin-top:110px;
        text-align:center;
    }
.btn-add{
    padding:10px 15px;
    border:none;
    color:white;
    background-color:rgb(117, 216, 255) ;
    border-radius: 3px;
    margin-top:10px;
}
.btn-add2{
    padding:10px 15px;
    border:none;
    color:white;
    background-color:rgb(117, 216, 255) ;
    border-radius: 3px;
    margin-top:10px;
}
.container-add{
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
}
.add-questions{
    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction:column;
}
.small-cont{
    margin:10px;
}
.grid-container1{
    display:grid;
    grid-template-columns: 1fr 1fr;
    justify-content:center;
    align-items:center;
    margin-bottom:20px;
}
.grid-item{
    text-align:center;
    padding:20px 20px;
    margin:10px 20px;
    background-color:rgb(245,245,245);
    border-radius:2em;

}
.scf{
    border-radius:120px;
    margin-top:20px;
}
.title-quiz{
    margin-bottom:15px;

}
.title-quiz2{
    
}
.ic1{
    font-size:40px;
}
.alert{
color:red;
font-weight:bold;
}
.info{
    color:rgb(117, 216, 255);
}
.info2{
    color:rgb(117, 216, 255);
    font-weight:600;
}
.cont{
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    background-color:rgb(103, 255, 103);
    padding:10px 30px;
    text-align:center;
    font-size:20px;
    border-radius:30px;
    }
    .item{
        margin:0 40px 0 0;
    }
    .ico{
        font-size:35px;
    }
    .lineheight{
        line-height:70px;
    }
@media only screen and (max-width: 1000px){

.grid-container1{
    grid-template-columns:1fr;
}
}
</style>