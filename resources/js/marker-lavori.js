
// Se la chiamata arriva da una pagina di dettaglio si avrà una sola "practice"
// per garantire il funzionamento dello script trasformo la singola pratica
// in un array con la sola pratica


// ************** Verificare se funziona********
if(practices === null && practice !== null){
    practices = [ practice ];
}

const obj_marker = {};

if ( typeof practices !== 'undefined' ) {

    // Definizione dei Marker per la mappa
    var greenIcon = new L.Icon({
        iconUrl: '/assets/images/marker/marker-green.svg',
        shadowUrl: '/assets/images/marker/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    var redIcon = new L.Icon({
        iconUrl: '/assets/images/marker/marker-red.svg',
        shadowUrl: '/assets/images/marker/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    var yellowIcon = new L.Icon({
        iconUrl: '/assets/images/marker/marker-yellow.svg',
        shadowUrl: '/assets/images/marker/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    var blueIcon = new L.Icon({
        iconUrl: '/assets/images/marker/marker-blue.svg',
        shadowUrl: '/assets/images/marker/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    var purpleIcon = new L.Icon({
        iconUrl: '/assets/images/marker/marker-purple.svg',
        shadowUrl: '/assets/images/marker/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });



    let practice
    let context_icon = "";

    practices.forEach((practice) => {

        if (practice.coordinate != null) {

            // Determina il Marker in base allo stato della pratica 
            if (practice.is_cre) {
                context_icon = purpleIcon;
            } else {
                if (practice.is_lavori_in_corso) {
                    context_icon = blueIcon;
                } else {
                    if (practice.is_avvio_gara) {
                        context_icon = greenIcon;
                    } else {
                        context_icon = yellowIcon;
                    }
                }
            }

            
            // Rileva coordinate multiple
            let i = 1;
            const nCoord = practice.coordinate.split("|").length;

            practice.coordinate.split("|").forEach(coordinata => {

                // Formato di idMarker: 523-2-3 -> id, contatore, n. totale
                // mi serve per sapre quanti marker devo conteggiare
                let idMarker = practice.id + "-" + i + "-" + nCoord;

                // Aggiunge il Marker alla mappa
                let m = L.marker(coordinata.split(","), { id: idMarker, icon: context_icon }).addTo(map)
                    .bindPopup('<b>' + practice.codice + '</b> - ' + practice.titolo_esteso + '<br><a href="/'+ pathDettaglio +'/' + practice.id + pathOperazione +'">Vedi dettaglio</a>');
                obj_marker[idMarker]=m
                i++;
            });
            
        }
    });

}

// Evidenzia i marker solo se è nella pagina con tabella
if(!paginaDettaglio)
{
    
    Object.keys(obj_marker).forEach(function(markerId) {
    
        // console.log(markerId);
        let id = markerId.split("-")[0];
        let nMarker = markerId.split("-")[2];

        const riga = document.getElementById("prat-" + id);
        
        let markerTemp = [];
        
        // mouseover scatta anche passando da un <td> all'altro nella stessa <tr>
        riga.onmouseenter = (e) => {
            // console.log("OVER");
            for (let i = 1; i <= nMarker; i++) {
                let marker = obj_marker[id + "-" + i + "-" + nMarker]; // Recupero il marker tramite l'ID
        // console.log(marker);
                markerTemp[i] = L.marker([marker.getLatLng().lat,marker.getLatLng().lng], { icon: redIcon }).addTo(map)
            }
        }
        
        riga.onmouseleave = (e) => {
            for (let i = 1; i <= nMarker; i++) {
                markerTemp[i].remove();
            }
        }
        
    });

}