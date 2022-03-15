<?php session_start (); include '../connection.php'; ?><html dir="rtl">

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
<script src="../js/jquery-3.3.1.min.js"></script> 
    </head>
 
            <script>
    
    $(document).ready(function(){
        
       $('#governorate').on('change',function(){
           
           var governorate= $(this).val();
           if(governorate){
               $.get(
                   "ajax.php",
                   {governorate: governorate},
                   function(data){
                   
                   $('#follow').html(data);
               
                   
               });
               
           }
           
           
       }); 
  
    });       
            
    </script>
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
          <?php  ini_set('memory_limit', '-1'); ?>
  <a class="h3 dropdown-toggle float-left ml-4 mt-4 text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo $_SESSION['name']; ?> 
  </a>

  <div class="dropdown-menu float-left" aria-labelledby="dropdownMenuLink">
           <a class="dropdown-item text-center border-bottom" href="home.php">الرئيسية</a>
       <a class="dropdown-item text-center border-bottom" href="report.php">تقارير</a>
    <a class="dropdown-item text-center" href="../index.php">تسجيل خروج</a>
    
  </div>
</div>
            
            </div>
		
       
		</nav>
             <div class="pl-5 title text-center text-dark border-bottom mb-3" style="background-color:#ffffff;">
             <div class=" WOW fadeIn text-right" style="margin-top:10px;">
    	<form name="login" id="login" action="" method="POST">
            <div class="row">
    <div id="gov" class="mb-3 col-2 mr-5">
    <label for="gov" class="form-label">المحافظة :</label>
    <select name="governorate" id="governorate" class="form-select  form-control" >
      <option>--اختر--</option>
        <?php
      
       $query= "select DISTINCT governorate from test";
       $do= mysqli_query($conn,$query)or die('error'.mysqli_error($conn));
       while($row=mysqli_fetch_array($do)){
      echo '<option value="'.$row['governorate'].'"  "selected">'.$row['governorate'].'</option>';
       }
       ?>
    </select>                               
  </div>
                 <div id="followHospital" class="mb-3 col-2">
    <label for="follow" class="form-label">اسم الوحدة :</label>
    <select name="follow" id="follow" class="form-select form-control" >
      <option>--اختر--</option>
         <?php
      
       $query= "select DISTINCT location from test";
       $do= mysqli_query($conn,$query)or die('error'.mysqli_error($conn));
       while($row=mysqli_fetch_array($do)){
      echo '<option value="'.$row['location'].'"  "selected">'.$row['location'].'</option>';
       }
       ?>
       
    </select>                               
  </div>
                <div class="col-2">
                    <label for="stdate" class="form-label">من :</label>
                <input type="date" name="stdate" id="stdate" class="form-control ">
                </div>
                
 <div class="col-2">
                    <label for="endate" class="form-label">إلى :</label>
                <input type="date" name="endate" id="endate" class="form-control">
            
                </div>
            </div>
            
            
            <div class="row">
                      <div  class="mb-3 col-2 mr-5">
    <label for="diabetes" class="form-label">هل يوجد إصابة بمرض السكر :</label>
    <select name="diabetes" id="diabetes" class="form-select  form-control">
      <option>--اختر--</option>
       <option value="نعم" >نعم</option>
         <option value="لا">لا</option>
    </select> 
                
  </div>        
                
                
               <div  class="mb-3 col-2">
    <label for="bloodpressure" class="form-label">هل يوجد إصابة بمرض ضغط الدم</label>
    <select name="bloodpressure" id="bloodpressure" class="form-select form-control">
      <option>--اختر--</option>
       <option value="نعم" >نعم</option>
         <option value="لا">لا</option>
    </select>     
                  
  </div>        
   
             <div  class="mb-3 col-2">
    <label for="heartdisease" class="form-label">هل يوجد إصابة بأمراض القلب :</label>
    <select name="heartdisease" id="heartdisease" class="form-select form-control">
      <option>--اختر--</option>
       <option value="نعم" >نعم</option>
         <option value="لا">لا</option>
    </select>  
  </div>   
                    <div id="national" class=" col-2">
            <label for="nationalId" class="form-label">الرقم القومى :</label>
            <input type="text" class="form-control " name="nationalId" id="nationalId" maxlength="14"
              autocomplete="off" onkeypress="return isNumberKey(event)" onchange="validationID()">
            <p id="idError" style="display:none; color:red;">*خطأ فى الرقم القومى</p>

          </div>
            </div>
               <div class="row">
              <div class="col-5"></div>
          <div class="col-4">
            <button class="btn btn-lg text-white submitButton mt-4" type="submit" name="search">بحث</button>
               <button class="btn btn-lg text-white mt-4" type="button" name="excel" onclick="exportTableToExcel('tblData')" style="background-color: #127c5b;">اكسيل</button>
             <button class="btn btn-lg text-white backButton mt-4" type="button" name="back" onclick="location.href='home.php'">رجوع</button> 
            
          </div>
              
        </div>
        </form>
        </div>
     
            
            </div>
 <?php 
           if(isset($_POST['search'])){
            $governorate = $_POST['governorate'];
            $follow = $_POST['follow']; 
             $stdate = $_POST['stdate'];
               $endate = $_POST['endate'];
               $diabetes = $_POST['diabetes'];
               $bloodpressure = $_POST['bloodpressure'];
               $heartdisease = $_POST['heartdisease'];
           $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 50;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
	$result = $conn->query("SELECT * FROM test where governorate = '$governorate' OR location = '$follow' OR date between '$stdate' AND '$endate' OR diabetes = '$diabetes' OR bloodpressure = '$bloodpressure' OR heartdisease = '$heartdisease'");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
    $resultAll = $conn->query("SELECT * FROM test where governorate = '$governorate' OR location = '$follow' OR date between '$stdate' AND '$endate' OR diabetes = '$diabetes' OR bloodpressure = '$bloodpressure' OR heartdisease = '$heartdisease'");
	$customersAll = $resultAll->fetch_all(MYSQLI_ASSOC);   
 
	$result1 = $conn->query("SELECT count(ID) AS ID FROM test where governorate = '$governorate' OR location = '$follow' OR date between '$stdate' AND '$endate' OR diabetes = '$diabetes' OR bloodpressure = '$bloodpressure' OR heartdisease = '$heartdisease'");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['ID'];
	$pages = ceil( $total / $limit  );
if($page < 1){
    $page = 1;
}
	$Previous = $page - 1;
	$Next = $page + 1;
        
        
        ?>
            
            	<div class="mt-5" style="border: 1px solid #eeeeee;"> 
        
		<div class="row border-bottom">
            <div class="col-5" ><h3 class="text-right pt-3 mr-4">إجمالى المرضى <span class="font-weight-bold" style="color:red;">(<?php echo $total; ?>)</span></h3></div>
            <div class="col-5"> </div>
         <div class="col-1 ml-1 border-right pt-2" ><input type="image" onclick="exportTableToExcel('tblData')" src="../img/excel.png" style="height: 40px;"></div>
           
        </div>

<div class="text-left ml-2" style="margin-top: 10px; " class="col-md-3">
                                <form method="post" action="#">
                     <label for="limit-records" class="form-label">عدد السجلات لكل صفحة :</label>
                                                <select name="limit-records" id="limit-records">
                                                        <option  selected="selected">100</option>
                                                        <?php foreach([100,500,1000,5000] as $limit): ?>
                                                                <option <?php if( isset($_POST["limit-records"]) && $_POST["limit-records"] == $limit) echo "selected" ?> value="<?= $limit; ?>"><?= $limit; ?></option>
                                                        <?php endforeach; ?>
                                                </select>
                                        </form>
                                </div>



		<div   style="overflow-x: auto; ">
			<table id="tblData" class="table table-striped table-bordered">
	        	<thead>
	           <tr>
                         <th>م</th>
	                    <th>تاريخ التسجيل</th>
                        <th>مكان التشخيص</th>
                        <th>المحافظة</th>
	                    <th>الاسم</th>
	                    <th>الرقم القومى </th>
	                    <th>السن</th>
	                    <th>مؤشر كتلة الجسم </th>
                   <th>إصابة بمرض السكر</th>
                    <th>إصابة بمرض الضغط</th>
                    <th>إصابة بأمراض القلب</th>
                        <th>ضغط الدم</th>
	                    <th>قياس السكر العشوائى </th>
                        <th>HbA1c</th>
	                    <th>eGFR </th>
                        <th>Creatinine</th>
	                    <th>Triglycerides </th>
                        <th>Hdl</th>
	                    <th>LDL </th>
                        <th>Total Cholesterol</th>

	              	</tr>
	          	</thead>
	        	<tbody>
	        		<?php foreach($customers as $customer) :  ?>
	 		    		    <tr>
        <td><?php echo $customer['ID'];?></td>
      <td><?php echo $customer['date'];?></td>
    <td><?php echo $customer['location'];?></td>
      <td><?php echo $customer['governorate'];?></td>
      <td><?php echo $customer['name'];?></td>
      <td><?php echo $customer['nationalId'];?></td>
      <td><?php echo $customer['age'];?></td>
        <td><?php echo $customer['BMI'];?></td>
           <td><?php echo $customer['diabetes'];?></td>
                                <td><?php echo $customer['bloodpressure'];?></td>
                                <td><?php echo $customer['heartdisease'];?></td>
       <td><?php echo $customer['pressure'];?></td>
      <td><?php echo $customer['diabetesCheck'];?></td>
        <td><?php echo $customer['hba'];?></td>
     <td><?php echo $customer['egfr'];?></td>
      <td><?php echo $customer['creatinine'];?></td>
        <td><?php echo $customer['triglycerides'];?></td>
     	<td><?php echo $customer['hdl'];?></td>
      <td><?php echo $customer['ldl'];?></td>
        <td><?php echo $customer['cholesterol'];?></td>
       
       
      </tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>

      		
		</div>

        
        
<div style="background-color:transparent; " aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="followup.php?page=<?= $Previous; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo; السابق</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
          
    
    <li class="page-item">
      <a class="page-link" href="followup.php?page=<?= $Next; ?>" aria-label="Next">
        <span aria-hidden="true">التالى &raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</div>
    </div>    
        <?php  
          }
          else{
              
          $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 50;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
	$result = $conn->query("SELECT * FROM test  LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
    $resultAll = $conn->query("SELECT * FROM test");
	$customersAll = $resultAll->fetch_all(MYSQLI_ASSOC);   
 
	$result1 = $conn->query("SELECT count(ID) AS ID FROM test");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['ID'];
	$pages = ceil( $total / $limit  );
if($page < 1){
    $page = 1;
}
	$Previous = $page - 1;
	$Next = $page + 1;
        
        
        ?>
            
            	<div class=" mt-5" style="border: 1px solid #eeeeee;"> 
        
		<div class="row border-bottom">
            <div class="col-5" ><h3 class="text-right pt-3 mr-4">إجمالى المرضى <span class="font-weight-bold" style="color:red;">(<?php echo $total; ?>)</span></h3></div>
            <div class="col-5"> </div>
         <div class="col-1 ml-1 border-right pt-2" ><input type="image" onclick="exportTableToExcel('tblData')" src="../img/excel.png" style="height: 40px;"></div>
    
        </div>
		<div class="text-left ml-2" style="margin-top: 10px; " class="col-md-3">
				<form method="post" action="#">
                     <label for="limit-records" class="form-label">عدد السجلات لكل صفحة :</label>
						<select name="limit-records" id="limit-records">
							<option  selected="selected">100</option>
							<?php foreach([100,500,1000,5000] as $limit): ?>
								<option <?php if( isset($_POST["limit-records"]) && $_POST["limit-records"] == $limit) echo "selected" ?> value="<?= $limit; ?>"><?= $limit; ?></option>
							<?php endforeach; ?>
						</select>
					</form>
				</div>
		<div   style="overflow-x: auto; ">
			<table id="tblData" class="table table-striped table-bordered">
	        	<thead>
	           <tr>
                       <th>م</th>
	                    <th>تاريخ التسجيل</th>
                        <th>مكان التشخيص</th>
                        <th>المحافظة</th>
	                    <th>الاسم</th>
	                    <th>الرقم القومى </th>
	                    <th>السن</th>
	                    <th>مؤشر كتلة الجسم </th>
                   <th>إصابة بمرض السكر</th>
                    <th>إصابة بمرض الضغط</th>
                    <th>إصابة بأمراض القلب</th>
                        <th>ضغط الدم</th>
	                    <th>قياس السكر العشوائى </th>
                        <th>HbA1c</th>
	                    <th>eGFR </th>
                        <th>Creatinine</th>
	                    <th>Triglycerides </th>
                        <th>Hdl</th>
	                    <th>LDL </th>
                        <th>Total Cholesterol</th>


	              	</tr>
	          	</thead>
	        	<tbody>
	        		<?php foreach($customers as $customer) :  ?>
	 		    		    <tr>
    <td><?php echo $customer['ID'];?></td>
      <td><?php echo $customer['date'];?></td>
    <td><?php echo $customer['location'];?></td>
      <td><?php echo $customer['governorate'];?></td>
      <td><?php echo $customer['name'];?></td>
      <td><?php echo $customer['nationalId'];?></td>
      <td><?php echo $customer['age'];?></td>
        <td><?php echo $customer['BMI'];?></td>
           <td><?php echo $customer['diabetes'];?></td>
                                <td><?php echo $customer['bloodpressure'];?></td>
                                <td><?php echo $customer['heartdisease'];?></td>
       <td><?php echo $customer['pressure'];?></td>
      <td><?php echo $customer['diabetesCheck'];?></td>
        <td><?php echo $customer['hba'];?></td>
     <td><?php echo $customer['egfr'];?></td>
      <td><?php echo $customer['creatinine'];?></td>
        <td><?php echo $customer['triglycerides'];?></td>
     	<td><?php echo $customer['hdl'];?></td>
      <td><?php echo $customer['ldl'];?></td>
        <td><?php echo $customer['cholesterol'];?></td>
       
       
      </tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>

      		
		</div>

        
        
<div style="background-color:transparent; " aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="followup.php?page=<?= $Previous; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo; السابق</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
          
    
    <li class="page-item">
      <a class="page-link" href="followup.php?page=<?= $Next; ?>" aria-label="Next">
        <span aria-hidden="true">التالى &raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</div>
    </div>
              
              
              <?php
          }
          
?>
   
      
        
          
          
           <footer>
        <p style="font-size:19px;"> &copy; 2021 جميع الحقوق محفوظة لوزارة الصحة و السكان المصرية. </p>
        </footer>
          
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>  
        <script src="../js/wow.min.js"></script> 
        <script>new WOW().init();</script> 
        <script src="../js/mine.js"></script>
           <script>
function exportTableToExcel(tableID, filename = 'مبادرة الاعتلال الكلوى'){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        //triggering the function
        downloadLink.click() }}
</script>
    </body>
</html>
