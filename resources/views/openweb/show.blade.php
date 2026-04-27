<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettaglio pratica {{ $practice->codice }}</title>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @vite(['resources/css/app.css', 'resources/css/frontend.css', 'resources/js/app.js'])

    <style>
        /* Impedisce a Tailwind di forzare l'altezza massima delle immagini della mappa */
        #map img {
            max-width: none !important;
            max-height: none !important;
        }
    </style>
</head>

<body>
    <h1>{{ $practice->titolo }}</h1>
    <a href="{{ route('openweb.index') }}" class="m-2 p-2 border border-blue-600 rounded-2xl">← Torna a Elenco</a>

    <div class="grid grid-cols-1 md:grid-cols-8">
        <div class="col-span-4">
            <dl class="grid grid-cols-12">
                <dt>Codice pratica:</dt>
                <dd class="text-lg md:text-3xl">{{ $practice->codice }}</dd>
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
                    {{ $data->format('d/m/Y')}}
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
        <div class="col-span-3 p-4">

            <div id="map" class="map"></div>

        </div>
        <div></div>
    </div>

    <script>
        @php

            if (isset($practice->coordinate)) {
                $coordinate = explode("|", $practice->coordinate)[0];
                $zoom = 11;
            } else {
                $coordinate = "45.895237, 9.341697";
                $zoom = 10;
            }
        @endphp
    


        // Inizializza la mappa centrata sulle coordinate fornite con fattore zoom
        var map = L.map('map').setView([{{ $coordinate }}], {{ $zoom }});
        // lecco 45.852455, 9.395464
        // abbadia 45.895237,9.341697
        // ballabio 45.896247,9.425201

        // Aggiunge il layer di OpenStreetMap (le "mattonelle" della mappa)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);


        // Assegna l'array degli oggetti pratiche filtrate
        let practices = null;

        // la variabile practice è istanziata nella pagina di dettaglio (show)
        let practice = @js($practice);
        const paginaDettaglio = true;

        const pathDettaglio = "show";
        const pathOperazione = "";
        
        // Segue: marker-lavori.js e strade-provincia.js

    </script>

    @vite(['resources/js/strade-provincia.js', 'resources/js/marker-lavori.js'])

</body>

</html>