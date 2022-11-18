<!DOCTYPE html>
<html lang="en">
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']}); //loading google table package
      google.charts.setOnLoadCallback(drawTable); //call function drawTable
      google.charts.load('current', {'packages':["bar"]}); // loading google bar package
      google.charts.setOnLoadCallback(drawBar); //call function drawBar
	  
      function drawTable() {
        var data = google.visualization.arrayToDataTable([ 
                          ['OrderNum', 'Customer','SalesRep','Region','Product','UnitPrice','NumSold','SalesDate'],  
						  //connect to mysql database
							<?php 
                           
                            $connect = mysqli_connect("localhost", "root", "", "csci440db");  
							
                            $result = mysqli_query($connect, "select OrderNum, Customer,SalesRep,Region,Product,UnitPrice,NumSold,SalesDate from etl_order"); 

                            while($row = mysqli_fetch_array($result)) 
                            { 
                               echo "[".$row["OrderNum"].",'".$row["Customer"]."','".$row["SalesRep"]."','".$row["Region"]."','".$row["Product"]."',".$row["UnitPrice"].",".$row["NumSold"].",'".$row["SalesDate"]."'],"; 
                            } 
					
							?> 
                     ]); 
		
		var options = { //style options
		showRowNumber: true, width: '100%', height: '100%'};
		
        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data,options ); //draw data
      }
	  
	  

      function drawBar() {
        var data = google.visualization.arrayToDataTable([
							['category','total_sales'],
							//connect to mysql database
							<?php 
                           
                            $connect = mysqli_connect("localhost", "root", "", "sakila");  
							
                            $result = mysqli_query($connect, "select category, total_sales from sales_by_film_category"); 

                            while($row = mysqli_fetch_array($result)) 
                            { 
                               echo "['".$row["category"]."',".$row["total_sales"]."],"; 
                            } 
					
							?> 
					]);

        var options = { //style options
          title: 'Total sales by film category',
          legend: { position: 'none' },
		   chart: { title: 'SAKILA data visualization', 
					subtitle: 'Total sales by film category'},
          bars: 'horizontal'
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div')); //using id to change bar style in html
        chart.draw(data, options);//draw data
      }
	</script>
	  
  </head>
  <body>
    <div id="table_div"></div>
	<br></br>
	<br></br>
	 <div id="top_x_div" style="width: 1200px; height: 500px;"></div>
  </body>
</html>