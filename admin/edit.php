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
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
           /* Style the search field */
form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}
           /* Style the submit button */
form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

/* Clear floats */
form.example::after {
  content: "";
  clear: both;
  display: table;
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
        
          
        <form action="" method="post">
                    <div id="national" class="row mt-5">
                        
            <div class="col-2"> <label for="nationalId" class="form-label">الرقم القومى :</label></div>
                          <div class="col-2">
                              
                              <input type="text" class="form-control" name="nationalId" id="nationalId" maxlength="14" autocomplete="off" onkeypress="return isNumberKey(event)" onchange="validationID()"></div>
                              <div class="col-1">
  <button type="submit" name="search"><i class="fa fa-search"></i></button></div>

          </div>
       


          </form>
          
          
          
          
          
          
          
          <?php
       if(isset($_POST['search'])){
           
       
             $nationalID = $_POST['nationalId'];
             $query= "SELECT * FROM elder WHERE nationalId = '$nationalID' AND nationalId != '0' order by date DESC limit 1";
    $do= mysqli_query($conn,$query);
    $count= mysqli_num_rows($do);
    if($count >0){
        while($result= mysqli_fetch_array($do)){
             ?>
          <section class="container" id="result">
                  
          
   <form name="Info" method="post" action="update.php">
       
         
          <h4 class="container-fluid headOfPersonal mb-2 pb-2 mt-5" > البيانات الاساسية 
            </h4>
        
        <input type="text" style="display:none;" value="<?php echo $_SESSION['name']; ?>" name="location" id="location">
             <input type="text" style="display:none;"  value="<?php echo $_SESSION['qism']; ?>" name="qism" id="qism">   
       <input type="text" style="display:none;"  value="<?php echo $_SESSION['governorate']; ?>" name="gov" id="gov">
<section class="container">
    <div id="form-container" class="container" >
        <h3 id="hntt" style="color:red;"></h3>
        <div class="row">
                <div class="mb-3  col-3">
    <label for="nationality" class="form-label">الجنسية :</label>
    <input type="text" class="form-control w-75" name="nationality" id="nationality" value="<?php echo $result['nationality']; ?>" >
  </div>
                     <div class="mb-3  col-3" style="display:none;">
    <label for="nationalId" class="form-label">الرقم القومى :</label>
    <input type="text" class="form-control w-75" name="nationalId" id="nationalId" value="<?php echo $result['nationalId']; ?>" >
  </div> 
         <div class="mb-3 col-6">
    <label for="uname" class="form-label">الاسم  :</label>
    <input type="text" class="form-control w-75" name="uname" id="uname" maxlength="50" autocomplete="off"  onkeypress="return CheckArabicCharactersOnly(event);"onfocus="validationID()" required value="<?php echo $result['name']; ?>" >
  </div>
        </div>
        <div class="row">
              <div class="mb-3  col-3">
    <label for="gender" class="form-label">النوع :</label>
    <input type="text" class="form-control w-75" name="gender" id="gender" value="<?php echo $result['gender']; ?>" >
  </div>
              <div id="eage" class="mb-3  col-3">
    <label for="age" class="form-label">السن :</label>
    <input type="number" class="form-control w-75" name="age" id="age" value="<?php echo $result['age']; ?>" >
  </div>
            
            <div class="mb-3 col-3">
    <label for="phone" class="form-label">تليفون :</label>
    <input type="text" class="form-control w-75" name="phone" id="phone" onkeypress="return isNumberKey(event)" onchange="phoneValidation()" minlength="11"  maxlength="11" autocomplete="off" required value="<?php echo $result['mobile']; ?>">
                <p id="phoneError" style="color:red;"></p>
                </div>
         </div>    
    </div>
    <hr>
           
  
   
     <h4 class="container-fluid headOfPersonal mb-2 pb-2" > التاريخ الطبـى (هل يوجد)   
            </h4>
        <div class="form-container-rep text-right pr-3" style="background-color:#eeeeee;">
            <div class="row pt-2 mb-4">
             <div  class="mb-3 col-3">
    <label for="diabetes" class="form-label"> إصابة بمرض السكر :</label>
    <select name="diabetes" id="diabetes" class="form-select w-75 form-control" onfocus="noneDiabetes();" onchange="Check()">
      <option value="<?php echo $result['diabetes']; ?>"><?php echo $result['diabetes']; ?></option>
       <option value="نعم" >نعم</option>
         <option value="لا">لا</option>
    </select> 
  </div>        
                
                
               <div  class="mb-3 col-3">
    <label for="bloodpressure" class="form-label">إصابة بمرض ضغط الدم :</label>
    <select name="bloodpressure" id="bloodpressure" class="form-select w-75 form-control" onchange="Check()">
      <option value="<?php echo $result['bloodpressure']; ?>"><?php echo $result['bloodpressure']; ?></option>
       <option value="نعم" >نعم</option>
         <option value="لا">لا</option>
    </select>     
  </div>        
             <div  class="mb-3 col-3">
    <label for="heartdisease" class="form-label">إصابة بأمراض القلب :</label>
    <select name="heartdisease" id="heartdisease" class="form-select w-75 form-control" >
      <option value="<?php echo $result['heartdisease']; ?>"><?php echo $result['heartdisease']; ?></option>
       <option value="نعم" >نعم</option>
         <option value="لا">لا</option>
    </select>  
  </div>        
<div  class="mb-3 col-3">
    <label for="smoking" class="form-label">التدخين :</label>
    <select name="smoking" id="smoking" class="form-select w-75 form-control" onchange="checkAll();">
      <option value="<?php echo $result['smoking']; ?>"><?php echo $result['smoking']; ?></option>
       <option value="مدخن" >مدخن</option>
         <option value="غير مدخن">غير مدخن</option>
         <option value="مدخن سابق">مدخن سابق</option>
    </select> 
  </div>        
            </div>
            </div>
   
    
     <hr>

  <h4 class="container-fluid headOfPersonal mb-2 pb-2" >الفحوصات الطبية 
            </h4>
        <div class="form-container-rep text-right pr-3" style="background-color:#eeeeee;">
               <div class="row pb-3 pt-3">
                    <div class="mb-3 col-3" >
    <label for="pressureeCheck" class="form-label">الضغط :</label><br>
    <input type="text" class="form-control w-75 d-inline" name="systolic" id="systolic" autocomplete="off" onchange="errorCheck();" min="60" max="260"   value="<?php echo $result['pressure']; ?>">
                        <p id="pressureError" style=" color:red;"></p>
  </div> 
               <div class="mb-3 pt-  col-3 ">
    <label for="height" class="form-label"> الطول(سم):</label>
    <input type="number" class="form-control w-75 " name="height" id="height" min="50"  max="300" onkeypress="return isNumberKey(event)" maxlength="3" autocomplete="off" onchange="errorCheck();" value="<?php echo $result['height']; ?>">
    <p id="heightError" style=" color:red;"></p>
  </div> 
         <div class="mb-3 col-3 ">
    <label for="weight" class="form-label"> الوزن(كجم) :</label>
    <input type="number" class="form-control w-75" name="weight" id="weight" min="40"  max="250" onkeypress="return isNumberKey(event)" maxlength="3" onchange="bmiCalculate(); errorCheck(); " autocomplete="off" value="<?php echo $result['weight']; ?>">
             <p id="weightError"  style="color:red;"></p>
						 </div> 
   
                   
                     <div id="bmiDiv" class="mb-3 col-3" style="display:block;">
    <label for="bmi" class="form-label"> مؤشر كتلة الجسم:</label>
<p id="bmi" name="bmi" style="width:200px; height:40px; background-color:white;  border-radius: 5px; border:2px solid #d4d6d8; padding-top:8px; padding-bottom:8px; padding-right:10px; color:black;" maxlength="5"><?php echo $result['BMI']; ?></p>
                         
     
  </div>    
                    </div>
           
            <div class="row">
                 <div class="mb-3 col-3 ">
                    <label for="diabetesCheck" class="form-label"> فحص السكر(العشوائى) :</label>
                    <input type="number" class="form-control w-75" name="diabetesCheck" id="diabetesCheck" min="7"  max="600" onkeypress="return isNumberKey(event)" maxlength="4" autocomplete="off" onchange="errorCheck();" value="<?php echo $result['diabetesCheck']; ?>">
                    <p id="diabetesError" style="color:red;"></p>
                </div>
                <div class="mb-3 col-3" id="hba1cDiv"  style="display:block;">
                    <label for="HbA1c" class="form-label">HbA1c :</label><br>
                    <input type="number" class="form-control w-75" name="HbA1c" id="HbA1c" autocomplete="off" min="4"  max="16" onchange="errorCheck();" value="<?php echo $result['hba']; ?>">
                    <p id="hba1cError" style="color:red;"></p>
                </div>

                <div id="egfrDiv" class="mb-3 col-3 " style="display:block;">
                    <label for="egrf" class="form-label">eGFR :</label>
                    <input type="number" class="form-control w-75" name="egrf" id="egrf"  onkeypress="return isNumberKey(event)" maxlength="2" autocomplete="off" onchange="errorCheck();" value="<?php echo $result['egfr']; ?>">

                </div>
                <div id="creatinineDiv" class="mb-3 col-3 " style="display:block;">
                    <label for="creatinine" class="form-label">Creatinine :</label>
                    <input type="text" class="form-control w-75" name="creatinine" id="creatinine" min="0.1" max="15"  maxlength="4" autocomplete="off"  onchange="errorCheck();" value="<?php echo $result['creatinine']; ?>">
                    <p id="creatinineError" style="color:red;"></p>
                </div>
            </div>

            <div class="row">

                <div class="mb-3 col-3" id="triglycaridDiv" style="display:block;" >
                    <label for="triglycerides" class="form-label">Triglycerides :</label><br>
                    <input type="number" class="form-control w-75" name="triglycerides" id="triglycerides" autocomplete="off" min="50"  max="5000" onkeypress="return isNumberKey(event)" onchange="errorCheck();" value="<?php echo $result['triglycerides']; ?>">
                    <p id="triglyError" style="color:red;"></p>
                </div>
                <div class="mb-3 col-3" id="hdlDiv" style="display:block;" >
                    <label for="hdl" class="form-label">HDL :</label><br>
                    <input type="number" class="form-control w-75 " name="hdl" id="hdl" autocomplete="off" onkeypress="return isNumberKey(event)" min="20"  max="300" onchange="errorCheck();" value="<?php echo $result['hdl']; ?>">
                    <p id="hdlError" style="color:red;"></p>
                </div>


                <div id="ldlDiv" class="mb-3 col-3 " style="display:block;">
                    <label for="ldl" class="form-label">LDL :</label>
                    <input type="number" class="form-control w-75" name="ldl" id="ldl" min="30"  max="250"  onkeypress="return isNumberKey(event)" maxlength="3" autocomplete="off" onchange="errorCheck();" value="<?php echo $result['ldl']; ?>">
                    <p id="ldlError" style="color:red;"></p>
                </div>
                <div id="cholesterolDiv" class="mb-3 col-3 " style="display:block;">
                    <label for="cholesterol" class="form-label">Total Cholesterol :</label>
                    <input type="number" class="form-control w-75" name="cholesterol" id="cholesterol" min="50" max="500"  maxlength="3" autocomplete="off" onchange="errorCheck();" value="<?php echo $result['cholesterol']; ?>">
                    <p id="cholesterolError" style="color:red;"></p>
                </div>

            </div>

            <div class="row">
                <div class="mb-3 col-3 ">
                    <label for="hb" class="form-label"> HB
                        :</label>
                    <input type="number" class="form-control w-75" name="hb" id="p1" min="0"  max="18" onkeypress="return isNumberKey(event)" maxlength="2" autocomplete="off"  onchange="errorCheck();" value="<?php echo $result['hb']; ?>">
                    <p id="hbError" style="color:red;" ></p>
                </div>
                <div class="mb-3 col-3" style="display:block;">
                 <label for="feces" class="form-label">اختبار كاشف الدم الخفي بالبراز :</label>
                 <select name="feces" id="p2" class="form-select w-75 form-control"  >
                     <option value="<?php echo $result['feces']; ?>"><?php echo $result['feces']; ?></option>
                     <option value="ايجابي" >ايجابي</option>
                     <option value="سلبي">سلبي </option>
                     <option value="لم يتم">لم يتم </option>
                    
                 </select>
             </div>
                <div class="mb-3 col-3" id="hbacDiv"  style="display:block;">
                    <label for="sight" class="form-label">قياس حدة النظر :</label>
                    <select name="sight" id="p3" class="form-select w-75 form-control"  >
                        <option value="<?php echo $result['sight']; ?>"><?php echo $result['sight']; ?></option>
                        <option value="طبيعي" >طبيعي</option>
                        <option value="يحتاج لتدخل">
                            يحتاج لتدخل
                        </option>
                        
                                             <option value="لم يتم">لم يتم </option>

                    </select>
                </div>
                <div class="mb-3 col-3" id="hba cDiv"  style="display:block;">
                    <label for="teeth" class="form-label">تقييم الاسنان  :</label>
                    <select name="teeth" id="p4" class="form-select w-75 form-control"  >
                        <option value="<?php echo $result['teeth']; ?>"><?php echo $result['teeth']; ?></option>
                        <option value="طبيعى" >طبيعي</option>
                        <option value="لا">بحاجه لتدخل في وحدات الرعاية الصحية الاولية</option>
                        <option value="بحاجه لتدخل بالمستشفي">بحاجه لتدخل بالمستشفي
                        </option>

                    </select>
                </div>
			 </div>
            <div class="row">
                <div class="mb-3 col-3 ">
                    <label for="heart" class="form-label">رسم القلب :</label>
                    <select name="heart" id="p5" class="form-select w-75 form-control"  >
                        <option value="<?php echo $result['heart']; ?>"><?php echo $result['heart']; ?></option>
                        <option value="نعم" >طبيعي</option>
                        <option value="لا">غير طبيعي</option>
                        <option value="لم يتم">لم يتم </option>               
                    </select>
                </div>
                <div class="mb-3 col-3" id="hbacDiv"  style="display:block;">
                    <label for="cog" class="form-label">اختبار Mini-Cog للتقييم النفسي :</label>
                    <select name="cog" id="p6" class="form-select w-75 form-control"  >
                        <option value="<?php echo $result['cog']; ?>"><?php echo $result['cog']; ?></option>
                        <option value="طبيعى" >طبيعي</option>
                         <option value="متابعة" >يحتاج لمتابعة</option>
                         <option value="تحويل" >تحويل لمستشفى</option>

                       
                    </select>
                </div>
                <div class="mb-3 col-3" id="hbacDiv"  style="display:block;">
                    <label for="gds" class="form-label">مؤشر GDS للتقييم النفسي :</label>
                    <select name="gds" id="p7" class="form-select w-75 form-control"  >
                        <option value="<?php echo $result['gds']; ?>"><?php echo $result['gds']; ?></option>
                        <option value="0" >0-4</option>
                         <option value="5" >5-10</option>
                         <option value="11" >اكبر من 11</option>
                   
                    </select>
                </div>
                <div class="mb-3 col-3" id="hbacDiv"  style="display:block;">
                    <label for="must" class="form-label">للتقييم التغذوي MUST اداه  :</label>
                    <select name="must" id="p8" class="form-select w-75 form-control"  >
                        <option value="<?php echo $result['must']; ?>"><?php echo $result['must']; ?></option>
                        <option value="0" >0</option>
                        <option value="1">1</option>
                        <option value="2">2 فاكثر</option>
             
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-3" id="xrayDiv"  style="display:block;">
                    <label for="xray" class="form-label">الموجات فوق صوتيه علي البطن :</label>
                    <select name="xray" id="p9" class="form-select w-75 form-control" onchange="message(); checkGender1();">
                        <option value="<?php echo $result['xray']; ?>"><?php echo $result['xray']; ?></option>
                        <option value="نعم" >طبيعي</option>
                        <option value="لا">غير طبيعي</option>
<option value="لم يتم">لم يتم </option>
                    </select>
                </div>

            </div>
            <div class="row" id="xrays" style="visibility: visible;">
                <div class="mb-3 col-2" id="liverDiv">
                    <label for="liver" class="form-label">الكبد :</label>
                    <select name="liver" id="liver" class="form-select  form-control"  >
                        <option value="<?php echo $result['liver']; ?>"><?php echo $result['liver']; ?></option>
                        <option value="نعم" >طبيعي</option>
                        <option value="تليف">تليف بالكبد</option>
                        <option value="دهنى"> دهنى</option>
                        <option value="لم يتم">لم يتم </option>
                    </select>
                </div>
                <div class="mb-3 col-2" id="kidneysDiv">
                    <label for="kidneys" class="form-label">الكلى :</label>
                    <select name="kidneys" id="kidneys" class="form-select form-control"  >
                        <option value="<?php echo $result['kidneys']; ?>"><?php echo $result['kidneys']; ?></option>
                        <option value="نعم" >طبيعي</option>
                        <option value="لا">غير طبيعي</option>
<option value="لم يتم">لم يتم </option>
                    </select>
                </div>
                <div class="mb-3 col-2" id="wombDiv">
                    <label for="womb" class="form-label">الرحم :</label>
                    <select name="womb" id="womb" class="form-select  form-control"  >
                        <option value="<?php echo $result['womb']; ?>"><?php echo $result['womb']; ?></option>
                        <option value="نعم" >طبيعي</option>
                        <option value="لا">غير طبيعي</option>
<option value="لم يتم">لم يتم </option>
                    </select>
                </div>
                <div class="mb-3 col-2" id="prostateDiv">
                    <label for="prostate" class="form-label">البروستاتا :</label>
                    <select name="prostate" id="prostate" class="form-select  form-control"  >
                        <option value="<?php echo $result['prostate']; ?>"><?php echo $result['prostate']; ?></option>
                        <option value="نعم" >طبيعي</option>
                        <option value="لا">غير طبيعي</option>
<option value="لم يتم">لم يتم </option>
                    </select>
                </div>
                <div class="mb-3 col-3" id="aortaDiv">
                    <label for="aorta" class="form-label">تضخم بالشريان الاورطي :</label>
                    <select name="aorta" id="aorta" class="form-select w-75 form-control"  onchange="message(); xrays();">
                        <option value="<?php echo $result['aorta']; ?>"><?php echo $result['aorta']; ?></option>
                        <option value="نعم" >نعم</option>
                        <option value="لا">لا</option>
<option value="لم يتم">لم يتم </option>
                    </select>
                </div>



            </div>



            <p id="pa1" style="color:red; font-size: 18px;"></p>
	        <p id="pa2" style="color:red; font-size: 18px;"></p>
            <p id="pa3" style="color:red; font-size: 18px;"></p>
            <p id="pa4" style="color:red; font-size: 18px;"></p>
            <p id="pa5" style="color:red; font-size: 18px;"></p>
	        <p id="pa6" style="color:red; font-size: 18px;"></p>
            <p id="pa7" style="color:red; font-size: 18px;"></p>
            <p id="pa8" style="color:red; font-size: 18px;"></p>
            <p id="pa9" style="color:red; font-size: 18px;"></p>
            <p id="pa10" style="color:red; font-size: 18px;"></p>
             <p id="pa11" style="color:red; font-size: 18px;"></p>
             <p id="pa12" style="color:red; font-size: 18px;"></p>
             <p id="pa13" style="color:red; font-size: 18px;"></p>
            <p id="message" style="color:red; font-size:18px;"></p>
	        <p id="message1" style="color:red; font-size:18px;"></p>
            <p id="message2" style="color:red; font-size:18px;"></p>
            <p id="message3" style="color:red; font-size:18px;"></p>
            
            
    </div>
	   </section>
   <button id="buttonSubmit" class="btn btn-lg text-white submitButton" type="submit" name="submit"  onclick="return confirm('هل جميع البيانات صحيحة؟');">
                 تعديل  </button>
       <button class="btn btn-lg text-white backButton" type="button" name="back">
           <a href="home.php">رجوع</a></button>
 
       
     
       
		</form>
        </section>
       <?php
        }}
  
 else{
          
          ?>
      <h3 class="text-center font-weight-bold mt-5">لا يوجد بيانات</h3>
   <?php   }
      }
       
            
            ?>

          <script src="../js/jquery-3.3.1.min.js"></script> 
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>  
        <script src="../js/wow.min.js"></script> 
        <script>new WOW().init();</script> 
        <script src="../js/mine.js"></script>
              <script> function toggleForm() {
    var form = document.getElementById("tableDiv");
    var showHide = document.getElementById("showHide");

    if (form.style.display == "none") {

        form.style.display = "block";
        showHide.innerHTML = '<i class="fas fa-chevron-up"></i>';
    }
    else {

        form.style.display = "none";
        showHide.innerHTML = '<i class="fas fa-chevron-down"></i>';

    }
}
                  </script>
           <script type="text/javascript">
       
               document.getElementById('nationalId').value = "<?php echo $_POST['nationalId'];?>";
              
</script>
    </body>
</html>
<?php
      }?>