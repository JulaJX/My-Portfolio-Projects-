<?php 
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>About</title>
</head>
<body>
        <!-- Header automatyczny -->
        <header>
                   <?php 
                   if(!isset($_SESSION['logged'])){
                       echo '
                    <div class="container">
                       <div class="row rowspec">
                           <div class="col-6"><a class="a" href="dashboard.php">PHP QUIZZER</a></div>
                           <div class="col-6"><a class="logout logoutt mx-3" href="register.php">Register</a>
                           <a class="logout mx-3" href="index.php">Login</a></div>
                       </div>
                   </div>

                    ';
                    }else{
                        echo '
                        <div class="container">
                        <div class="row rowspec">
            <div class="col-4"><a class="a" href="dashboard.php">PHP QUIZZER</a></div>
            <div class="col-8"> 
            '; 
                    
            ?>
            <?php if($_SESSION['usertype'] == 'teacher'){
                echo '<a class="create-btn mx-3" href="addquiz.php">Create new Quiz</a>';
            }
            echo ' <a class="logout mx-3" href="logout.php">Logout</a><a href="account.php" class="icon2 mx-3"><i class="fas fa-user icon"></i></a></div></div>';
        }
            ?>        
        </header>

        <div class="about-cont">
        <h1 class="about-h1">About Quizzer!</h1> 
        <p class="about-p">
        It's a simple to use app created for teachers and students to provide teachers environment to test students. 
        <p>
        </div>
        <div class="about-cont2">
        <h1 class="about-h2-1">How does it work?</h1>
        <h2 class="about-h2-1">You can create 2 types of an account: </h2>
        </div>
        <div class="about-cont3">
        <div class="item2">
            <i class="fas fa-chalkboard-teacher ic"></i>
            <h2 class="about-h2">Teacher Account</h2>
            <p class="about-p">
                Teacher type of an account allows to create quizzes, deleting own quizzes and also to check on students results.
                To create that kind of account you have to own special code that you have to use while signing in.
            </p>
        </div>
       <div class="item1">
                <i class="fas fa-user-graduate ic"></i>
               <h2 class="about-h2">Student Account</h2>
            <p class="about-p">
                Has less features than teacher type.
                In register form you have to pick your class and school in order to see quizzes that teacher prepared for your class.
                Student account is created generally to take part in quizes.
            </p>
        </div>
        </div>



    <style>
    @import url('https://fonts.googleapis.com/css2?family=Secular+One&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@700&display=swap');

    .about-cont{
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        text-align:center;
        max-width:500px;
        margin: 0 auto;
        margin-top:120px;
    }
    .about-cont2{
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        text-align:center;
        max-width:600px;
        margin: 0 auto;
        margin-top:30px;
    }
    .about-cont3{
        display:flex;
        flex-direction:row;
        justify-content:center;
        align-items:center;
        text-align:center;
        max-width:800px;
        margin: 0 auto;
        margin-top:60px;
    }
    .item1{
        margin: 0 30px;
    }
    .about-span{
        color:rgb(117, 216, 255);
        font-weight:400;
        font-size:22px;
    }
    .about-span2{
        color:rgb(117, 216, 255);
        font-weight:400;
        font-size:26px;
    }
    .about-h1{
        font-size:36px;
        color: rgb(117, 216, 255)
    }
    .about-h2{
        font-size:20px;
    }
    .about-h2-1{
        font-size:30px;
        color:rgb(117, 216, 255);
    }
    .about-p{
        margin:10px;
        line-height:36px;
        color:rgb(92, 92, 92);
        font-size:20px; 
    }
    .img-about{
        border-radius:10px;
        box-shadow: 10px 20px 20px rgb(223, 223, 223);
        filter: blur(1.2px);1
    }
    .ic{
        font-size:40px;
        margin:10px 0;
    }
.create-btn{ 
    padding:10px 15px;
    border:none;
    color:white;
    background-color:rgb(143, 223, 255) ;
    border-radius: 3px;
    margin:10px 10px;
    text-decoration:none;
}
.white{
color:white;
font-weight:bold;
position:absolute;
top:30px;
right:10px;

}
.create-btn:hover{ 
    padding:10px 15px;
    border:none;
    background-color:rgb(143, 223, 255) ;
    color:rgb(223, 223, 223);
    border-radius: 3px;
    margin:10px 10px;
    text-decoration:none;
}
.a{
    font-family: 'Secular One', sans-serif;
    font-size:2em;
}
.icon2:link{
    color:white;
}
.icon2:link:hover{
    color:white;
}
.icon2:visited{
    color:white;
}
.logoutt{
    padding:10px 15px;
    border:none;
    color:white;
    border-radius: 3px;
    margin:70px 10px;
    text-decoration:none;

}
@media only screen and (max-width: 1000px){
    .about-cont{
        margin-top:200px;
    }
    .about-cont3{
        flex-direction:column;
    }
}


    </style>
</body>
</html>
<?php
include_once 'includes/footer.php';
?>