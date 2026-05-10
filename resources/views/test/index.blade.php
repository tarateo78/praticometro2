<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>

<body>
    <h1>Test</h1>

    @foreach ($tests as $t)
        <span>{{ $t->testo }}</span> <a href="{{ route('test.show', $t->id) }}">--></a> ----
        <span>{{ $t->numero }}</span> ----
        <span>{{ $t->valuta }}</span> ----
        <span>{{ $t->data }}</span>
        <p>Prezzo: {{ Number::currency($t->valuta, in: 'EUR', locale: 'it') }}</p>

        <p>Prezzo: € {{ number_format($t->valuta, 2, ',', '.') }}</p>
        <br>
    @endforeach

    <h2>Aggiungi:</h2>
    <form action="{{ route('test.store') }}" method="POST">
        @csrf <!-- Token di sicurezza obbligatorio -->

        <div>
            <label>Testo:</label>
            <input type="text" name="testo" value="{{ old('testo') }}">
            @error('testo') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Numero:</label>
            <input type="number" name="numero" value="{{ old('numero') }}">
            @error('numero') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Valuta €:</label>
            <input type="float" name="valuta" placeholder="0,00" step="0.01" value="{{ old('valuta') }}">
            @error('valuta') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Data:</label>
            <input type="date" name="data" value="{{ old('data') }}">
            @error('data') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Invia Dati</button>
    </form>

    <!-- Messaggio di successo -->
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

</body>

</html>