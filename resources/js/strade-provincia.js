
// Carica sulla mappa la rete viaria provinciale

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

    console.log("Rete stradale caricata con successo!");
})
.catch(error => {
    console.error("Si è verificato un problema con l'operazione fetch della rete stradale:", error);
});