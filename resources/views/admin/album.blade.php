@extends('admin.layout')

@section('title', 'Album')

@section('content')
<div class="row mb-3">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="h4 mb-0">Album</h1>
        <span class="text-muted">{{ sizeof($hours) }} / 1440</span>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-sm text-center align-middle">
        <thead class="table-light">
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
        </tr>
        </thead>
        <tbody>
        @for ($m = 0; $m < 60; $m++ )
            <tr>
                @for ($h = 0; $h < 24; $h++)
                    <?php
                    $t = sprintf("%02d%02d", $h, $m);
                    $hh = sprintf("%02d", $h);
                    $mm = sprintf("%02d", $m);
                    ?>
                    @if (isset($hours[$t]))
                        <td class="table-success">
                            @if ($hours[$t] > 1)
                                <span class="small text-muted">({{ $hours[$t] }})</span>&nbsp;
                            @endif
                            <strong>
                                <a href="{{ route('admin.minute', ['hr' => $hh, 'mi' => $mm]) }}">
                                    {{ $hh }}:{{ $mm }}
                                </a>
                            </strong>
                        </td>
                    @else
                        <td class="table-danger">
                            {{ $hh }}:{{ $mm }}
                        </td>
                    @endif
                @endfor
            </tr>
        @endfor
        </tbody>
    </table>
</div>
@endsection

