<!doctype html>
<html lang="hu">
<head>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Versenyengely pdf</title>

    <style>
        table {
            width: 100%;
        }
        table, th, td {
            border: solid 1px #DDD;
            border-collapse: collapse;
            padding: 2px 3px;
            text-align: left;
        }
    </style>
</head>
<body>
<h3>Versenyengedély</h3>
<h5>{{ $form->title }} {{ $form->vnev }} {{ $form->knev }} <span style="float:right">{{ $date }}</span></h5>
<div>
    <img src="{{ storage_path('app/public') . '/' . $profile }}" alt="" width="200" height="300">
</div>
<div>
    {{ $form->comp_type }}<br>
    {{ $form->birth->format('Y.m.d') }}<br>
    {{ $form->birth_place }}<br>
    {{ $form->sex }}<br>
    {{ $form->mother }}<br>
    {{ $form->zip }}<br>
    {{ $form->address }}<br>
    {{ $form->mobile }}<br>
    {{ $form->email }}<br>
    {{ $form->team_reg_code }}<br>
    {{ $form->federal_reg_code }}<br>
</div>

</body>
</html>
