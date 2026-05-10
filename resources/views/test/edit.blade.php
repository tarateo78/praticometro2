<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <form action="{{ route('test.update', $test) }}" method="POST">


        @csrf <!-- Token di sicurezza obbligatorio -->

        @if($test->exists)
            @method('PUT')
        @endif

        <div>
            <label>ID:</label>
            <input type="number" name="id" value="{{ old($test->id, $test->id) }}">
            @error($test->id) <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Testo:</label>
            <input type="text" name="testo" value="{{ old($test->testo, $test->testo) }}">
            @error($test->testo) <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Numero:</label>
            <input type="number" name="numero" value="{{ old($test->numero, $test->numero) }}">
            @error($test->numero) <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Valuta €:</label>
            <input type="float" name="valuta" placeholder="0,00" step="0.01"
                value="{{ old($test->valuta, $test->valuta) }}">
            {{-- @error($test->valuta) <span style="color:red">{{ $message }}</span> @enderror --}}
        </div>
        <p>{{ $test->data->format("Y-m-d") }}</p>
        <div>
            <label>Data:</label>
            <input type="date" name="data"
                value="{{ old(date($test->data->format("Y-m-d")), date($test->data->format("Y-m-d"))) }}">
            {{-- @error($test->data) <span style="color:red">{{ $message }}</span> @enderror --}}
        </div>

        <button type="submit">Invia Dati</button>
    </form>

    <!-- Messaggio di successo -->
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

</body>

</html>