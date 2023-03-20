
<!--<link rel="stylesheet" href="includes/graph/css/styles.css" />
    <canvas id="canvas" style="display: block; width: 1379px; height: 689px;" width="1379" height="689" class="chartjs-render-monitor"></canvas>-->



<link rel="stylesheet" href="includes/graph/css/styles.css" />

<div>
    <canvas id="graph1"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php 
include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();
$query = "SELECT number , id , date_time FROM production";
$stmt = $db->prepare($query);
$stmt->execute();

foreach ($stmt as $data){
  $number[] = $data['number'];
  $identifiant[] = $data['id'];
  $date_time[] = $data['date_time'];
} 
?>

<script>

  const labels = <?php echo json_encode($date_time); ?>
  const data = <?php echo json_encode($number); ?>

  const ctx = document.getElementById('graph1');
  

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Janvier', 'frevrier', 'mars', 'avril', 'mai', 'juin'],
      datasets: [{
        label: '# of Votes',
        data: [1350, 300, 500, 550, 590, 630],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
