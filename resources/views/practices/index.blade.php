<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco pratiche</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Elenco pratiche</h1>
    <table>
        @foreach($practices as $practice)
            <tr style="background-color:{{ $practice->is_avvio_progettazione == true ? "lightgreen" : ""}}">
                
                <td ><a href="{{ route('practices.show', $practice) }}">🔎</a></td>
                <td>{{ $practice->codice }}</td>
                <td>{{ $practice->titolo }}</td>
                <td>{{ $practice->zona }}</td> 
                <td>{{ $practice->cup }}</td> 
                <td>{{ $practice->importo }}</td> 
                <td>{{ $practice->finanziamento }}</td> 
                <td>{{ $practice->rup }}</td> 
                <td>{{ $practice->gruppo }}</td> 
                <td></td> 
            </tr>
            @endforeach
    </table>
</body>
</html>