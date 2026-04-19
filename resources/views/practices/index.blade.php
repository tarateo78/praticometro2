<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavori Viabilità</title>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        /* Impedisce a Tailwind di forzare l'altezza massima delle immagini della mappa */
        #map img {
            max-width: none !important;
            max-height: none !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/css/backend.css', 'resources/js/app.js'])
</head>

<body>
    <h1>Lavori Viabilità</h1>
    <?php $importo_totale = 0; ?>

    <?php $importo_totale = 0; ?>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-0 md:gap-2">
        <div class="col-span-9 p-4 pr-0">
            <div class="h-120 md:h-160 overflow-auto bg-gray-300">
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th>Codice</th>
                            <th>Titolo</th>
                            <th>Stato</th>
                            <th>Area</th>
                            <th>Strade</th>
                            <th>Cup</th>
                            <th>Importo</th>
                            <th>Finanziamento</th>
                            <th>rup</th>
                            <th>fascicolo</th>
                            <th>is_rl</th>
                            <th>is_mims</th>
                            <th>progettista</th>
                            <th>sicurezza</th>
                            <th>cds_chiusa_at</th>
                            <th>direttore_lavori</th>
                            <th>impresa</th>
                            <th>determina_gruppo</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($practices as $prac)
                            <tr id="prat-{{ $prac->id }}">

                                <td>
                                    <a href="{{ route('practices.edit', $prac) }}" class="link">{{ $prac->codice }}</a>
                                </td>
                                <td>{{ $prac->titolo }}</td>
                                <td>
                                    @if ($prac->is_avvio_progettazione)
                                        <span class="tag bg-yellow-200/60">Prog</span>
                                    @endif

                                    @if($prac->is_avvio_gara)
                                        <span class="tag bg-green-200/60">Gara</span>
                                    @endif

                                    @if($prac->is_lavori_in_corso)
                                        <span class="tag bg-blue-200/60">Lavori</span>
                                    @endif

                                    @if($prac->is_cre)
                                        <span class="tag bg-violet-200/60">Cre</span>
                                    @endif
                                </td>
                                <td>{{ $prac->zona }}</td>
                                <td class="whitespace-nowrap">
                                    @if($prac->strade)
                                        @foreach (explode(",", $prac->strade) as $sp)
                                            <span class='tag bg-gray-200 '>{{ $sp }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $prac->cup }}</td>

                                <?php    $importo = (float) str_replace(",", ".", str_replace(".", "", $prac->importo)) ?>
                                {{-- <td class="">{{
                                    number_format((float)str_replace(str_replace($prac->importo,".",""),",",".") ,
                                    2, "," , ".")}} €</td> --}}
                                <td class="text-right pr-2">{{ number_format($importo, 2, ",", ".") }} €</td>

                                <td>{{ $prac->finanziamento }}</td>
                                <td>{{ $prac->rup }}</td>
                                <td>{{ $prac->fascicolo }}</td>
                                <td>{{ $prac->is_rl }}</td>
                                <td>{{ $prac->is_mims }}</td>
                                <td>{{ $prac->progettista }}</td>
                                <td>{{ $prac->sicurezza }}</td>
                                <td>{{ $prac->cds_chiusa_at }}</td>
                                <td>{{ $prac->direttore_lavori }}</td>
                                <td>{{ $prac->impresa }}</td>
                                <td>{{ $prac->determina_gruppo }}</td>
                            </tr>

                            <?php 
                                                                                                                                                            $importo_totale += $importo;
                                                                                                                                                            ?>

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right">Importo Totale:</td>
                            <td class="text-right pr-2">{{ number_format($importo_totale, 2, ",", ".") }} €</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 bg-gray-100 py-1 px-2">
                <div class=" filtra flex">
                    <div class="form">
                        <form action="{{ route('practices.index') }}" method="GET">
                            @csrf
                            <label for="is_in_corso">In corso</label><input type="checkbox" name="is_in_corso"
                                id="is_in_corso" {{ isset($_GET['is_in_corso']) ? "checked" : "" }}>
                            <input type="text" name="filtra" id="filtra" class="w-40" />
                            <button type="submit">Applica</button>
                        </form>
                    </div>
                </div>
                <div class="">
                    <span>
                        @if(isset($_GET['filtra']) && $_GET['filtra'] != "")
                                            <div class="bg-green-300 rounded-lg ml-3 px-2 py-1 w-fit">{{
                            $_GET['filtra'] }}<a
                                                    href="{{ route('practices.index') }}{{ isset($_GET['is_in_corso']) ? "?is_in_corso=on" : "" }}"><span
                                                        class="text-sm bg-white px-1 rounded-lg ml-2">x</span></a></div>
                        @endif
                    </span>
                </div>
                <div class="text-center">
                    Numero di interventi: <span class="font-bold">{{ $practices->count() }}</span>
                </div>
                <div class="text-center md:text-right">
                    Importo totale: <span class="font-bold">€ {{ number_format($importo_totale, 2, ",", ".") }}</span>
                </div>
            </div>
        </div>
        <div class="col-span-3 p-4">

            <div id="map" class="map"></div>

        </div>
    </div>


    <script>

        // Inizializza la mappa centrata sulle coordinate fornite con fattore zoom
        var map = L.map('map').setView([45.895237, 9.341697], 10);
        // lecco 45.852455, 9.395464
        // abbadia 45.895237,9.341697
        // ballabio 45.896247,9.425201

        // Aggiunge il layer di OpenStreetMap (le "mattonelle" della mappa)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);


        // Assegna l'arrey degli oggetti pratiche filtrate
        const practices = @js($practices);

        // la variabile practice è istanziata nella pagina di dettaglio (show)
        let practice = null;
        const paginaDettaglio = false;


        // Segue: marker-lavori.js e strade-provincia.js




    </script>

    @vite(['resources/js/strade-provincia.js', 'resources/js/marker-lavori.js'])


</body>

</html>