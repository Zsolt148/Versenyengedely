<!doctype html>
<html lang="hu">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ storage_path('app/app.css') }}" rel="stylesheet" type="text/css" />
    <style>
        body {
            background-color: white;
            line-height: 1;
            color: black;
            font-family: DejaVu Sans, sans-serif;
        }
        #background{
            top:38%;
            position:absolute;
            z-index:0;
            background:white;
            display:block;
            min-height:50%;
            min-width:50%;
            color:yellow;
        }

        #content{
            position:absolute;
            z-index:1;
        }

        #bg-text
        {
            opacity: 0.5;
            color:lightgrey;
            font-size:120px;
            transform:rotate(320deg);
            -webkit-transform:rotate(320deg);
        }
        table {
            width: 100%;
        }
        td {
            padding-bottom: 10px;
        }
        td:first-child {
            width: 40%;
        }
        /*
        table, th, td {
            border: solid 1px #DDD;
            border-collapse: collapse;
            padding: 2px 3px;
            text-align: left;
        }
        .margin {
            margin-top: 10px;
            margin-bottom: 16px;
        }
        */
    </style>

    <title>{{ $form->vnev }}_{{ $form->knev }}_Versenyengedély_{{ now()->format('Y') }}.pdf</title>
</head>
<body class="m-2">
    <div id="background">
        <p id="bg-text"><img src="{{ storage_path('app/mszuosz_logo_black.jpg') }}" alt="logo" width=""></p>
    </div>
    <div id="content">
        <div class="inline-flex mb-10">
            <img src="{{ storage_path('app/mszuosz_logo.jpg') }}" alt="logo" width="300">
            <span class="font-bold float-right" style="width: 45%">
                Magyar Szenior Úszók Országos Szövetsége Budapest 1027 Budapest, Vitéz utca 5-7 I./2
            </span>
        </div>
        <div class="flex flex-row my-5 mb-10">
            <div class="my-5 font-bold text-xl">Versenyengedély</div>
            <img src="{{ storage_path('app/public') . '/' . $form->profile_photo }}" class="float-right" alt="profilkép" width="130" height="180">
        </div>
        <br><br><br><br>
        <div class="mb-5">
            A 2004. évi I. törvény a sportról, valamint a Magyar Szenior Úszók Országos Szövetségének (továbbiakban MSZÚOSZ) hatályos versenyengedély szabályzata alapján, az MSZÚOSZ igazolja, hogy az alábbi adatokkal azonosított szenior úszó, az MSZÚOSZ tagegyesületének igazolt versenyzője.
        </div>
        <div class="mb-5 ml-5">
            <table>
                <tr>
                    <td>1.&nbsp;&nbsp;Versenyző neve:</td>
                    <td>{{ $form->vnev }} {{ $form->knev }}</td>
                </tr>
                <tr>
                    <td>2.&nbsp;&nbsp;Születési helye:</td>
                    <td>{{ $form->birth_place }}</td>
                </tr>
                <tr>
                    <td>3.&nbsp;&nbsp;Születési dátuma:</td>
                    <td>{{ $form->birth->format('Y.m.d') }}</td>
                </tr>
                <tr>
                    <td>4.&nbsp;&nbsp;Sportegyesület neve:</td>
                    <td>{{ $form->team->name }}</td>
                </tr>
                <tr>
                    <td>5.&nbsp;&nbsp;Sportág megnevezése:</td>
                    <td>szenior úszás</td>
                </tr>
                <tr>
                    <td>6.&nbsp;&nbsp;Versenyengedély száma:</td>
                    <td>{{ $form->federal_reg_code }}/{{ now()->format('Y') }}</td>
                </tr>
                <tr>
                    <td>7.&nbsp;&nbsp;Érvényességének ideje:</td>
                    <td>{{ $form->form_valid->format('Y.m.d') }}</td>
                </tr>
            </table>
        </div>
        <div class="mb-5">
            A versenyengedély csak a sportegészségügyi ellenőrzés adatait tartalmazó dokumentummal (sportorvosi engedély) együtt érvényes.
        </div>
        <div>
            A versenyengedély felhasználható az MSZÚOSZ által szervezett versenyeken (országos bajnokság, ranglista verseny, felkészülési verseny) amely összhangban van a FINA és a LEN szabályzatával.<br>
            Az MSZÚOSZ által az elektronikus rendszerben kiállított versenyengedély pecsét és aláírás nélkül hiteles!
        </div>
        <br><br><br>
        <div class="flex flex-row flex-nowrap mt-5" style="justify-content: space-between">
            <div>Kelt: Budapest, {{ now()->format('Y.m.d') }}</div>
            <div class="text-center float-right">
                {{ $form->processedBy->name }} <br>
                Magyar Szenior Úszók Országos Szövetség<br>
            </div>
        </div>
    </div>
</body>
</html>
