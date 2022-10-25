<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<style>
img {
    width: 100%;
    max-width: 640px;
}
</style>
</head>
<body>
    <h1>Time {{ $hour }}:{{ sprintf("%02d", $minute)}}</h1>
    @foreach ($times as $t)
    <img src="{{ $t['picture'] }}">
        
    @endforeach
</body>
</html>