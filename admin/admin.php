<?php session_start(); require_once '../connection.php';?><html dir="rtl">
  <head>
       <title>وزارة الصحة و السكان - مبادرة فحص ما قبل الزواج</title>
       <meta charset="UTF-8">
        <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
      <link rel="stylesheet" href="../css/all.min.css">
      <link rel="stylesheet" href="../css/animate.css">
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/font-awesome.min.css">
	   <link rel="preconnect" href="https://fonts.gstatic.com">
       <link rel="stylesheet" href="../css/style.css">
       <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
      <script src="../js/jquery-3.3.1.min.js"></script> 
	   <style>
		   p{
			   font-size: 27px;
			   font-weight: 400;
		   }
           .card-body{
               width: 90%;
               height: 380px;
           }
           .card-body:hover{
               width: 90%;
               height: 390px; !important
               box-shadow: 5px 6px 5px 6px #888888;
           }
          
	   </style>
        <script>
    $(document).ready(function() {

        $('#governorate').on('change', function() {

            var governorate = $(this).val();
            if (governorate) {
                $.get(
                    "ajax.php", {
                        governorate: governorate
                    },
                    function(data) {

                        $('#qism').html(data);

                    });

            } else {
                $('#qism').html('<option>اختر المحافظة اولا</option>')
            }

        });
           
    });
    </script>
    </head>
    <body style="background-color:#eeeeee;">
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
      <a class="dropdown-item text-center border-bottom" href="followup.php">متابعة</a>
    <a class="dropdown-item text-center" href="../index.php">تسجيل خروج</a>
    
  </div>
</div>
            
            </div>
		
       
		</nav>
        
        <div class="title text-center text-dark border-bottom mb-3" style="background-color:#ffffff;">
        <h1 class="heading">إضافة مستخدم</h1>
            
            </div>
        <div class="container">
	<div class="card-body container WOW fadeIn text-right">
    	<form name="login" action="" method="POST">
       <div class="row">

                        
                        <div id="gov" class="mb-3 col-4">
                            <label for="gov" class="form-label">المحافظة :</label>
                            <select name="governorate" id="governorate" class="form-select   form-control w-75">
                                <option>--اختر--</option>
                                <?php
      
       $query= "select DISTINCT name from governorate";
       $do= mysqli_query($conn,$query)or die('error'.mysqli_error($conn));
       while($row=mysqli_fetch_array($do)){
      echo '<option value="'.$row['name'].'"  "selected">'.$row['name'].'</option>';
       }
       ?>
                            </select>
                        </div>
                        <div id="qismDIV" class="mb-3 col-4">
                            <label for="qism" class="form-label">المركز :</label>
                            <select name="qism" id="qism" class="form-select   form-control w-75">
                                <option>--اختر--</option>
                                <?php
      
       $query= "select DISTINCT name from qism";
       $do= mysqli_query($conn,$query)or die('error'.mysqli_error($conn));
       while($row=mysqli_fetch_array($do)){
      echo '<option value="'.$row['name'].'"  "selected">'.$row['name'].'</option>';
       }
       ?>

                            </select>
                        </div>

<div id="nameDiv" class="mb-3 col-4">
                            <label for="name" class="form-label">اسم الوحدة :</label>
                            <input type="text" class="form-control w-75 " name="name" id="name" autocomplete="off"
                                required>

                        </div>
                    </div>
             <div class="row mt-3">
                
                   <div class="col-4">
            <label for="username">اسم المستخدم:</label><br>
   <input type="text" name="username" class="form-control w-75"  required>
    
            </div>
                
    <div class="col-4">
    
 <label for="password">كلمة السر:</label><br>
   <input type="password" name="password" class="form-control w-75"  required>
  </div>
                
                <div class="col-4">
                        
            <label for="permission">الصلاحيات:</label>
    <select  name="permission" id="permission" class=" form-control w-75">
    <option>--اختر--</option>
    <option  value="1">مدير </option>
    <option  value="2">مدخل بيانات </option> 
    <option  value="3">مدخل بيانات جميع التحاليل</option> 
    
    </select>
             </div>
                
            </div>
            <div class="row mt-3">
                 <div class="col-7">
                <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="kidneys" name="kidneys" value="1">
  <label class="form-check-label mr-2" for="kidneys">أجهزة الكلي</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="diabetes" name="diabetes" value="1">
  <label class="form-check-label  mr-2" for="diabetes">أجهزة السكر التراكمي / الدهون مرحلة أولي</label>
</div>

                </div>
            </div>
            <div class="row">
                 
   <div class="col-4" style="margin-top:28px;">
                 <button class="btn btn-lg text-white submitButton mt-3 float-right" type="submit" name="submitUser" style="margin-right:50px; paddint-top:5px; padding-bottom:5px;">تسجيل</button>
        </div>
                </div>
           
          
           
            
        
             </form>
            </div>
				</div>	
 
     
           
   
        
<?php
 
    
    if(isset($_POST['submitUser'])){
      $username = $_POST['username'];
        $password = $_POST['password'];
        $permission = $_POST['permission'];
        $governorate = $_POST['governorate'];
        $qism = $_POST['qism'];
        $name = $_POST['name'];
        $kidneys = $_POST['kidneys'];
        $diabetes = $_POST['diabetes'];
        $ins="INSERT INTO user(username,password,permission,governorate,qism,name,kidneys,diabetes) VALUES ('$username','$password','$permission','$governorate','$qism','$name','$kidneys','$diabetes')";
$query= mysqli_query($conn,$ins) or die("error:".mysqli_error($conn));
        if($query) 
{  
   echo '<script type="text/javascript">';
     echo ' alert("تم إضافة المستخدم");';
   
    echo '</script>';
}
else {
     echo '<script type="text/javascript">';
     echo ' alert("عفواً! لم يتم التسجيل");';
    echo'window.location.href="users.php";';
    echo '</script>';

}  }
        
    
    
    ?>

        <footer style="position:fixed; margin-top:3px;">
        <p style="font-size:19px;"> &copy; 2021 جميع الحقوق محفوظة لوزارة الصحة و السكان المصرية. </p>
        
        </footer>

        
          
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>  
        <script src="../js/wow.min.js"></script> 
        <script>new WOW().init();</script> 
        <script src="../js/mine.js"></script>
    </body>
</html>