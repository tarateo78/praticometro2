<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettaglio pratica {{ $practice->codice }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    codice: {{ $practice->codice }}
    <br>
    titolo: {{ $practice->titolo }}
    <br>
    zona: {{ $practice->zona }}
    <br>
    strade: {{ $practice->strade }}
    <br>
    importo: {{ $practice->importo }}
    <br>
    finanziamento: {{ $practice->finanziamento }}
    <br>
    is_avvio_progettazione: {{ $practice->is_avvio_progettazione }}
    <br>
    is_avvio_gara: {{ $practice->is_avvio_gara }}
    <br>
    is_lavori_in_corso: {{ $practice->is_lavori_in_corso }}
    <br>
    is_cre: {{ $practice->is_cre }}
    <br>
    cre_at: {{ $practice->cre_at }}
    <br>
    scadenza_esecuzione: {{ $practice->scadenza_esecuzione }}
    <br>
    coordinate: {{ $practice->coordinate }}
    <br>

</body>

</html>