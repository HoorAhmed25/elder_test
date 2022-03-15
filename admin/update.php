<?php session_start ();
require_once '../connection.php';
if(isset($_POST['submit'])){
    $nationalId = $_POST['nationalId'];
    $nationality = $_POST['nationality'];
    $uname = $_POST['uname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $bmi = $weight / (($height/100)*($height/100));
    $diabetesCheck = $_POST['diabetesCheck'];
    $pressure = $_POST['systolic'];
    $location = $_POST['location'];
    $diabetes = $_POST['diabetes'];
    $bloodpressure = $_POST['bloodpressure'];
    $heartdisease = $_POST['heartdisease'];
    $smoking = $_POST['smoking'];
    $HbA1c = $_POST['HbA1c'];
    $triglycerides = $_POST['triglycerides'];
    $hdl = $_POST['hdl'];
    $egrf = $_POST['egrf'];
    $ldl = $_POST['ldl'];
    $creatinine = $_POST['creatinine'];
    $cholesterol = $_POST['cholesterol'];
    $gov = $_POST['gov'];
    $qism = $_POST['qism'];
     $hb = $_POST['hb'];
    $feces = $_POST['feces'];
    $sight = $_POST['sight'];
    $teeth= $_POST['teeth'];
    $heart = $_POST['heart'];
    $cog = $_POST['cog'];
    $gds = $_POST['gds'];
    $must = $_POST['must'];
    $xray = $_POST['xray'];
    $liver = $_POST['liver'];
    $kidneys = $_POST['kidneys'];
    $womb = $_POST['womb'];
    $prostate = $_POST['prostate'];
    $aorta = $_POST['aorta'];
    
   
$ins="UPDATE elder SET name='$uname',gender='$gender',age='$age',mobile='$phone',height='$height',weight='$weight',BMI='$bmi',bloodpressure='$bloodpressure',diabetes='$diabetes',heartdisease='$heartdisease',diabetesCheck='$diabetesCheck',pressure='$pressure',hba='$HbA1c',triglycerides='$triglycerides',hdl='$hdl',egfr='$egrf',
ldl='$ldl',creatinine='$creatinine',cholesterol='$cholesterol',smoking='$smoking',hb='$hb',feces='$feces',sight='$sight',teeth='$teeth',heart='$heart',cog='$cog',gds='$gds',must='$must',xray='$xray',liver='$liver',kidneys='$kidneys',womb='$womb',prostate='$prostate',aorta='$aorta' WHERE nationalId = '$nationalId'";
$query= mysqli_query($conn,$ins) or die("error:".mysqli_error($conn));
if($query) 
{ 
       echo '<script type="text/javascript">';
     echo 'alert("تم التعديل بنجاح");';
    echo '</script>';
  echo '<script type="text/javascript">';echo'window.location.href="home.php";';echo '</script>';
    
}
    else{
           echo '<script type="text/javascript">';
     echo ' alert("عفواً! لم يتم التعديل");';
    echo '</script>';
         echo '<script type="text/javascript">';echo'window.location.href="home.php";';echo '</script>';
    }
}


?>