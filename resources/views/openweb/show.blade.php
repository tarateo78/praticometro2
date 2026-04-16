<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettaglio pratica {{ $practice->codice }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend.css', 'resources/js/app.js'])
</head>

<body>
    <h1>{{ $practice->titolo }}</h1>
    <a href="{{ route('openweb.index') }}">← Elenco Pratiche</a>

    <div class="grid grid-cols-1 md:grid-cols-2">
        <dl class="grid grid-cols-2">
            <dt>Codice pratica:</dt>
            <dd>{{ $practice->codice }}</dd>
            <dt>Titolo intervento:</dt>
            <dd>{{ $practice->titolo_esteso }}</dd>
            <dt>Area:</dt>
            <dd>{{ $practice->zona }}</dd>
            <dt>Strade interessate:</dt>
            <dd>
                @if($practice->strade)
                    @foreach (explode(",", $practice->strade) as $sp)
                        <span>{{ $sp }}</span>
                    @endforeach
                @endif
            </dd>
            <dt>Importo:</dt>
            <dd>
                @php
                    $importo = (float) str_replace(",", ".", str_replace(".", "", $practice->importo));
                @endphp

                {{ number_format($importo, 2, ",", ".") }} €
            </dd>
            <dt>finanziamento:</dt>
            <dd>{{ $practice->finanziamento }}</dd>
            <dt>Stato attuale:</dt>
            <dd>
                @if($practice->is_cre)
                    <span>Lavori conclusi</span>
                @else
                    @if($practice->is_lavori_in_corso)
                        <span>Lavori in corso</span>
                    @else
                        @if($practice->is_avvio_gara)
                            <span>Procedura di Appalto</span>
                        @else
                            @if ($practice->is_avvio_progettazione)
                                <span>Progettazione</span>
                            @endif
                        @endif
                    @endif
                @endif
            </dd>
            <dt>Fine Lavori:</dt>
            <dd>
                @if(isset($practice->cre_at))
                    @php
                        $data = new DateTime($practice->cre_at);
                    @endphp
                    {{  $data->format('d/m/Y')}}
                @else
                    @if (isset($practice->scadenza_esecuzione))
                        @php
                            $data = new DateTime($practice->scadenza_esecuzione);
                        @endphp
                        {{ $data->format('d/m/Y') }} <span class="text-sm italic">PRESUNTA</span>
                    @else
                        <span class="text-xs italic">IN DEFINIZIONE</span>
                    @endif
                @endif
            </dd>
        </dl>

    </div>

</body>

</html>