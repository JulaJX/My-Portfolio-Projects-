<!-- Aktywowanie sesji sprawdzenie statusu zalogowania + includes -->
<?php
session_start();
include_once 'includes/header.php';
if(!isset($_SESSION['logged'])){
    header('Location:index.php');
    exit();
};
?>
<!-- ------------------------------------------------------------ -->
<!-- Odebranie danych użytkownika -->
<?php
$id = $_SESSION['userid'];
$name = $_SESSION['username'];
$type = $_SESSION['usertype'];
$login = $_SESSION['userlogin'];
?>
<!-- Nagłowek -->
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
</head>
<body>
<div class="movement">

</div>
<header>
    <div class="container2">
            <div class="colum1"><a class="a" href="dashboard.php">PHP QUIZZER</a></div>
            <div class="colum2"> 
                <a class="logout logoutt" href="about.php">About us</a>
            <?php 
                if($type == 'teacher'){
                echo '<a class="create-btn" href="addquiz.php">Create new Quiz</a>';
                }
                ?>    
            <a class="logout" href="logout.php">Logout</a><a href="account.php" class="icon2"><i class="fas fa-user icon"></i></a>
            </div>
        </div>
</header>
</body>
<style>
    .container2{
        display:flex;
        justify-content:center;
        align-items:center;
        background-color:rgb(117, 216, 255);
    }
    .colum1{
        margin-right:400px;
    }
    .colum2{
        margin-left:200px;
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
    background-color:rgb(143, 223, 255) ;
    border-radius: 3px;
    margin:50px 10px;
    text-decoration:none;

}
.logoutt:hover{ 
    padding:10px 15px;
    border:none;
    background-color:rgb(143, 223, 255) ;
    color:rgb(223, 223, 223);
    border-radius: 3px;
    text-decoration:none;
}
.movement{
    height:120px;
}
@media only screen and (max-width: 1600px){

.colum1{
        margin-right:200px;
    }
    .colum2{
        margin-left:200px;
    }
}
@media only screen and (max-width: 1300px){

.colum1{
        margin-right:100px;
    }
    .colum2{
        margin-left:100px;
    }
}
@media only screen and (max-width: 1100px){

.colum1{
        margin-right:50px;
    }
    .colum2{
        margin-left:50px;
    }
}
@media only screen and (max-width: 800px){
.container2{
    flex-direction:column;
}
.colum1{
        margin-right:0px;
    }
    .colum2{
        margin-left:0px;
    }
}
                </style>