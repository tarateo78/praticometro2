<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Totale</title>
        @vite(['resources/css/app.css', 'resources/css/backend.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Elenco totale</h1>

<table>
    <thead>
        <tr>
            
            @foreach (array_keys($practices[0]->getAttributes()) as $titolo)
            <th class="max-w-70 border-r ">{{ $titolo }}</th>
            @endforeach

        </tr>
    </thead>
    <tbody>
        @foreach ($practices as $obj)
        <tr>
            @foreach ($obj->getAttributes() as $att)
                <td class="max-w-70 border-r whitespace-normal">
                    {{ $att }}
                    </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
            

</body>
</html>