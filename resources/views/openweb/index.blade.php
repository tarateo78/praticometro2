<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progetti e Lavori</title>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 672px;
            /* width: 440px; */
            width: 100%;
            border: 2px solid #ccc;
        }

        /* Impedisce a Tailwind di forzare l'altezza massima delle immagini della mappa */
        #map img {
            max-width: none !important;
            max-height: none !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <h1>Progetti e Lavori</h1>

    <?php $importo_totale = 0; ?>

    <div class="filtra">
        <div class="form">
            <form action="{{ route('openweb.index') }}" method="GET">
                <input type="text" name="filtra" id="filtra" />
                <button type="submit">Applica filtro</button>
            </form>
        </div>
        <span>

            @if(isset($_GET['filtra']) && $_GET['filtra'] != "")
                Filtro impostato: {{ $_GET['filtra'] }} <a href="{{ route('openweb.index') }}"><span
                        class="text-xs bg-red-300 px-1 rounded-lg">x</span></a>
            @endif
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-2">
        <div class="col-span-9 my-4">
            <div class="h-160 overflow-auto">
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th>Codice</th>
                            <th>Titolo Intervento</th>
                            <th>Stato Pratica</th>
                            <th>Area</th>
                            <th>Strade</th>
                            <th>Importo</th>
                            <th>Finanziamento</th>
                            <th>Data fine lavori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($practices as $practice)
                            <tr>

                                <td>
                                    <a href="{{ route('openweb.show', $practice) }}"
                                        class="link">{{ $practice->codice
                                                                                                                                                                                                                                                                                                                        }}</a>
                                </td>
                                <td>{{ $practice->titolo }}</td>
                                <td>
                                    @if($practice->is_cre)
                                        <span class="tag bg-violet-100 whitespace-nowrap">Lavori conclusi</span>
                                    @else
                                        @if($practice->is_lavori_in_corso)
                                            <span class="tag bg-blue-100 whitespace-nowrap">Lavori in corso</span>
                                        @else
                                            @if($practice->is_avvio_gara)
                                                <span class="tag bg-green-100 whitespace-nowrap">Gara d'Appalto</span>
                                            @else
                                                @if ($practice->is_avvio_progettazione)
                                                    <span class="tag bg-yellow-100 whitespace-nowrap">Progettazione</span>
                                                @endif
                                            @endif
                                        @endif
                                    @endif

                                </td>
                                <td>{{ $practice->zona }}</td>
                                <td class="whitespace-nowrap">
                                    @if($practice->strade)
                                        @foreach (explode(",", $practice->strade) as $sp)
                                            <span class='tag bg-gray-200 '>{{ $sp }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                @php

                                    $importo = (float) str_replace(",", ".", str_replace(".", "", $practice->importo));
                                @endphp
                                {{-- <td class="">{{
                                    number_format((float)str_replace(str_replace($practice->importo,".",""),",",".") , 2,
                                    "," ,
                                    ".")}} €</td> --}}
                                <td class="text-right pr-2">{{ number_format($importo, 2, ",", ".") }} €</td>

                                <td>{{ $practice->finanziamento }}</td>
                                <td class="whitespace-nowrap">
                                    @if(isset($practice->cre_at))
                                        {{ $practice->cre_at }}
                                    @else
                                        @if (isset($practice->scadenza_esecuzione))
                                            {{ $practice->scadenza_esecuzione }} <span class="text-xs italic">PRESUNTA</span>
                                        @else
                                            <span class="text-xs italic">IN DEFINIZIONE</span>
                                        @endif
                                    @endif

                                </td>
                            </tr>


                            <?php 
                                                                                                                                                                                                                                                                                                            $importo_totale += $importo;
                                                                                                                                                                                                                                                                                                            ?>

                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <div class="bg-gray-100 h-8 py-1 px-2">
                Numero di interventi: <span class="font-bold">{{ $practices->count() }}</span> |
                Importo
                totale: <span class="font-bold">€ {{ number_format($importo_totale, 2, ",", ".") }}</span>
            </div>
        </div>
        <div class="col-span-3 p-4">

            <div id="map"></div>

        </div>
    </div>





    <script>
        // 4. IL TUO CODICE JAVASCRIPT
        // Inizializza la mappa su Milano
        var map = L.map('map').setView([45.852455, 9.395464], 10);

        // Aggiungi il layer di OpenStreetMap (le "mattonelle" della mappa)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // const m = document.getElementById("map");
        // window.onload = function () {
        //     m.className = "!w-full";
        //     // m.style = "width:100%";
        // };

        // recupero le coordinate

        @if (isset($practice))


            // practices = array di oggetti relativi a ogni singola pratica 
            @js($practices).forEach(practice => {

                if (practice.coordinate != null) {
                    practice.coordinate.split("|").forEach(coordinata => {
                        L.marker(coordinata.split(",")).addTo(map)
                            .bindPopup('<b>' + practice.codice + '</b> - ' + practice.titolo_esteso);
                    });

                }

            });
        @endif


        // RETE STRADE PROVINCIALI
        const geojsonUrl = '/assets/gis/strade_provinciali.geojson';

        fetch(geojsonUrl)
            .then(response => {
                // Verifica se la risposta è corretta (status 200)
                if (!response.ok) {
                    throw new Error('Errore nel caricamento del file: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                // Aggiungi i dati GeoJSON alla mappa
                L.geoJSON(data, {
                    // Opzionale: aggiungi stile o popup
                    onEachFeature: function (feature, layer) {
                        //console.log(feature);
                        if (feature.properties && feature.properties.Sigla) {
                            layer.bindPopup(feature.properties.Sigla);
                            //console.log("nome: "+feature.properties.Sigla);
                        }
                    },
                    style: function (feature) {
                        // Esempio: stile personalizzato per le linee/poligoni
                        return { color: "#ff2200", weight: 2, opacity: 1.00 };
                    }
                }).addTo(map);

                console.log("Dati caricati con successo!");
            })
            .catch(error => {
                console.error("Si è verificato un problema con l'operazione fetch:", error);
            });
    </script>

</body>

</html>