<?php
$products = json_decode(file_get_contents("https://cogno.fr/api/categories"), true);
ob_start();
?>

<?php 

  foreach($products as $product)
  {
    $product_category_name_english[] = $product['product_category_name_english'];
    $categorie_total[] = $product['categorie_total'];
  }

?>

<?php
$content = ob_get_clean();
require_once("template.php");
?>

<div style="width: 50%; margin: 0 auto;">
  <canvas id="myChart"></canvas>
</div>
 
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($product_category_name_english) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Répartition des utilisateurs par code postal en %',
      data: <?php echo json_encode($categorie_total) ?>,
      backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
    hoverOffset: 4
    }]
  };

  const options = {
    plugins: {
      legend: {
        display: false
        }
      }
    };
  

  const config = {
    type: 'pie',
    data: data,
    options
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

</body>
</html>
