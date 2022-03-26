<?php
$customers = json_decode(file_get_contents("https://cogno.fr/api/codepostal"), true);
ob_start();
?>

<?php 

  foreach($customers as $customer)
  {
    $customer_state[] = $customer['customer_state'];
    $repartition_total[] = $customer['repartition_total'];
  }

?>

<?php
$content = ob_get_clean();
require_once("template.php");
?>

<div style="width: 75%; margin: 0 auto;">
  <canvas id="myChart"></canvas>
</div>
 
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($customer_state) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Répartition des utilisateurs par code postal en %',
      data: <?php echo json_encode($repartition_total) ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

</body>
</html>
