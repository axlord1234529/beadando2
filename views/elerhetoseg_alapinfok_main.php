<h1>Havi átlag anyagár.</h1>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div>
  <canvas id="myChart"></canvas>
</div>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($viewData['labels']) ?>,
      datasets: [{
        label: '# Anyagár',
        data: <?php echo json_encode($viewData['data']) ?>,
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
