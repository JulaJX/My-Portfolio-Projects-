<!-- Pobieranie z bazy danych zajętych terminów -->
<?php 
 session_start();
 include_once './includes/rconnect.php';
 $busydates = array();
 mysqli_report(MYSQLI_REPORT_STRICT);
 try
        {
            $connection = new mysqli($dbHostName, $dbHostUser,$dbHostPasswd,$dbName);
            if($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                $result = $connection->query("SELECT * FROM schedule");
                if(!$result) throw new Exception($connection->error);
                $i=0;
                while($fetching = mysqli_fetch_array($result))
                {   
                    $busydates[$i] = $fetching['scheduledate'];
                    $i++;
                }

                $connection->close();
            }
        }
        catch(Exception $e)
        {
        echo 'Server error! We apologize for inconveniences. Try to register later!';
        echo '<br>Dev inf:'.$e;
        }
        print_r($busydates);
        $size = sizeof($busydates);
?>
<!-- Zapisywanie informacji w bazie danych po przeslaniu formularza-->

<?php 
if(isset($_POST['submit'])){
  $validation = true; 
  /*Walidacja imienia*/
  $uname = $_POST['nameRe'];

  if((strlen($uname)<1) || (strlen($uname)>20))
  {
    $validation=false;
  }
      /*Walidacja Nazwiska*/
      $usurname = $_POST['surnameRe'];

      if((strlen($usurname)<1) || (strlen($usurname)>20))
      {
        $validation=false;
      }
  /*Brak potrzeby walidacji emaila ze wzgledu na walidacje w rejestracji*/
  $uemail = $_SESSION['useremail'];

  /*Walidacja numeru telefonu*/
  $uphone = $_POST['phoneRe'];

  if((strlen($uphone)<1) || (strlen($uphone)>20))
  {
    $validation=false;
  }
   /*Walidacja wiadomosci*/

  $umessage = $_POST['message'];

  if((strlen($umessage)<0) || (strlen($umessage)>200))
  {
    $validation=false;
  }


  $schdate = $_POST['dateRe'];
  if((strlen($schdate)<1) || (strlen($schdate)>15))
  {
    $validation=false;
  }

  $_SESSION['reservedterm'] = $schdate;  
  


  /*Ustawianie dzisiejszej daty*/
  $date = date('d/m/y H:i:s');

  if($validation == true){
    mysqli_report(MYSQLI_REPORT_STRICT);
    try
    {
        $connection = new mysqli($dbHostName, $dbHostUser,$dbHostPasswd,$dbName);
        if($connection->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
    
            
            if($connection->query("INSERT INTO schedule VALUES(NULL,'$uname','$usurname','$uemail','$uphone','$umessage','$schdate','$date')")){}
                        else
                        {
                            throw new Exception($connection->error);
                        }
            
            $_SESSION['reserved'] = true;        
            unset($_POST);       
            $connection->close();
            header('Location:reserved.php');
        }
        
    }
    catch(Exception $e)
    {
    echo 'Server error! We apologize for inconveniences. Try to register later!';
    echo '<br>Dev inf:'.$e;
    }
  }else{
    $_SESSION['novalidation'] = "Proszę spróbować ponownie";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project K</title>
    <!--Główne style procesowane z SCSS (main.scss)-->
    <link rel="stylesheet" href="./css/main.css">
    <!--Link CDN do FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <!--NOTKA BootStrap CSS zainstalowany lokalnie poprzez NPM (Node Package Manager)-->
</head>
<body>
<?php include_once './includes/nav.php';?>
<div class="legend-container">
<h1 class="special-h1">Rezerwuj</h1>
<h3 class="special-h3">Wybierz wolny termin</h3>
  <div class="legend">
    
    <div class="leg-item" style="margin:0 5em;"><p class="legend-p">Dzisiaj</p><div class="orange-circle"></div></div>
    
    <div class="leg-item" style="margin:0 5em;"><p class="legend-p">Zajęty</p><div class="red-circle"></div></div>
     
    <div class="leg-item" style="margin:0 5em;"><p class="legend-p">Wolny</p><div class="green-circle"></div></div>
  </div>
</div>
<div class="book-cont">
<!-- Niewidzialne inputy by przekazywać zmienne Terminów z PHP do JavaScript -->
    <?php
            for($i=0;$i<$size;$i++){
                echo '
                    <input class="pass" style="display:none;" value="'.$busydates[$i].'">
                ';
            }
            
    ?>




    <div class="container">
      <div class="calendar">
        <div class="month">
          <i class="fas fa-angle-left prev"></i>
          <div class="date">
            <h1></h1>
            <p></p>
          </div>
          <i class="fas fa-angle-right next"></i>
        </div>
        <div class="weekdays">
          <div>Niedz</div>
          <div>Pon</div>
          <div>Wt</div>
          <div>Śr</div>
          <div>Czw</div>
          <div>Pt</div>
          <div>Sob</div>
        </div>
        <div class="days"></div>
      </div>
    </div>
</div>
<div class="height" id="anc"></div>

<?php if(!isset($_SESSION['logged'])){ echo '<h3 class="info">By zapisać się za pomocą formularza musisz być zalogowany</h3>';} ?>
<div class="wrapper5 <?php if(!isset($_SESSION['logged'])){ echo 'opacity';} ?>">
    <h1 class="reserve">ZAREZERWUJ TERMIN</h1>
    <form method="post" action="book.php" class="form-cal">
      <div class="equalizer">
        <div class="item2">
            <label class="label1" for="dateRe">Data</label>
            <input type="text" value="" class="input1 dataselc" name="dateRe" readonly="readonly" required>
            <i class="fa-solid fa-circle-check green hunv" style="display:none;"></i>
        </div>
        <div class="item">
            <label class="label1" for="nameRe">Imię</label>
            <input value="<?php if(isset($_SESSION['logged'])){ echo $_SESSION['username'];} ?>" readonly="readonly" name="nameRe" class="input1 <?php if(isset($_SESSION['logged'])){ echo'spec';} ?>" required>
            <i class="fa-solid fa-circle-check green" <?php if(!isset($_SESSION['logged'])){ echo'style="display:none;"';} ?>></i>
        </div>
        <div class="item">
            <label class="label1" for="surnameRe">Nazwisko</label>
            <input value="<?php if(isset($_SESSION['logged'])){ echo $_SESSION['usersurname'];} ?>" readonly="readonly" name="surnameRe" class="input1 <?php if(isset($_SESSION['logged'])){ echo'spec';} ?>" required>
            <i class="fa-solid fa-circle-check green" <?php if(!isset($_SESSION['logged'])){ echo'style="display:none;"';} ?>></i>
        </div>
        <div class="item">
            <label class="label1" for="phoneRe">Numer kontaktowy</label>
            <input value="<?php if(isset($_SESSION['logged'])){ echo $_SESSION['userphone'];} ?>" readonly="readonly" name="phoneRe" class="input1 <?php if(isset($_SESSION['logged'])){ echo'spec';} ?>" required>
            <i class="fa-solid fa-circle-check green" <?php if(!isset($_SESSION['logged'])){ echo'style="display:none;"';} ?>></i>
        </div>
         <div class="item3">
            <label class="label1" for="message">Wiadomość (Opcjonalne)</label>
            <textarea class="txtarea" name="message" rows="3" cols="35" class="input1"></textarea>
         </div>
        </div>
         <?php if(isset($_SESSION['novalidation'])){
                echo '<div class="error1">'. $_SESSION['novalidation'] .'</div>';
                unset($_SESSION['novalidation']);
            };?>
         <button class="submit-reserve <?php if(!isset($_SESSION['logged'])){echo 'disable';} ?>" name="submit" type="submit">Rezerwuj</button>
    </form>
    <?php if(!isset($_SESSION['logged'])){ echo '</div>';} ?>
<!--  Skrypt nieskończonego kalendarzu -->
<script>
const date = new Date();

const renderCalendar = () => {
  date.setDate(1);

  const monthDays = document.querySelector(".days");

  const lastDay = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDate();

  const prevLastDay = new Date(
    date.getFullYear(),
    date.getMonth(),
    0
  ).getDate();

  const firstDayIndex = date.getDay();

  const lastDayIndex = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDay();

  const nextDays = 7 - lastDayIndex - 1;

  const months = [
    "Styczeń",
    "Luty",
    "Marzec",
    "Kwiecień",
    "Maj",
    "Czerwiec",
    "Lipiec",
    "Sierpień",
    "Wrzesień",
    "Październik",
    "Listopad",
    "Grudzień",
  ];

  document.querySelector(".date h1").innerHTML = months[date.getMonth()] + ' ' + date.getFullYear();

  document.querySelector(".date p").innerHTML = 'Dziś : ' + new Date().toLocaleString();

  let days = "";

  /*Generowanie Dni w kalendarzu*/
  for (let x = firstDayIndex; x > 0; x--) {
    days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
  }
  for (let i = 1; i <= lastDay; i++) {
    if 
    (
      i === new Date().getDate() 
      && date.getMonth() === new Date().getMonth() 
      && date.getFullYear() === new Date().getFullYear()
    ) 
    {
      days += `<div class="today" style="pointer-events:none;">${i}</div>`;
    }
     else 
    {
      days += `<a href="#anc"><div><input style="display:none;" class="checks" value="${date.getFullYear()}-${date.getMonth()+1}-${i}">${i}</div></a>`;
    }
  }
  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="next-date">${j}</div>`;
    
  }
  monthDays.innerHTML = days;


  /*Weryfikacja które terminy są zajęte*/
  const busy = document.querySelectorAll(".pass");
  const checks = document.querySelectorAll(".checks");    
  let curCheck;
  for(i=0; i<checks.length; i++){
    curCheck = checks[i];
    for(g=0; g<busy.length; g++){
        if(curCheck.value == busy[g].value){
            console.log("MATCH");
            curCheck.parentElement.style.backgroundColor = "rgb(255, 87, 87)";
            curCheck.parentElement.style.pointerEvents = "none";
            
        }
    }
  }
  let instance;

  const checks2 = document.querySelectorAll(".checks");
  checks2.forEach(div => {
    instance = div.parentElement;
    instance.addEventListener("click",changeFormData);
  });
  function changeFormData(e){
    let instance2 = e.target.childNodes[0].value; 
    const DataRe = document.querySelector(".dataselc");
    DataRe.setAttribute("value",instance2);
    console.log(DataRe);
    
    setTimeout(() => {
    DataRe.classList.add("spec");
    const marky = document.querySelector(".hunv");
    marky.style.display = "flex";
    }, 600);
    
  }
};



document.querySelector(".prev").addEventListener("click", () => {
  date.setMonth(date.getMonth() - 1);
  renderCalendar();
});
document.querySelector(".next").addEventListener("click", () => {
  date.setMonth(date.getMonth() + 1);
  renderCalendar();

});

renderCalendar();
</script>


</ul>
</div>
</div>


<?php include_once './includes/footer.php';?>
<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>