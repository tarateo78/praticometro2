<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettaglio pratica {{ $practice->codice }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend.css','resources/js/app.js'])
</head>

<body>
    <h1>{{ $practice->titolo }}</h1>
    <div class="grid grid-cols-1 md:grid-cols-2">
        <dl class="grid grid-cols-2">
            <dt> codice: </dt>
            <dd> {{ $practice->codice }} </dd>
            <dt>titolo</dt>
            <dd>{{ $practice->titolo_esteso }}</dd>
            <dt>zona</dt>
            <dd>{{ $practice->zona }}</dd>
            <dt>strade</dt>
            <dd>{{ $practice->strade }}</dd>
            <dt>importo</dt>
            <dd>{{ $practice->importo }}</dd>
            <dt>finanziamento</dt>
            <dd>{{ $practice->finanziamento }}</dd>
            <dt>is_avvio_progettazione</dt>
            <dd>{{ $practice->is_avvio_progettazione }}</dd>
            <dt>is_avvio_gara</dt>
            <dd>{{ $practice->is_avvio_gara }}</dd>
            <dt>is_lavori_in_corso</dt>
            <dd>{{ $practice->is_lavori_in_corso }}</dd>
            <dt>is_cre</dt>
            <dd>{{ $practice->is_cre }}</dd>
            <dt>cre_at</dt>
            <dd>{{ $practice->cre_at }}</dd>
            <dt>scadenza_esecuzione</dt>
            <dd>{{ $practice->scadenza_esecuzione }}</dd>
            <dt>coordinate</dt>
            <dd>{{ $practice->coordinate }}</dd>
        </dl>

    </div>

</body>

</html>