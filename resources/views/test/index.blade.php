<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
    <style>
        /* Stile per il campo di testo che ha la lista collegata */
        input[list] {
            padding: 10px;
            border: 2px solid #3490dc;
            border-radius: 5px;
            outline: none;
            color: #333;
        }

        /* Rimuove la freccetta predefinita in alcuni browser (opzionale) */
        input[list]::-webkit-calendar-picker-indicator {
            display: none !important;
        }
    </style>
</head>

<body>
    <h1>Test</h1>

    @foreach ($tests as $t)
        <span>{{ $t->testo }}</span> <a href="{{ route('test.show', $t->id) }}">--></a> ----
        <span>{{ $t->numero }}</span> ----
        <span>{{ $t->valuta }}</span> ----
        <span>{{ $t->data->format("d.m.Y") }}</span>

        {{-- Necessita della libreria extra: Intl, caricata da dockerfile e abilitata in php.int --}}
        <p>Prezzo: {{ Number::currency($t->valuta, in: 'EUR', locale: 'it') }}</p>

        <p>Prezzo: € {{ number_format($t->valuta, 2, ',', '.') }}</p>
        <br>
    @endforeach

    <h2>Prova List</h2>

    <label for="linguaggio">Scegli un linguaggio:</label>
    <input list="linguaggi" name="linguaggio" id="linguaggio">

    <datalist id="linguaggi">
        <option value="Selva geom. Fabrizio">
        <option value="Interno">
        <option value="Colnago arch. Maria">
        <option value="Corti geom. Luca">
        <option value="Valtolina geo. Andrea">
        <option value="Spandri ing. Lino">
        <option value="Sala Ing. Maurizio">
        <option value="Maggioni ing. Donato">
        <option value="MTS Engineering srl">
        <option value="Colombo ing Alberto e Narghes">
        <option value="Axioma">
        <option value="Alderighi ing">
        <option value="ing. Luigi Bernardi">
        <option value="Vismara Ing">
        <option value="Vincenzo geom. Fiorenza">
        <option value="Valsecchi ing. Fabio">
        <option value="Valsecchi ing Massimiliano">
        <option value="Tettamanti Ing silverio">
        <option value="Tentori ing. Silvano">
        <option value="Tecnoindagini Srl">
        <option value="Tecknoprogetti srl">
        <option value="TRM Group srl">
        <option value="TRM Engineering srl">
        <option value="Studio Tartero">
        <option value="Studio Ingeo Scinetti">
        <option value="Studio Geoplanet">
        <option value="Studio Ellevi">
        <option value="Studio Dierre - Ing Delle Rose">
        <option value="Studio Corna Pelizzoli Rota">
        <option value="Sirtori ing. Erminio Luigi">
        <option value="Savoldelli Arch. Roberto">
        <option value="Salmoiraghi Ing">
        <option value="Rtp Invernizzi Ing Tomaso">
        <option value="Riva ing. Giuseppe">
        <option value="RTP Riva Arrigoni Orlando">
        <option value="RTP Piacentini">
        <option value="RTP B&C Associati - Geolambda Engineering Srl">
        <option value="Protea srl">
        <option value="Piantoni ing. Carlo">
        <option value="Piacentini Ingegneri srl">
        <option value="Perego Raffaele ing">
        <option value="Morano ing">
        <option value="Meroni ing Gianluigi">
        <option value="Meroni ing">
        <option value="Mauri ing. Stefano">
        <option value="Mauri ing. Enea Mario">
        <option value="M2P srl Zanetti">
        <option value="M+Associati (Rtp Mauri Rossi Previati))">
        <option value="Lombardi Ingegneria srl">
        <option value="Locatelli ing. Piergiorgio">
        <option value="Invernizzi ing Alberto">
        <option value="Invernizzi Ing">
        <option value="Formenti ing Vittorio - arch Cerrano">
        <option value="Eg4Risk">
        <option value="Diamonds srl">
        <option value="Della Torre ing">
        <option value="Del Giorgio ing. Francesca">
        <option value="Davide Sergeant">
        <option value="Conti ing Cristian">
        <option value="Colombo ing. Daniele">
        <option value="Colombo Ing Stefano">
        <option value="Centro studi PIM">
        <option value="Buizza ing">
        <option value="Branchini ing Francesco">
        <option value="Auri ing">
        <option value="Amigoni ing. Christian">
        <option value="Alegi ing">
        <option value="ATP Sigeco Engineering srl">
        <option value="4 EMME SERVICE S.p.A.">
    </datalist>


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