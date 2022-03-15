<?php include '../connection.php'; require_once 'header.php'; ?>
<html dir="rtl">
    <head>
    <style>
        .previous{
    
	margin-top: 25px;
	cursor: pointer;
	background-color: white;
	height: 200px;
	padding-top: 50px;
	border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
	box-shadow: 1px 2px #888888;
}
.previous:hover{
	cursor: pointer;
	background-color: white;
	height: 200px;
	padding-top: 50px;
	border-top-right-radius: 20px;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
	box-shadow: 3px 4px 3px 4px #888888;
    transition: 0.5s;
}
        
        </style>
    </head>
    <body>
   
        <div class="mr-5 ml-5 mt-5" style="background-color: #eee; height: 520px;" >
		  <div class="row" style="margin-right:15%;">
                 <div onclick="location.href='monthly.php'" class="previous col-3 ml-3">
		  <p class="text-center">تقرير بعدد المترددين و الذين يجمعون بين الامراض المزمنة</p>
		  </div>
              <div onclick="location.href='total.php'" class="previous col-3 ml-3">
		  <p class="text-center">تقرير بعدد المترددين و الذين يعانون من امراض مزمنة </p>
		  </div>
                   
              <div onclick="location.href='not.php'" class="previous col-3">
		  <p class="text-center">تقرير  بعدد المترددين و الذين لا يعانون من امراض مزمنة </p>
		  </div>
			  </div>
              <div class="row" style="margin-right:15%;">
              <div onclick="location.href='gender.php'" class="previous col-3 ml-3">
		  <p class="text-center">تقرير بعدد المترددين و الذين يعانون من امراض مزمنة طبقاً للنوع</p>
		  </div>
                   <div onclick="location.href='age.php'" class="previous col-3 ml-3">
		  <p class="text-center">تقرير بعدد المترددين و الذين يعانون من امراض مزمنة طبقاً للفئة العمرية</p>
		  </div>
              <div onclick="location.href='bmi.php'" class="previous col-3 ml-3">
		  <p class="text-center">تقرير بعدد المترددين طبقاً لمؤشر كتلة الجسم </p>
		  </div>
			  </div>
</div>
    
    
    
    
    
         <footer style="position:fixed;">
        <p style="font-size:19px;"> &copy; 2021 جميع الحقوق محفوظة لوزارة الصحة و السكان المصرية. </p>
        
        </footer>
    
    </body>
</html>