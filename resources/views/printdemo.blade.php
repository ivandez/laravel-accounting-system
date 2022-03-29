<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/print.min.css') }}"/>
</head>
<body>
<table border="1" cellpadding="3" id="printTable">
    <tbody>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Points</th>
    </tr>
    <tr>
        <td>Jill</td>
        <td>Smith</td>
        <td>50</td>
    </tr>
    <tr>
        <td>Eve</td>
        <td>Jackson</td>
        <td>94</td>
    </tr>
    <tr>
        <td>John</td>
        <td>Doe</td>
        <td>80</td>
    </tr>
    <tr>
        <td>Adam</td>
        <td>Johnson</td>
        <td>67</td>
    </tr>
    </tbody>
</table>

<br/>
<br/>

{{--El primer argumento es el ID del HTML a imprimir--}}
{{--Recuerda que para centar la tabla se tiene que hacer dede las opciones de impresion de chrome--}}
<button type="button" onclick="printJS('printTable', 'html')">
    Print Form
</button>

<script src="{{ asset('js/print.min.js') }}"></script>
</body>
</html>
