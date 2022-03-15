<?php include '../connection.php'; require_once 'header.php'; ?>
<html dir="rtl">
<head>
     <script src="../js/jquery-3.3.1.min.js"></script> 
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
    </head>

    <body>
      <h4 class="text-center pt-3 mr-4 font-weight-bold">  تقرير إحصائي بعدد المترددين و الذين يعانون من امراض مزمنة علي مستوي الجمهورية بالمحافظات و الوحدات </h4>
        
       <div class="pl-5 pt-3 title text-center text-dark mb-3" style="background-color:#ffffff;">
    <div class=" WOW fadeIn text-right">
      <form name="login" id="login" action="" method="POST">
        <div class="row mr-3">
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
                <input type="date" name="stdate" id="stdate" class="form-control" value="<?php echo $_POST['stdate'] ?? ''; ?>">
                </div>
                
 <div class="col-2">
                    <label for="endate" class="form-label">إلى :</label>
                <input type="date" name="endate" id="endate" class="form-control" value="<?php echo $_POST['endate'] ?? ''; ?>">
            
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
        {
$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 100;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
if(isset($_POST['search'])){
        $stdate = $_POST['stdate'];
        $endate = $_POST['endate'];
        $governorate = $_POST['governorate'];
        $follow = $_POST['follow'];
        if($stdate != '' && $endate != '' && $governorate != '--اختر--' && $follow != '--اختر--'){
            echo "4";
            echo $follow;
             echo $governorate;
        $result = $conn->query("SELECT governorate,location,count(ID) as total,sum(case when diabetes = 'نعم' then 1 else 0 end) as diabetes,sum(case when bloodpressure = 'نعم' then 1 else 0 end) as bloodpressure,sum(case when egfr != '0' and creatinine != '0' then 1 else 0 end) as egfr,sum(case when hba != '0' then 1 else 0 end) as hba,sum(case when ldl != '0' and hdl != '0' and triglycerides != '0' and cholesterol != '0' then 1 else 0 end) as ldl,sum(case when egfr BETWEEN 1 and 90 then 1 else 0 end) as Yesegfr, sum(case when diabetesCheck > 200 then 1 else 0 end) as yesdiabetes , sum(case when ldl > '150' and triglycerides > '150' and cholesterol > '200' then 1 else 0 end) as yesldl FROM test where governorate = '$governorate' and location = '$follow' and date between '$stdate' AND '$endate' GROUP by governorate,location order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
            }
    
      else if($governorate != '--اختر--' && $follow != '--اختر--'){
            echo "2";
            echo $follow;
        $result = $conn->query("SELECT governorate,location,count(ID) as total,sum(case when diabetes = 'نعم' then 1 else 0 end) as diabetes,sum(case when bloodpressure = 'نعم' then 1 else 0 end) as bloodpressure,sum(case when egfr != '0' and creatinine != '0' then 1 else 0 end) as egfr,sum(case when hba != '0' then 1 else 0 end) as hba,sum(case when ldl != '0' and hdl != '0' and triglycerides != '0' and cholesterol != '0' then 1 else 0 end) as ldl,sum(case when egfr BETWEEN 1 and 90 then 1 else 0 end) as Yesegfr, sum(case when diabetesCheck > 200 then 1 else 0 end) as yesdiabetes , sum(case when ldl > '150' and triglycerides > '150' and cholesterol > '200' then 1 else 0 end) as yesldl FROM test where governorate = '$governorate' and location = '$follow' GROUP by governorate,location order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
            }
    
else if($governorate = '--اختر--' && $follow = '--اختر--' && $stdate != '' && $endate != ''){
              echo "date";
     echo $governorate;
     echo $follow;
$result = $conn->query("SELECT governorate,location,count(ID) as total,sum(case when diabetes = 'نعم' then 1 else 0 end) as diabetes,sum(case when bloodpressure = 'نعم' then 1 else 0 end) as bloodpressure,sum(case when egfr != '0' and creatinine != '0' then 1 else 0 end) as egfr,sum(case when hba != '0' then 1 else 0 end) as hba,sum(case when ldl != '0' and hdl != '0' and triglycerides != '0' and cholesterol != '0' then 1 else 0 end) as ldl,sum(case when egfr BETWEEN 1 and 90 then 1 else 0 end) as Yesegfr, sum(case when diabetesCheck > 200 then 1 else 0 end) as yesdiabetes , sum(case when ldl > '150' and triglycerides > '150' and cholesterol > '200' then 1 else 0 end) as yesldl FROM test where date between '$stdate' AND '$endate' GROUP by governorate,location order by governorate");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
          }
    else if($follow != '--اختر--' && $stdate != '' && $endate != '' ){
              echo "date & follow";
$result = $conn->query("SELECT governorate,location,count(ID) as total,sum(case when diabetes = 'نعم' then 1 else 0 end) as diabetes,sum(case when bloodpressure = 'نعم' then 1 else 0 end) as bloodpressure,sum(case when egfr != '0' and creatinine != '0' then 1 else 0 end) as egfr,sum(case when hba != '0' then 1 else 0 end) as hba,sum(case when ldl != '0' and hdl != '0' and triglycerides != '0' and cholesterol != '0' then 1 else 0 end) as ldl,sum(case when egfr BETWEEN 1 and 90 then 1 else 0 end) as Yesegfr, sum(case when diabetesCheck > 200 then 1 else 0 end) as yesdiabetes , sum(case when ldl > '150' and triglycerides > '150' and cholesterol > '200' then 1 else 0 end) as yesldl FROM test where location = '$follow' and date between '$stdate' AND '$endate' GROUP by governorate,location order by governorate");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
          }
    
      else if($stdate != '' && $endate != '' && $governorate != 'none' && $follow = '--اختر--'){
              echo "date & gov";
$result = $conn->query("SELECT governorate,location,count(ID) as total,sum(case when diabetes = 'نعم' then 1 else 0 end) as diabetes,sum(case when bloodpressure = 'نعم' then 1 else 0 end) as bloodpressure,sum(case when egfr != '0' and creatinine != '0' then 1 else 0 end) as egfr,sum(case when hba != '0' then 1 else 0 end) as hba,sum(case when ldl != '0' and hdl != '0' and triglycerides != '0' and cholesterol != '0' then 1 else 0 end) as ldl,sum(case when egfr BETWEEN 1 and 90 then 1 else 0 end) as Yesegfr, sum(case when diabetesCheck > 200 then 1 else 0 end) as yesdiabetes , sum(case when ldl > '150' and triglycerides > '150' and cholesterol > '200' then 1 else 0 end) as yesldl FROM test where governorate = '$governorate' and date between '$stdate' AND '$endate' GROUP by governorate,location order by governorate");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
          }
    
    
        else{
           $result = $conn->query("SELECT governorate,location,count(ID) as total,sum(case when diabetes = 'نعم' then 1 else 0 end) as diabetes,sum(case when bloodpressure = 'نعم' then 1 else 0 end) as bloodpressure,sum(case when egfr != '0' and creatinine != '0' then 1 else 0 end) as egfr,sum(case when hba != '0' then 1 else 0 end) as hba,sum(case when ldl != '0' and hdl != '0' and triglycerides != '0' and cholesterol != '0' then 1 else 0 end) as ldl,sum(case when egfr BETWEEN 1 and 90 then 1 else 0 end) as Yesegfr, sum(case when diabetesCheck > 200 then 1 else 0 end) as yesdiabetes , sum(case when ldl > '150' and triglycerides > '150' and cholesterol > '200' then 1 else 0 end) as yesldl FROM test where governorate = '$governorate' GROUP by governorate,location order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
        }
    }
else{
$result = $conn->query("SELECT governorate,location,count(ID) as total,sum(case when diabetes = 'نعم' then 1 else 0 end) as diabetes,sum(case when bloodpressure = 'نعم' then 1 else 0 end) as bloodpressure,sum(case when egfr != '0' and creatinine != '0' then 1 else 0 end) as egfr,sum(case when hba != '0' then 1 else 0 end) as hba,sum(case when ldl != '0' and hdl != '0' and triglycerides != '0' and cholesterol != '0' then 1 else 0 end) as ldl,sum(case when egfr BETWEEN 1 and 90 then 1 else 0 end) as Yesegfr, sum(case when diabetesCheck > 200 then 1 else 0 end) as yesdiabetes , sum(case when ldl > '150' and triglycerides > '150' and cholesterol > '200' then 1 else 0 end) as yesldl FROM test GROUP by governorate,location ORDER by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);       
        }      
	$result1 = $conn->query("SELECT count(id) AS id FROM test");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit  );
if($page < 1){
    $page = 1;
}
	$Previous = $page - 1;
	$Next = $page + 1;
              
          }
          ?>
            	<div class="mx-5 mt-5" style="border: 1px solid #eeeeee;"> 
        
	
		<div style="overflow-x: auto; margin-x:10px;">
			<table id="tblData" class="table table-striped table-bordered">
	        	<thead>
	           <tr>
                       <th class="text-center" style="word-wrap: break-word;">المحافظة</th>
                   <th class="text-center" style="word-wrap: break-word;">الوحدة</th>
                   <th class="text-center" style="word-wrap: break-word;">الإجمالى</th>
                        <th class="text-center" style="word-wrap: break-word;">إجمالى مرضـى ضغط</th>
                   <th class="text-center" style="word-wrap: break-word;">إجمالى مرضـى سكر</th>
                        <th class="text-center" style="word-wrap: break-word;">إجمالى تم كشف كُلى</th>
	                    <th class="text-center" style="word-wrap: break-word;">إجمالى تم كشف دهون فى الدم</th>
	                    <th class="text-center" style="word-wrap: break-word;">إجمالى تم كشف سكر تراكمى </th>
	                    <th class="text-center" style="word-wrap: break-word;">إجمالى تم التشخيص كمريض كُلى</th>
                   <th class="text-center" style="word-wrap: break-word;">إجمالى تم التشخيص كمريض دهون فى الدم</th>
                   <th class="text-center" style="word-wrap: break-word;">إجمالى تم التشخيص كمريض سكر فى الدم</th>
	              	</tr>
	          	</thead>
	        	<tbody>
	        		<?php foreach($customers as $customer) :  ?>
	 		    		    <tr>
    <td><?php echo $customer['governorate'];?></td>
                                <td><?php echo $customer['location'];?></td>
                                <td><?php echo $customer['total'];?></td>
    <td><?php echo $customer['bloodpressure'];?></td>
                                <td><?php echo $customer['diabetes'];?></td>
      <td><?php echo $customer['egfr'];?></td>
      <td><?php echo $customer['ldl'];?></td>
      <td><?php echo $customer['hba'];?></td>
      <td><?php echo $customer['Yesegfr'];?></td>
                                <td><?php echo $customer['yesldl'];?></td>
                                <td><?php echo $customer['yesdiabetes'];?></td>
      </tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>

      		
		</div>

        <div style="background-color:transparent; " aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="monthly.php?page=<?= $Previous; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo; السابق</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
          
    
    <li class="page-item">
      <a class="page-link" href="monthly.php?page=<?= $Next; ?>" aria-label="Next">
        <span aria-hidden="true">التالى &raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</div>

    </div>
              
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
</script>
    </body>
</html>