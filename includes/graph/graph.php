
<!--<link rel="stylesheet" href="includes/graph/css/styles.css" />
    <canvas id="canvas" style="display: block; width: 1379px; height: 689px;" width="1379" height="689" class="chartjs-render-monitor"></canvas>-->


<script src ="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.min.js"> </script>
<link rel="stylesheet" href="includes/graph/css/styles.css" />

<body>
    <canvas id = "graph1"> </canvas>
</body>
</html>

<script>
  const ctx = document.getElementById('graph1');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Janvier', 'frevrier', 'mars', 'avril', 'mais', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [350, 300, 500, 550, 590, 630],
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