<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Album</title>
    <link href="/dist/css/admin.css" rel="stylesheet">
</head>
<body>
    <table class="head"><tr><td>
    <h1>Album</h1>
    </td>
    <td align="right">
        {{ sizeof($hours) }} / 1440
    </td>
    </tr></table>
    <table class="album">
        <thead>
            <tr>
                <th>00</th>
                <th>01</th>
                <th>02</th>
                <th>03</th>
                <th>04</th>
                <th>05</th>
                <th>06</th>
                <th>07</th>
                <th>08</th>
                <th>09</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>
                <th>13</th>
                <th>14</th>
                <th>15</th>
                <th>16</th>
                <th>17</th>
                <th>18</th>
                <th>19</th>
                <th>20</th>
                <th>21</th>
                <th>22</th>
                <th>23</th>
        </thead>
        <tbody>
            @for ($m = 0; $m < 60; $m++ ) 
                <tr>
                @for ($h = 0; $h<24; $h++)
                        <?php
                            $t = sprintf("%02d%02d", $h, $m);
                            $hh = sprintf("%02d", $h);
                            $mm = sprintf("%02d", $m);
                            if ( isset($hours[$t]) ) {
                                echo '<td class="green"><b>'.$hh.':'.$mm.'</b></td>';
                            } else {
                                echo '<td class="red">'.$hh.':'.$mm.'</td>';
                            }
                        ?>
                @endfor
                </tr>
            @endfor
        </tbody>
    </table>
</body>
</html>