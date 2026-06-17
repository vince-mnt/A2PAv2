<link rel="stylesheet" href="includes/graph/css/styles.css" />

<section class="dashboard-shell" aria-labelledby="production-title">
  <div class="panel-header">
    <div>
      <p class="eyebrow">Suivi de production</p>
      <h1 id="production-title">Production dans le temps</h1>
      <p class="panel-intro">Visualisation des enregistrements stock&#233;s en base, avec un graphique lisible et des indicateurs rapides.</p>
    </div>
  </div>

  <?php
  include_once 'config/database.php';
  $database = new Database();
  $db = $database->getConnection();
  $query = "SELECT number, id, date_time FROM production ORDER BY date_time ASC";
  $stmt = $db->prepare($query);
  $stmt->execute();

  $numbers = [];
  $ids = [];
  $dates = [];

  foreach ($stmt as $row) {
      $numbers[] = (float) $row['number'];
      $ids[] = (int) $row['id'];
      $dates[] = $row['date_time'];
  }

  $count = count($numbers);
  $total = $count ? array_sum($numbers) : 0;
  $average = $count ? round($total / $count, 2) : 0;
  $maxValue = $count ? max($numbers) : 0;
  ?>

  <div class="stats-grid" aria-label="Indicateurs de production">
    <article class="stat-card">
      <span class="stat-label">Entr&#233;es</span>
      <strong class="stat-value"><?php echo $count; ?></strong>
    </article>
    <article class="stat-card">
      <span class="stat-label">Total</span>
      <strong class="stat-value"><?php echo number_format($total, 0, ',', ' '); ?></strong>
    </article>
    <article class="stat-card">
      <span class="stat-label">Moyenne</span>
      <strong class="stat-value"><?php echo number_format($average, 2, ',', ' '); ?></strong>
    </article>
    <article class="stat-card">
      <span class="stat-label">Pic</span>
      <strong class="stat-value"><?php echo number_format($maxValue, 0, ',', ' '); ?></strong>
    </article>
  </div>

  <div class="chart-card">
    <?php if ($count > 0): ?>
      <canvas id="graph1" aria-label="Graphique de la production" role="img"></canvas>
    <?php else: ?>
      <p class="empty-state">Aucune donn&#233;e disponible pour afficher le graphique.</p>
    <?php endif; ?>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const labels = <?php echo json_encode($dates); ?>;
  const values = <?php echo json_encode($numbers); ?>;

  if (labels.length && values.length) {
    const ctx = document.getElementById('graph1');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels,
        datasets: [{
          label: 'Production',
          data: values,
          tension: 0.35,
          borderColor: '#4f98a3',
          backgroundColor: 'rgba(79, 152, 163, 0.18)',
          pointBackgroundColor: '#4f98a3',
          pointBorderColor: '#ffffff',
          pointRadius: 4,
          pointHoverRadius: 6,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            labels: {
              color: '#f5f7fa'
            }
          },
          tooltip: {
            callbacks: {
              label: (context) => ` ${context.dataset.label}: ${context.formattedValue}`
            }
          }
        },
        scales: {
          x: {
            ticks: { color: '#cbd5e1' },
            grid: { color: 'rgba(148, 163, 184, 0.12)' }
          },
          y: {
            beginAtZero: true,
            ticks: { color: '#cbd5e1' },
            grid: { color: 'rgba(148, 163, 184, 0.12)' }
          }
        }
      }
    });
  }
</script>
