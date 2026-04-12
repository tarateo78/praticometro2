<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progetti e Lavori</title>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #map {
            height: 800px;
            width: 500px;
            border: 2px solid #ccc;
        }

        /* Impedisce a Tailwind di forzare l'altezza massima delle immagini della mappa */
        #map img {
            max-width: none !important;
            max-height: none !important;
        }
    </style>
</head>

<body>
    <h1>Progetti e Lavori</h1>

    <table>
        @foreach($practices as $practice)
        <tr>

            <td>{{ $practice->codice }}</td>
            <td><a href="{{ route('practices.edit', $practice) }}">🔎</a></td>
            <td>{{ $practice->titolo }}</td>
            <td>{{ $practice->zona }}</td>
            <td>{{ $practice->importo }}</td>
            <td>{{ $practice->finanziamento }}</td>
            <td></td>
        </tr>
        @endforeach
    </table>





    <div id="map"></div>

    <script>
        // 4. IL TUO CODICE JAVASCRIPT
        // Inizializza la mappa su Milano
        var map = L.map('map').setView([45.852455, 9.395464], 10);

        // Aggiungi il layer di OpenStreetMap (le "mattonelle" della mappa)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);


        // recupero le coordinate

        // practices = array di oggetti relativi a ogni singola pratica 
        @js($practices).forEach( practice => {

            if(practice.coordinate != null) {
                practice.coordinate.split("|").forEach(coordinata=>{
                     L.marker(coordinata.split(",")).addTo(map)
                    .bindPopup('<b>' + practice.codice + '</b> - ' + practice.titolo_esteso );
                });                
                
            }

        });

        /*
        @js($practice->coordinate).split("|").forEach(coordinata => {
            // Aggiungi il marker
            L.marker(coordinata.split(",")).addTo(map)
                .bindPopup('{{ $practice->titolo_esteso }}');
                //.openPopup();
        });
            */
            
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
                    style: function(feature) {
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