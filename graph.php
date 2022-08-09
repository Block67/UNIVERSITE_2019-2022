<?php include ('connexion_base.php'); ?>
<?php
//$query = "SELECT sexe, COUNT(*) AS number FROM patients GROUP BY sexe";
$query = $base->prepare('SELECT sexe, COUNT(*) AS number FROM patients GROUP BY sexe');
$query->execute();
//$result = mysqli_query($base, $query);

?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Sexe', 'number'],
        
          <?php
              while ($row = $query->fetch())
{
echo "['".$row['sexe']."',".$row['number']."],";

}
?>
        ]);

        var options = {
          title: 'Statistiques des Patients vaccinés'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
