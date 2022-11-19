<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hours</title>
    <link href="/dist/css/admin.css" rel="stylesheet">
    <script src="/dist/chart/chart.js"></script>
</head>
<body>
    <h1>Hours</h1>
    <table class="hours">
        @for ($t = 0; $t<12; $t++) 
            <tr>
                @for ( $c = 0; $c<2; $c++)
                <td>
                    <?php $h = $t + $c * 12; ?>
                    @if ( isset($hours[$h]) )
                        <a href="{{ '/hour/'.$h }}"><b>{{$h}}</b></a> </td><td><b>{{ $hours[$h] }}</b>
                    @else
                        <span class="miss">{{ $h }}</span></td><td>0
                    @endif
                </td>
                @endfor
            </tr>
        @endfor
    </table>

    <canvas id="myChart" style="width:100%"></canvas>

<!-- script>
var xValues = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
var yValues = [0,0,0,0,1,3,0,0,0,3,3,6,15,10,13,23,21,15,25,38,40,28,23,16];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: true,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 6, max:16}}],
    }
  }
});
</script -->
</body>
</html>