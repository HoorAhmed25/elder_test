<?php session_start();if(empty($_SESSION['Login']) || $_SESSION['Login'] == ''){
    header("Location: ../index.php");
    die();
} else{include '../connection.php'; ?><html dir="rtl">

   <head>
      <title>وزارة الصحة و السكان - مبادرة فحص و علاج الامراض المزمنة</title>
       <meta charset="UTF-8">
        <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
      <link rel="stylesheet" href="../css/all.min.css">
      <link rel="stylesheet" href="../css/animate.css">
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/font-awesome.min.css">
       <link rel="stylesheet" href="../css/style.css">
       <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
       <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

       <style>
       @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
body{
     font-family: 'Cairo',sans-serif; !important
    color: white;
           }
        .nav-item a{
               color: black;
               text-decoration: none;
               text-align: right;
               font-size: 16px;
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
    <a class="dropdown-item text-center " href="../index.php">تسجيل خروج</a>
    
  </div>
</div>
            
            </div>
		
       
		</nav>
          <ul class="nav nav-tabs pt-3">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">الرئيسية</a>
  </li>
               <li class="nav-item">
    <a class="nav-link" aria-current="page" href="elder.php">استعلام</a>
  </li>
                <li class="nav-item">
    <a class="nav-link" aria-current="page" href="edit.php">تعديل بيانات مريض</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" id="reports">التقارير</a>
    <ul class="dropdown-menu" aria-labelledby="reports">
      <li><a class="dropdown-item border-bottom" href="all.php">تقرير بعدد المترددين و الذين يجمعون بين الامراض المزمنة</a></li>
      <li><a class="dropdown-item border-bottom" href="total.php">تقرير بعدد المترددين و الذين يعانون من امراض مزمنة</a></li>
      <li><a class="dropdown-item border-bottom" href="not.php">تقرير  بعدد المترددين و الذين لا يعانون من امراض مزمنة</a></li>
     <li><a class="dropdown-item border-bottom" href="gender.php">تقرير بعدد المترددين و الذين يعانون من امراض مزمنة طبقاً للنوع</a></li>
      <li><a class="dropdown-item border-bottom" href="age.php">تقرير بعدد المترددين و الذين يعانون من امراض مزمنة طبقاً للفئة العمرية</a></li>
      <li><a class="dropdown-item border-bottom" href="bmi.php">تقرير بعدد المترددين طبقاً لمؤشر كتلة الجسم </a></li>
          <li><a class="dropdown-item" href="monthly.php">تقرير اداء المستخدمين</a></li>
    </ul>
  </li>
                  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" id="dashboard"> الإحصائيات </a>
    <ul class="dropdown-menu" aria-labelledby="dashboard">
      <li><a class="dropdown-item" href="dashboard.php">إحصائيات عامة</a></li>
    </ul>
  </li>

              <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" id="setting"> الإعدادات العامة </a>
    <ul class="dropdown-menu" aria-labelledby="setting">
      <li><a class="dropdown-item" href="admin.php">إضافة مستخدم جديد</a></li>
    </ul>             
  </li>
              
            
</ul>
       <?php
         $ins="SELECT count(ID) as total,sum(case when diabetes = 'نعم' then 1 else 0 end) as diabetes,sum(case when bloodpressure = 'نعم' then 1 else 0 end) as bloodpressure,sum(case when egfr != '0' and creatinine != '0' then 1 else 0 end) as egfr,sum(case when hba != '0' then 1 else 0 end) as hba,sum(case when ldl != '0' and hdl != '0' and triglycerides != '0' and cholesterol != '0' then 1 else 0 end) as ldl FROM test";
        $query= mysqli_query($conn,$ins) or die("error:".mysqli_error($conn));
        $result = mysqli_fetch_array($query);
       
       ?>
      <div class="mr-5 ml-5 mt-5" style=" height: 520px;" >
		  <div class="row" style="margin-right:15%;">
                 <div class=" col-3 ml-3 pt-4" style="background-color:#BDB089; font-size:20px; height: 150px; border-top-right-radius: 20px; border-bottom-left-radius: 20px;">
                     <p class="text-center text-white font-weight-bold">إجمالى المترددين للمبادرة</p>
                     <p class="text-center text-white font-weight-bold">(<?php echo $result['total']; ?>)</p>
		  </div>
              <div class=" col-3 ml-3 pt-4" style="background-color:#948655; font-size:20px; height: 150px; border-top-right-radius: 20px; border-bottom-left-radius: 20px;">
		              <p class="text-center text-white font-weight-bold">إجمالى فحوصات سكر</p>
                     <p class="text-center text-white font-weight-bold">(<?php echo $result['diabetes']; ?>)</p>
		  </div>
                   
              <div  class=" col-3 pt-4" style="background-color:#84690c; font-size:20px; height: 150px; border-top-right-radius: 20px; border-bottom-left-radius: 20px;">
		             <p class="text-center text-white font-weight-bold">إجمالى فحوصات ضغط الدم</p>
                     <p class="text-center text-white font-weight-bold">(<?php echo $result['bloodpressure']; ?>)</p>
		  </div>
			  </div>
              <div class="row" style="margin-right:15%;">
              <div  class="col-3 ml-3 mt-5 pt-4" style="background-color:#c6c6c3; height: 150px; font-size:20px; border-top-right-radius: 20px; border-bottom-left-radius: 20px;">
		             <p class="text-center text-white font-weight-bold">إجمالى تم كشف كُلى</p>
                     <p class="text-center text-white font-weight-bold">(<?php echo $result['egfr']; ?>)</p>
		  </div>
        <div  class="col-3 ml-3 mt-5 pt-4" style="background-color:#888780; height: 150px;  font-size:20px; border-top-right-radius: 20px; border-bottom-left-radius: 20px;">
	            <p class="text-center text-white font-weight-bold ">إجمالى تم كشف سكر تراكمى</p>
                     <p class="text-center text-white font-weight-bold">(<?php echo $result['hba']; ?>)</p>
		  </div>
           
                   <div class=" col-3 pt-4 mt-5" style="background-color:#373737; font-size:20px; height: 150px; border-top-right-radius: 20px; border-bottom-left-radius: 20px;">
		             <p class="text-center text-white font-weight-bold">إجمالى تم كشف دهون</p>
                     <p class="text-center text-white font-weight-bold">(<?php echo $result['ldl']; ?>)</p>
		  </div>
			  </div>
</div>
		
        <footer style="position:fixed;">
        <p style="font-size:19px;"> &copy; 2021 جميع الحقوق محفوظة لوزارة الصحة و السكان المصرية. </p>
        
        </footer>

        
          <script src="../js/jquery-3.3.1.min.js"></script> 
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>  
        <script src="../js/wow.min.js"></script> 
        <script>new WOW().init();</script> 
        <script src="../js/mine.js"></script>
    </body>
</html>
<?php
      }?>