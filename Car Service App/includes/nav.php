
<header style="z-index:100;">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid py-2">
    <a class="navbar-brand mx-5" href="#">LOGO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active mx-5" aria-current="page" href="index.php">O nas</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mx-5" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Umów się
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="book.php"><i class="fa-solid fa-calendar-check ico3"></i>Rezerwuj</a></li>
            <li><a class="dropdown-item" href="contact.php"><i class="fa-solid fa-phone ico3"></i>Kontakt</a></li>            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-tag ico3"></i>Cennik</a></li>
          </ul>
        </li>
      </ul>
      <?php 
      if(!isset($_SESSION['logged'])){
        echo'
        <a href="register.php" class="btn btn-outline-success m-2 nav-c">Zarejestruj się</a>
        <a href="login.php" class="btn btn-outline-success m-2 nav-c">Zaloguj się</a>        
        ';
      }
      if(isset($_SESSION['logged'])){
        if($_SESSION['useremail']=="admin@example.com"){
        echo'
        <a href="adminpanel.php" class="btn btn-outline-primary m-2 nav-c">Panel Admina</a> 
        ';
        }
      }
      if(isset($_SESSION['logged'])){
        echo'
        <a href="includes/logout.php" class="btn btn-outline-primary m-2 nav-c">Wyloguj</a> 
        <a href="account.php"><i class="fa-solid fa-user ico"></i></a>     
        ';
      }
      ?>

   
    </div>
  </div>
</nav>
</header>