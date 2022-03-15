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
                   "ajax1.php",
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
      <option value="none">--اختر--</option>
        <?php
      
       $query= "select DISTINCT governorate from elder";
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
      <option value="none">--اختر--</option>
         <?php
      
       $query= "select DISTINCT location from elder";
       $do= mysqli_query($conn,$query)or die('error'.mysqli_error($conn));
       while($row=mysqli_fetch_array($do)){
      echo '<option value="'.$row['location'].'"  "selected">'.$row['location'].'</option>';
       }
       ?>
       
    </select>                               
  </div>
                <div class="col-2">
                    <label for="stdate" class="form-label">من :</label>
                <input type="date" name="stdate" id="stdate" class="form-control " value="<?php echo $_POST['stdate'] ?? ''; ?>">
                </div>
                
 <div class="col-2">
                    <label for="endate" class="form-label">إلى :</label>
                <input type="date" name="endate" id="endate" class="form-control" value="<?php echo $_POST['endate'] ?? ''; ?>">
            
                </div>
            </div>
            
            
            <div class="row">
<div class="col-2 mr-5">
    <label for="uname" class="form-label">اسم المريض :</label>
    <input type="text" class="form-control " name="name" id="name" maxlength="50" autocomplete="off"  onkeypress="return CheckArabicCharactersOnly(event);">
    
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
            $nationalId = $_POST['nationalId'];
            $name = $_POST['name'];
       if($nationalId != ''){
           $result = $conn->query("SELECT * FROM elder where nationalId = '$nationalId'");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
       } 
    elseif($name != ''){
           $result = $conn->query("SELECT * FROM elder where name like '%$name%'");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
       } 
                elseif($governorate != 'none' && $follow != 'none' && $stdate != '' && $endate != ''){
           $result = $conn->query("SELECT * FROM elder where governorate = '$governorate' and location = '$follow' and date between '$stdate' And '$endate'");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
       }
               elseif($governorate != 'none' && $follow != 'none'){
           $result = $conn->query("SELECT * FROM elder where governorate = '$governorate' and location = '$follow'");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
       }
                elseif($governorate != 'none' && $stdate != '' && $endate != ''){
           $result = $conn->query("SELECT * FROM elder where governorate = '$governorate' and date between '$stdate' And '$endate'");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
       } 
       elseif($governorate != 'none'){
           $result = $conn->query("SELECT * FROM elder where governorate = '$governorate'");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
       } 
  
       elseif($follow != 'none' && $stdate != '' && $endate != ''){
           $result = $conn->query("SELECT * FROM elder where location = '$follow' and date between '$stdate' And '$endate'");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
       }           
          
    elseif($follow != 'none'){
           $result = $conn->query("SELECT * FROM elder where location = '$follow'");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
       }
               
         
               
	 elseif($stdate != '' && $endate != ''){
           $result = $conn->query("SELECT * FROM elder where date between '$stdate' And '$endate'");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
       } 
    

        ?>
            
            	<div class="mt-5" style="border: 1px solid #eeeeee;"> 


		<div   style="overflow-x: auto; ">
			<table id="tblData" class="table table-striped table-bordered">
	        	<thead>
	           <tr>
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
                      <th>Hb</th>
	                    <th>اختبار كاشف الدم الخفي بالبراز </th>
                        <th>قياس حدة النظر</th>
	                    <th>تقييم الاسنان </th>
                        <th>رسم القلب</th>
	                    <th>اختبار Mini-Cog للتقييم النفسي </th>
                   <th>مؤشر GDS للتقييم النفسي</th>
	                    <th>للتقييم التغذوي MUST اداه  </th>
                        <th>الموجات فوق صوتيه علي البطن</th>
	                    <th>الكبد  </th>
                        <th>الكلى </th>
	                    <th>الرحم  </th>
                   <th>البروستاتا </th>
	                    <th>تضخم بالشريان الاورطي </th>
	              	</tr>
	          	</thead>
	        	<tbody>
	        		<?php foreach($customers as $customer) :  ?>
	 		    		    <tr>
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
       
                <td><?php echo $customer['hb'];?></td>
        <td><?php echo $customer['feces'];?></td>
           <td><?php echo $customer['sight'];?></td>
                                <td><?php echo $customer['teeth'];?></td>
                                <td><?php echo $customer['heart'];?></td>
       <td><?php echo $customer['cog'];?></td>
      <td><?php echo $customer['gds'];?></td>
        <td><?php echo $customer['must'];?></td>
     <td><?php echo $customer['xray'];?></td>
      <td><?php echo $customer['liver'];?></td>
        <td><?php echo $customer['kidneys'];?></td>
     	<td><?php echo $customer['womb'];?></td>
      <td><?php echo $customer['prostate'];?></td>
        <td><?php echo $customer['aorta'];?></td>
       
      </tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>

      		
		</div>

        
 
    </div>    
        <?php  
          }
          else{
          }
          
?>
   
      
        
          
          
           <footer style="position:fixed;">
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
           <script type="text/javascript">
                  document.getElementById('governorate').value = "<?php echo $_POST['governorate'];?>";
               document.getElementById('follow').value = "<?php echo $_POST['follow'];?>";
     document.getElementById('stadte').value = "<?php echo $_POST['stdate'];?>";
               document.getElementById('endate').value = "<?php echo $_POST['endate'];?>";
               document.getElementById('nationalId').value = "<?php echo $_POST['nationalId'];?>";
               document.getElementById('name').value = "<?php echo $_POST['name'];?>";
</script>
    </body>
</html>
