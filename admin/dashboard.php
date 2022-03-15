<?php 
require_once 'header.php'; 
 require_once '../connection.php'; 
 $query = "SELECT gender, count(*) as number from test GROUP BY gender";  
 $result = mysqli_query($conn, $query);  
$query1 = "SELECT governorate, count(*) as number from test where governorate != 'غير معرف' GROUP BY governorate order by number";  
 $result1 = mysqli_query($conn, $query1); 
$query2 = "SELECT nationality, count(*) as number from test GROUP BY nationality";  
 $result2 = mysqli_query($conn, $query2); 

$query3 = "SELECT count(*) as number,sum(case when age BETWEEN 18 and 39 then 1 else 0 end) as less,sum(case when  age BETWEEN 40 and 59 then 1 else 0 end) as equal,sum(case when age >= 60 then 1 else 0 end) as more from test order by number";  
 $result3 = mysqli_query($conn, $query3); 

$query4 = "SELECT count(*) as number,sum(case when egfr >= 90 then 1 else 0 end) as normal,sum(case when egfr BETWEEN 60 and 89 then 1 else 0 end) as first,sum(case when  egfr BETWEEN 30 and 59 then 1 else 0 end) as second,sum(case when  egfr BETWEEN 15 and 29 then 1 else 0 end) as third,sum(case when  egfr BETWEEN 1 and 14 then 1 else 0 end) as fourth from test order by number";  
 $result4 = mysqli_query($conn, $query4); 

$query5 = "SELECT diabetes, count(*) as number from test GROUP BY diabetes";  
 $result5 = mysqli_query($conn, $query5); 

$query6 = "SELECT bloodpressure, count(*) as number from test GROUP BY bloodpressure";  
 $result6 = mysqli_query($conn, $query6); 


$query7 = "SELECT heartdisease, count(*) as number from test GROUP BY heartdisease";  
 $result7 = mysqli_query($conn, $query7); 

$query8 = "SELECT smoking, count(*) as number from test GROUP BY smoking";  
 $result8 = mysqli_query($conn, $query8); 

$query9 = "SELECT sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid, sum(case when BMI > 45 then 1 else 0 end) as super , count(*) as number from test order by number";  
 $result9 = mysqli_query($conn, $query9); 



$query10 = "SELECT count(*) as number,sum(case when diabetes = 'نعم' and hba <= 7 then 1 else 0 end) as good,sum(case when diabetes = 'نعم' and hba BETWEEN 7 and 10 then 1 else 0 end) as fair,sum(case when  diabetes = 'نعم' and hba > 10 then 1 else 0 end) as bad from test order by number";  
 $result10 = mysqli_query($conn, $query10); 
$query11 = "SELECT count(*) as number,sum(case when diabetes = 'لا' and hba <= 5.7 then 1 else 0 end) as normal,sum(case when diabetes = 'لا' and hba BETWEEN 5.8 and 6.4 then 1 else 0 end) as pre,sum(case when  diabetes = 'لا' and hba > 6.5 then 1 else 0 end) as diabetic from test order by number";  
 $result11 = mysqli_query($conn, $query11); 
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head> 
          <style>
              .previous{
	margin-top: 50px;
                
	cursor: pointer;
	box-shadow: 3px 4px 3px 4px #888888;
}
.previous:hover{
	cursor: pointer;
	border-radius: 25px;
	box-shadow: 4px 5px 4px 5px #888888;
    transition: 0.5s;
}
          </style>
           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
               google.charts.setOnLoadCallback(drawChart1); 
               google.charts.setOnLoadCallback(drawChart2); 
               google.charts.setOnLoadCallback(drawChart3);
                google.charts.setOnLoadCallback(drawChart4);
               google.charts.setOnLoadCallback(drawChart5);
               google.charts.setOnLoadCallback(drawChart6);
               google.charts.setOnLoadCallback(drawChart7);
               google.charts.setOnLoadCallback(drawChart8);
               google.charts.setOnLoadCallback(drawChart9);
               google.charts.setOnLoadCallback(drawChart10);
               google.charts.setOnLoadCallback(drawChart11);
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Gender', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["gender"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                    legend:'bottom',
                  
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
        function drawChart1()  
           {  
                var data = google.visualization.arrayToDataTable([ 
                          ['Governorate', 'الإجمالى'],  
                          <?php  
                          while($row = mysqli_fetch_array($result1))  
                          {  
                               echo "['".$row["governorate"]."', ".$row["number"]."],";  
                          }  
                          ?> 
                    
                     ]); 
                var options = { 
                    animation: { 
                        duration: 1000,
          easing: 'out',
          startup: true},
legend:'none',
                    chartArea: {
            left: 0,
            right: 0
          }
                     };  
                var chart = new google.visualization.ColumnChart(document.getElementById('piechart1'));  
                chart.draw(data, options);  
           } 
               function drawChart2()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Ntionality', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result2))  
                          {  
                               echo "['".$row["nationality"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                     animation: { 
                        duration: 1000,
          easing: 'out',
          startup: true},
                    legend:'bottom',
                    
                     colors: ['#e26a89', '#0071cc'],
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart2'));  
                chart.draw(data, options);  
           }  
                    function drawChart3()  
           {  
             var data = google.visualization.arrayToDataTable([  
                          ['الإجمالى','18-39','40-59','> 60'],  
                          <?php  
                          while($row = mysqli_fetch_array($result3))  
                          {  
                               echo "['',".$row["less"].",".$row["equal"].",".$row["more"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
       legend:'bottom'
                     };  
                var chart = new google.visualization.ColumnChart(document.getElementById('piechart3'));  
                chart.draw(data, options);  
           }
                               function drawChart4()  
           {  
             var data = google.visualization.arrayToDataTable([  
                          ['الإجمالى','المرحلة الاولى (طبيعى)','المرحلة الثانية','المرحلة الثالثة','المرحلة الرابعة','المرحلة الخامسة'],  
                          <?php  
                          while($row = mysqli_fetch_array($result4))  
                          {  
                               echo "['',".$row["normal"].",".$row["first"].",".$row["second"].",".$row["third"].",".$row["fourth"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
                     animation: { 
                        duration: 3000,
          easing: 'out',
          startup: true},
       legend:'bottom'
                     };  
                var chart = new google.visualization.ColumnChart(document.getElementById('piechart4'));  
                chart.draw(data, options);  
           }
               function drawChart5()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Diabetes', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result5))  
                          {  
                               echo "['".$row["diabetes"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      animation: { 
                        duration: 3000,
          easing: 'out',
          startup: true},
                    legend:'bottom',
                  
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart5'));  
                chart.draw(data, options);  
           }
                         function drawChart6()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['bloodpressure', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result6))  
                          {  
                               echo "['".$row["bloodpressure"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      animation: { 
                        duration: 3000,
          easing: 'out',
          startup: true},
                    legend:'bottom',
                  
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart6'));  
                chart.draw(data, options);  
           }
                              function drawChart7()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['heartdisease', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result7))  
                          {  
                               echo "['".$row["heartdisease"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
                      animation: { 
                        duration: 3000,
          easing: 'out',
          startup: true},
                    legend:'bottom',
                  
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart7'));  
                chart.draw(data, options);  
           }
                  function drawChart8()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Smoking', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result8))  
                          {  
                               echo "['".$row["smoking"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      animation: { 
                        duration: 3000,
          easing: 'out',
          startup: true},
                    legend:'bottom',
                  
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart8'));  
                chart.draw(data, options);  
           } 
                            function drawChart9()  
           {  
             var data = google.visualization.arrayToDataTable([  
                          ['الإجمالى','Underweight','Normal','Overweight','Obese','Serve obesity','Morbid obesity','Super obesity'],  
                          <?php  
                          while($row = mysqli_fetch_array($result9))  
                          {  
        echo "['',".$row["underweight"].",".$row["normal"].",".$row["overweight"].",".$row["obese"].",".$row["serve"].",".$row["morbid"].",".$row["super"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
                      animation: { 
                        duration: 3000,
          easing: 'out',
          startup: true},
       legend:'bottom'
                     };  
                var chart = new google.visualization.ColumnChart(document.getElementById('piechart9'));  
                chart.draw(data, options);  
           }
            function drawChart10()  
           {  
             var data = google.visualization.arrayToDataTable([  
                          ['الإجمالى','Good Control','Fair Control','Bad Control'],  
                          <?php  
                          while($row = mysqli_fetch_array($result10))  
                          {  
        echo "['',".$row["good"].",".$row["fair"].",".$row["bad"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
                      animation: { 
                        duration: 3000,
          easing: 'out',
          startup: true},
       legend:'bottom'
                     };  
                var chart = new google.visualization.ColumnChart(document.getElementById('piechart10'));  
                chart.draw(data, options);  
           }   
               
                  function drawChart11()  
           {  
             var data = google.visualization.arrayToDataTable([  
                          ['الإجمالى','Normal','Prediabetic','Diabetic'],  
                          <?php  
                          while($row = mysqli_fetch_array($result11))  
                          {  
        echo "['',".$row["normal"].",".$row["pre"].",".$row["diabetic"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
                      animation: { 
                        duration: 3000,
          easing: 'out',
          startup: true},
       legend:'bottom'
                     };  
                var chart = new google.visualization.ColumnChart(document.getElementById('piechart11'));  
                chart.draw(data, options);  
           }    
           </script>  
      </head>  
      <body>  
           <div class="title text-center text-dark border-bottom mb-3" >
        <h4 class="heading font-weight-bold">مبادرة السيد رئيس الجمهورية <br>  لـفحـص و علاج الأمـراض الـمـزمنة و الكشف الـمـبـكر للاعتلال الـكلـوى </h4>
            </div>
          <div class="container-fluid mb-5">
         
          <div class="previous col-11 mr-5 pt-5">   
              <p class="text-center font-weight-bold">الأعداد طبقاً للمحافظة</p>
                <div  id="piechart1" style="width: 100%; height: 500px;">
              </div>
           </div>  
           <div class="row">
               <div class="col-1"></div>
              <div class="col-4 mr-3 previous pt-2">
                  <p class="text-center font-weight-bold">النسب طبقاً للنوع</p>
                <div id="piechart" style="width: 500px; height: 300px;"></div>  
           </div>  
               <div class="col-1 "></div>
             <div class="col-4 previous pt-2">     
                   <p class="text-center font-weight-bold">النسب طبقاً للجنسية</p>
                <div id="piechart2" style="width: 500px; height: 300px;"></div>  
           </div>
                <div class="col-1 "></div>
              </div>
              <div class="row mr-5">
               <div class="col-5 previous pt-2 ml-5">     
                   <p class="text-center font-weight-bold">الأعداد طبقاً للفئة العمرية</p>
                <div   id="piechart3" style="width: 100%; height: 500px;"></div> 
           </div> 
                 <div class="col-6 previous pt-2"> 
                     <p class="text-center font-weight-bold">الأعداد طبقاً لمحراحل الاعتلال الكُلوى</p>
                <div  id="piechart4" style="width: 100%; height: 500px;"></div> 
           </div>  
                  </div>
               <div class="row mr-5">
               <div class="col-3 previous mr-5 pt-3">   
                   <p class="text-center font-weight-bold">النسب طبقاً للتاريخ المرضـي<br> للإصابة بالسكر</p>
                <div  id="piechart5" style="width: 100%; height: 300px;"></div> 
           </div> 
                   <div class="col-1"></div>
                 <div class="col-3 previous pt-3">   
                     <p class="text-center font-weight-bold">النسب طبقاً للتاريخ المرضـي <br>للإصابة بإرتفاع ضغط الدم </p>
                <div  id="piechart6" style="width: 100%; height: 300px;"></div> 
           </div> <div class="col-1"></div>
                    <div class="col-3 previous pt-3">     
                        <p class="text-center font-weight-bold">النسب طبقاً للتاريخ المرضـي<br> للإصابة بأمراض القلب</p>
                <div  id="piechart7" style="width: 100%; height: 300px;"></div> 
           </div> 
                  </div>
              
                      <div class="row mr-5">
               <div class="col-3 previous mr-5 pt-3">   
                   <p class="text-center font-weight-bold">النسب طبقاً للتدخين</p>
                <div  id="piechart8" style="width: 100%; height: 350px;"></div> 
           </div> 
                          <div class="col-1"></div>
                               <div class="col-7 previous pt-2"> 
                     <p class="text-center font-weight-bold">الأعداد طبقاً لنتائج فحص مؤشركتلة الجسم</p>
                <div  id="piechart9" style="width: 100%; height: 350px;"></div> 
           </div>  
              </div>
              
              
             
                      <div class="row mr-5">
               <div class="col-5 previous mr-5 pt-3">   
                   <p class="text-center font-weight-bold">نتائج قياسات السكر التراكمى فى المصابين بمرض السكر</p>
                <div  id="piechart10" style="width: 100%; height: 350px;"></div> 
           </div> 
                          <div class="col-1"></div>
                               <div class="col-5 previous pt-2"> 
                     <p class="text-center font-weight-bold">نتائج قياسات السكر التراكمى فى غير المصابين بمرض السكر</p>
                <div  id="piechart11" style="width: 100%; height: 350px;"></div> 
           </div>  
              </div>
              
              
          </div>
           
      </body>  
 </html>  