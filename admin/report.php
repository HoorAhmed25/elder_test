<?php 
session_start(); require_once '../connection.php';

function govern() {
  global $conn;
  $gov = '';

  $sql = "SELECT * FROM governorate";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    $gov = $gov . '"' . $row['name'] . '",';
  }

  $gov = trim($gov,",");
  return $gov;

}

function data() {
  global $conn;

  $x1 = array();
  $x2 = array();

  $govern = '';
  $cust = '';
  $data = '';
  
  

  $countX1 = 0;
  $countX2 = 0;

  $sql1 = "SELECT * FROM governorate";
  $result = mysqli_query($conn, $sql1);

  while ($row = mysqli_fetch_array($result)) {
    $x1[] = $row['name'];
    $countX1++;
  }


  $sql = "SELECT * FROM test";
  $results = mysqli_query($conn, $sql);

  while ($rows = mysqli_fetch_assoc($results)) {
    $x2[] = $rows['governorate'];
    $countX2++;
  }
  

  $db = array();
  $counter = 0;

  for ($i=0; $i<$countX1; $i++) {
    
    $govern = $x1[$i];
    $govern = trim($govern);
  
    for ($j=0; $j<$countX2; $j++) {
      
      $cust = $x2[$j];
      $cust = trim($cust);

      if ($govern == $cust) {
        $counter++;
      } else {
        $counter = $counter;
      }
    }
    $db[] = $counter;
    $counter = 0;
  }

  $dbLength = count($db);
  $v = 0;
  while ($v < $dbLength) {
    $data = $data . '"' . $db[$v] . '",';
    $v++;
  }

  $data = trim($data,",");
  return $data;  
  
}

function gender() {
  global $conn;

  $x1 = array('ذكر', 'أنثى');
  $x2 = array();

  $male = '';
  $female = '';
  $data = '';
  
  
  $countX2 = 0;


  $sql = "SELECT * FROM test";
  $results = mysqli_query($conn, $sql);

  while ($rows = mysqli_fetch_assoc($results)) {
    $x2[] = $rows['gender'];
    $countX2++;
  }
  

  $db = array();
  $counter = 0;

  for ($i=0; $i<2; $i++) {
    
    $male = $x1[$i];
    $male = trim($male);

  
    for ($j=0; $j<$countX2; $j++) {
      
      $female = $x2[$j];
      $female = trim($female);


      if ($male === $female) {
        $counter++;
      } else {
        $counter = $counter;
      }
    }
    $db[] = $counter;
    $counter = 0;
  }

  $dbLength = count($db);
  $v = 0;
  while ($v < $dbLength) {
    $data = $data . '"' . $db[$v] . '",';
    $v++;
 
  }

  $data = trim($data,",");
  return $data;  
  
}


?>

<html dir="rtl">

<head>
 <title>وزارة الصحة و السكان - مبادرة فحص و علاج الامراض المزمنة</title>

  <meta charset="UTF-8">
  <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/all.min.css">
  <link rel="stylesheet" href="../css/animate.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <script src="../js/chart.min.js"></script>
  <script src="../js/palette.js"></script>
  <style>
  p {
    font-size: 27px;
    font-weight: 400;
  }

  #container {
    margin: 5% 7% 0% 0%;
    padding-top: 2%;
    width: 85%;
    background-color: white;
    border: solid 2px gray;
    border-radius: 20px;
    box-shadow: 1px 2px 1px 2px #888888;
  }

  #container:hover {
    box-shadow: 3px 4px 3px 4px #888888;
  }

  .container {
    margin-bottom: 100px;
    margin-right: 5%;
  }
  </style>
</head>

<body>
  <nav> 
        <div class="row">
        <div class="col-1"><img src="../img/Ministry_of_Health_and_Population_of_Egypt.png" class="img-fluid" style="height:75px;  margin-top:10px;"/></div>
            <div class="col-4">
             
            <h6 class="text-white" style=" font-weight: bold;">
                  <br>جمهورية مصر العربية
                 <br>وزارة الصحة و السكان
              
                </h6>
            
            </div>
            <div class="col-5"></div>
      <div class="dropdown show d-inline">
  <a class="h3 dropdown-toggle float-left ml-4 mt-4 text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo $_SESSION['name']; ?> 
  </a>

  <div class="dropdown-menu float-left" aria-labelledby="dropdownMenuLink">
           <a class="dropdown-item text-center border-bottom" href="home.php">الرئيسية</a>
      <a class="dropdown-item text-center border-bottom" href="total.php">متابعة</a>
      <a class="dropdown-item text-center border-bottom" href="admin.php">الإدارة</a>
    <a class="dropdown-item text-center" href="../index.php">تسجيل خروج</a>
    
  </div>
</div>
            
            </div>
		
       
		</nav>


  <div id="container" class="title text-center text-dark border-bottom mb-3">

    <div id="bar">
      <h2 class="heading mb-4">اعداد المرضى طبقا للمحافظات</h2>

      <canvas id="myChart" width="50%" height="20%"></canvas>
      <script>
      var ctx = document.getElementById('myChart');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [<?php echo govern(); ?>],
          datasets: [{
            label: 'اعداد المرضى',
            data: [<?php echo data(); ?>],
            backgroundColor: [
              'rgba(230, 194, 96, 0.8)',
            ],
            borderColor: [
              'rgb(230, 194, 96)',
            ],
            borderRadius: 10,
            barThickness: 30,
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
      </script>

    </div>

    <br /><br /><br />
    <hr />
    <br /><br /><br />
    <div class="container">

      <div class="row">
        <div class="col-5">
          <h2 class="heading mb-5">النوع</h2>
          <div id="pie1">


            <canvas id="charts" height="300px" width="300px"></canvas>

            <script>
            var chart = document.getElementById('charts');
            var charts = new Chart(chart, {
              type: 'doughnut',
              data: {
                labels: ['ذكر', 'انثى'],
                datasets: [{
                  data: [<?php echo gender(); ?>],
                  backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 99, 132, 0.8)'

                  ],
                  borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                  ],
                  borderRadius: 5,
                  radius: 180,

                }]
              },
              options: {
                plugins: {
                  legend: {
                    position: 'top',
                  }
                },

              }
            });
            </script>
          </div>



        </div>
        <div class="col-2"></div>
     


      </div>

    </div>

  </div>






    <footer>
        <p style="font-size:19px;"> &copy; 2021 جميع الحقوق محفوظة لوزارة الصحة و السكان المصرية. </p>
        
        </footer>
  <script>
  var x = 170;
  var y = 170 % 11;
  console.log(y);
  </script>
  <script src="../js/jquery-3.3.1.min.js"></script>

  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/wow.min.js"></script>
  <script>
  new WOW().init();
  </script>
  <script src="../js/mine.js"></script>
</body>

</html>