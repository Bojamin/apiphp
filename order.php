<?php
$orders = json_decode(file_get_contents("https://cogno.fr/api/order"), true);
ob_start();
?>

<?php 

  foreach($orders as $order)
  {
    $order_status[] = $order['order_status'];
    $status_count[] = $order['status_count'];
  }

?>

<?php
$content = ob_get_clean();
require_once("template.php");
?>

<div style="width: 35%; margin: 0 auto;">
  <canvas id="myChart"></canvas>
</div>
 
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($order_status) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Répartition des utilisateurs par code postal en %',
      data: <?php echo json_encode($status_count) ?>,
      backgroundColor: [
      '#cb997e',
      '#ddbea9',
      '#ffe8d6',
      '#b7b7a4',
      '#a5a58d',
      '#6b705c'
    ],
    hoverOffset: 4
    }]
  };

  const config = {
    type: 'pie',
    data: data,
    options: {}
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

</body>
</html>
