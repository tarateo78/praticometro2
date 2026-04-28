<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opere Stradali</title>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            /* height: 500px; */
            /* width: 100%; */
            /* border: 2px solid #000000; */

        }



        /* Impedisce a Tailwind di forzare l'altezza massima delle immagini della mappa */
        #map img {
            max-width: none !important;
            max-height: none !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/css/frontend.css', 'resources/js/app.js'])
</head>

<body>
    <h1>Opere stradali</h1>

    <?php $importo_totale = 0; ?>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-0 md:gap-2">
        <div class="col-span-9 p-4 pr-0">
            <div class="h-120 md:h-160 overflow-auto bg-gray-300">
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th>Codice</th>
                            <th>Titolo Intervento</th>
                            <th>Stato Pratica</th>
                            <th>Area</th>
                            <th>Strade</th>
                            <th>Mappa</th>
                            <th>Importo</th>
                            <th>Finanziamento</th>
                            <th>Data fine lavori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($practices as $prac)
                            <tr id="prat-{{ $prac->id }}">

                                <td>
                                    <a href="{{ route('openweb.show', $prac) }}" class="link">{{ $prac->codice }}</a>
                                </td>
                                <td class="min-w-70">{{ $prac->titolo_esteso }}</td>
                                <td>
                                    @if($prac->is_cre)
                                        <span class="tag bg-violet-200 whitespace-nowrap">Concluso</span>
                                    @else
                                        @if($prac->is_lavori_in_corso)
                                            <span class="tag bg-blue-200 whitespace-nowrap">Lavori in corso</span>
                                        @else
                                            @if($prac->is_avvio_gara)
                                                <span class="tag bg-green-200 whitespace-nowrap">Gara d'Appalto</span>
                                            @else
                                                @if ($prac->is_avvio_progettazione)
                                                    <span class="tag bg-yellow-200 whitespace-nowrap">Progettazione</span>
                                                @endif
                                            @endif
                                        @endif
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
                                <td>
                                    @if($prac->coordinate != "")
                                        <img src="assets/images/marker/marker-red.svg" alt="tag">
                                    @endif
                                </td>
                                @php
                                    $importo = (float) str_replace(",", ".", str_replace(".", "", $prac->importo));
                                @endphp
                                {{-- <td class="">{{
                                    number_format((float)str_replace(str_replace($prac->importo,".",""),",",".") , 2,
                                    "," ,
                                    ".")}} €</td> --}}
                                <td class="text-right pr-2 whitespace-nowrap">{{ number_format($importo, 2, ",", ".") }} €
                                </td>

                                <td>{{ $prac->finanziamento }}</td>
                                <td class="whitespace-nowrap">
                                    @if(isset($prac->cre_at))
                                        {{ $prac->cre_at }}
                                    @else
                                        @if (isset($prac->scadenza_esecuzione))
                                            {{ $prac->scadenza_esecuzione }} <span class="text-xs italic">PRESUNTA</span>
                                        @else
                                            <span class="text-xs italic">IN DEFINIZIONE</span>
                                        @endif
                                    @endif

                                </td>
                            </tr>

                            <?php    $importo_totale += $importo; ?>

                        @endforeach

                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 bg-gray-100 py-1 px-2">
                <div class=" filtra flex">
                    <div class="form">
                        <form action="{{ route('openweb.index') }}" method="GET">
                            @csrf

                            <label for="filtra">Filtro</label>
                            <input type="text" name="filtra" id="filtra" class="w-40" />
                            <button type="submit">Applica</button>
                        </form>
                    </div>
                </div>
                <div class="">
                    <span>
                        @if(isset($_GET['filtra']) && $_GET['filtra'] != "")
                                            <div class="bg-green-300 rounded-lg ml-3 px-2 py-1 w-fit">{{
                            $_GET['filtra'] }}<a href="{{ route('openweb.index') }}"><span
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
    <div class="flex justify-end">
        <a href="{{ route('practices.index') }}?is_in_corso=on"
            class="m-2 p-2 border border-blue-600 rounded-2xl whitespace-nowrap">Vai a
            Area riservata</a>
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

        const pathDettaglio = "show";
        const pathOperazione = "";

        // Segue: marker-lavori.js e strade-provincia.js




    </script>

    @vite(['resources/js/strade-provincia.js', 'resources/js/marker-lavori.js'])


</body>

</html>