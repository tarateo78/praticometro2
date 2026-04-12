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
    <div>
        <form action="{{ route('practices.index') }}" method="GET">
            <label for="cerca">CERCA</label><input type="text" name="cerca" id="cerca"/>
            <label for="is_in_corso">In corso</label><input type="checkbox" name="is_in_corso" id="is_in_corso" checked>
            <button type="submit">CERCA</button>
        </form>
    </div>

    <table>
        @foreach($practices as $practice)
        <tr>

            <td>{{ $practice->codice }}</td>
            <td><a href="{{ route('practices.edit', $practice) }}">🔎</a></td>
            <td>{{ $practice->titolo }}</td>
            <td>
                <span style="background-color:{{ $practice->is_avvio_progettazione == true ? " lightgreen" : ""
                    }}">P</span>
                <span style="background-color:{{ $practice->is_avvio_progettazione == true ? " lightgreen" : ""
                    }}">G</span>
                <span style="background-color:{{ $practice->is_avvio_progettazione == true ? " lightgreen" : ""
                    }}">L</span>
                <span style="background-color:{{ $practice->is_avvio_progettazione == true ? " lightgreen" : ""
                    }}">C</span>
            </td>
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