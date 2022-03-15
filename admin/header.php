<?php session_start();if(empty($_SESSION['Login']) || $_SESSION['Login'] == ''){
    header("Location: ../index.php");
    die();
} else{include '../connection.php'; ?><html dir="rtl">

<head>
    <title>وزارة الصحة و السكان</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/Ministry_of_Health_and_Population_of_Egypt.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
        body{
            font-family: 'Cairo', sans-serif; !important
        }
    .backButton{
    background-color: dimgray;
    margin-top: 10px;
}
.backButton a{
    text-decoration: none;
    color: white;
    
}
.backButton:hover{
    background-color: #6a7575;
}
    </style>
</head>
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
    <a class="dropdown-item text-center " href="../index.php">تسجيل خروج</a>
    
  </div>
</div>
            
            </div>
		
       
		</nav>
</html>
<?php
      }
       ?>