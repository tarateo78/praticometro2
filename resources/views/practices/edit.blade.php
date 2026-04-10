<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
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
    <a href="{{ route('practices.index') }}">← Torna alla lista</a>

    <h1>EDIT</h1>
    <h2>{{ $practice->codice }}</h2>

    {{-- <small>Creato il: {{ $practice->created_at->format('d/m/Y') }}</small> --}}

    <form action="{{ route('practices.update', $practice->id) }}" method="POST">
        {{-- $task->exists ? route('tasks.update', $task) : route('tasks.store') --}}
        @csrf

        {{-- Se stiamo modificando, Laravel ha bisogno del metodo PUT --}}
        @if($practice->exists)
        @method('PUT')
        @endif

        {{-- Usiamo l'helper old() per mantenere i dati in caso di errore di validazione --}}
        <label for="codice">codice</label>
        <input name="codice" value="{{ old('codice', $practice->codice) }}" /><br>

        <label for="is_in_corso">is_in_corso</label>
        <input type="checkbox" name="is_in_corso" {{ $practice->is_in_corso ? "checked" : ""}} /><br>

        <label for="titolo">titolo</label>
        <input name="titolo" value="{{ old('titolo', $practice->titolo) }}" /><br>

        <label for="titolo_esteso">titolo_esteso</label>
        <input name="titolo_esteso" value="{{ old('titolo_esteso', $practice->titolo_esteso) }}" /><br>
        <label for="zona">zona</label><input name="zona" value="{{ old('zona', $practice->zona) }}" /><br>
        <label for="cup">cup</label><input name="cup" value="{{ old('cup', $practice->cup) }}" /><br>
        <label for="finanziamento">finanziamento</label><input name="finanziamento"
            value="{{ old('finanziamento', $practice->finanziamento) }}" /><br>
        <label for="finanziamento_note">finanziamento_note</label><input name="finanziamento_note"
            value="{{ old('finanziamento_note', $practice->finanziamento_note) }}" /><br>
        <label for="rup">rup</label><input name="rup" value="{{ old('rup', $practice->rup) }}" /><br>
        <label for="fascicolo">fascicolo</label><input name="fascicolo"
            value="{{ old('fascicolo', $practice->fascicolo) }}" /><br>
        <label for="importo">importo</label><input name="importo"
            value="{{ old('importo', $practice->importo) }}" /><br>
        <label for="is_rl">is_rl</label><input type="checkbox" name="is_rl" {{ old('is_rl', $practice->is_rl) ?
        "checked" : "" }}
        /><br>
        <label for="is_mims">is_mims</label><input type="checkbox" name="is_mims" {{ old('is_mims', $practice->is_mims)
        ? "checked" : ""
        }}
        /><br>
        <label for="rl_codice">rl_codice</label><input name="rl_codice"
            value="{{ old('rl_codice', $practice->rl_codice) }}" /><br>
        <label for="mims_codice">mims_codice</label><input name="mims_codice"
            value="{{ old('mims_codice', $practice->mims_codice) }}" /><br>
        <label for="avvio_servizio_at">avvio_servizio_at</label><input name="avvio_servizio_at"
            value="{{ old('avvio_servizio_at', $practice->avvio_servizio_at) }}" /><br>
        <label for="is_avvio_progettazione">is_avvio_progettazione</label><input type="checkbox"
            name="is_avvio_progettazione" {{ old('is_avvio_progettazione', $practice->is_avvio_progettazione) ?
        "checked" : "" }} /><br>
        <label for="progettista">progettista</label><input name="progettista"
            value="{{ old('progettista', $practice->progettista) }}" /><br>
        <label for="sicurezza">sicurezza</label><input name="sicurezza"
            value="{{ old('sicurezza', $practice->sicurezza) }}" /><br>
        <label for="file_count">file_count</label><input name="file_count"
            value="{{ old('file_count', $practice->file_count) }}" /><br>
        <label for="file_effettivi_count">file_effettivi_count</label><input name="file_effettivi_count"
            value="{{ old('file_effettivi_count', $practice->file_effettivi_count) }}" /><br>
        <label for="fte_at">fte_at</label><input name="fte_at" value="{{ old('fte_at', $practice->fte_at) }}" /><br>
        <label for="def_at">def_at</label><input name="def_at" value="{{ old('def_at', $practice->def_at) }}" /><br>
        <label for="ese_at">ese_at</label><input name="ese_at" value="{{ old('ese_at', $practice->ese_at) }}" /><br>
        <label for="cds_at">cds_at</label><input name="cds_at" value="{{ old('cds_at', $practice->cds_at) }}" /><br>
        <label for="cds_chiusa_at">cds_chiusa_at</label><input name="cds_chiusa_at"
            value="{{ old('cds_chiusa_at', $practice->cds_chiusa_at) }}" /><br>
        <label for="is_avvio_gara">is_avvio_gara</label><input type="checkbox" name="is_avvio_gara" {{
            old('is_avvio_gara', $practice->is_avvio_gara) ? "checked" : "" }} /><br>
        <label for="contratto_at">contratto_at</label><input name="contratto_at"
            value="{{ old('contratto_at', $practice->contratto_at) }}" /><br>
        <label for="is_lavori_in_corso">is_lavori_in_corso</label><input type="checkbox" name="ish_lavori_in_corso" {{
            old('is_lavori_in_corso', $practice->is_lavori_in_corso) ? "checked" : "" }} /><br>
        <label for="direttore_lavori">direttore_lavori</label><input name="direttore_lavori"
            value="{{ old('direttore_lavori', $practice->direttore_lavori) }}" /><br>
        <label for="assistente_dl">assistente_dl</label><input name="assistente_dl"
            value="{{ old('assistente_dl', $practice->assistente_dl) }}" /><br>
        <label for="consegna_lavori_at">consegna_lavori_at</label><input name="consegna_lavori_at"
            value="{{ old('consegna_lavori_at', $practice->consegna_lavori_at) }}" /><br>
        <label for="impresa">impresa</label><input name="impresa"
            value="{{ old('impresa', $practice->impresa) }}" /><br>
        <label for="lavori_note">lavori_note</label><input name="lavori_note"
            value="{{ old('lavori_note', $practice->lavori_note) }}" /><br>
        <label for="is_cre">is_cre</label><input type="checkbox" name="is_cre" {{ old('is_cre', $practice->is_cre) ?
        "checked" : "" }}
        /><br>
        <label for="cre_at">cre_at</label><input name="cre_at" value="{{ old('cre_at', $practice->cre_at) }}" /><br>
        <label for="appunti_progettazione">appunti_progettazione</label><input name="appunti_progettazione"
            value="{{ old('appunti_progettazione', $practice->appunti_progettazione) }}" /><br>
        <label for="rup_note">rup_note</label><input name="rup_note"
            value="{{ old('rup_note', $practice->rup_note) }}" /><br>
        <label for="capitolo">capitolo</label><input name="capitolo"
            value="{{ old('capitolo', $practice->capitolo) }}" /><br>
        <label for="urgente">urgente</label><input name="urgente"
            value="{{ old('urgente', $practice->urgente) }}" /><br>
        <label for="urgente_nota">urgente_nota</label><input name="urgente_nota"
            value="{{ old('urgente_nota', $practice->urgente_nota) }}" /><br>
        <label for="prossima_scadenza_nota">prossima_scadenza_nota</label><input name="prossima_scadenza_nota"
            value="{{ old('prossima_scadenza_nota', $practice->prossima_scadenza_nota) }}" /><br>
        <label for="prossima_scadenza_at">prossima_scadenza_at</label><input name="prossima_scadenza_at"
            value="{{ old('prossima_scadenza_at', $practice->prossima_scadenza_at) }}" /><br>
        <label for="bdap">bdap</label><input name="bdap" value="{{ old('bdap', $practice->bdap) }}" /><br>
        <label for="bdap_convalidato">bdap_convalidato</label><input name="bdap_convalidato"
            value="{{ old('bdap_convalidato', $practice->bdap_convalidato) }}" /><br>
        <label for="bdap_note">bdap_note</label><input name="bdap_note"
            value="{{ old('bdap_note', $practice->bdap_note) }}" /><br>
        <label for="sito_internet">sito_internet</label><input name="sito_internet"
            value="{{ old('sito_internet', $practice->sito_internet) }}" /><br>
        <label for="sito_internet_nota">sito_internet_nota</label><input name="sito_internet_nota"
            value="{{ old('sito_internet_nota', $practice->sito_internet_nota) }}" /><br>
        <label for="rif_llpp">rif_llpp</label><input name="rif_llpp"
            value="{{ old('rif_llpp', $practice->rif_llpp) }}" /><br>
        <label for="determina_gruppo">determina_gruppo</label><input name="determina_gruppo"
            value="{{ old('determina_gruppo', $practice->determina_gruppo) }}" /><br>
        <label for="check_at">check_at</label><input name="check_at"
            value="{{ old('check_at', $practice->check_at) }}" /><br>
        <label for="modifica_at">modifica_at</label><input name="modifica_at"
            value="{{ old('modifica_at', $practice->modifica_at) }}" /><br>
        <label for="modifica_utente">modifica_utente</label><input name="modifica_utente"
            value="{{ old('modifica_utente', $practice->modifica_utente) }}" /><br>
        <label for="alias">alias</label><input name="alias" value="{{ old('alias', $practice->alias) }}" /><br>
        <label for="scadenza_progetto">scadenza_progetto</label><input name="scadenza_progetto"
            value="{{ old('scadenza_progetto', $practice->scadenza_progetto) }}" /><br>
        <label for="scadenza_affidamento">scadenza_affidamento</label><input name="scadenza_affidamento"
            value="{{ old('scadenza_affidamento', $practice->scadenza_affidamento) }}" /><br>
        <label for="scadenza_esecutivo">scadenza_esecutivo</label><input name="scadenza_esecutivo"
            value="{{ old('scadenza_esecutivo', $practice->scadenza_esecutivo) }}" /><br>
        <label for="gruppo">gruppo</label><input name="gruppo" value="{{ old('gruppo', $practice->gruppo) }}" /><br>
        <label for="coordinate">coordinate</label><input name="coordinate"
            value="{{ old('coordinate', $practice->coordinate) }}" /><br>

        <button type="submit">Salva aggiornamenti</button>
    </form>

    <div id="map"></div>



    <script>
        // 4. IL TUO CODICE JAVASCRIPT
        // Inizializza la mappa su Milano
        var map = L.map('map').setView([45.852455, 9.395464], 10);

        // Aggiungi il layer di OpenStreetMap (le "mattonelle" della mappa)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Esempio: Aggiungi un marker fisso (per test)
        L.marker([{{ $practice->coordinate }}]).addTo(map)
            .bindPopup('Lecco');
         //   .openPopup();
            
//        L.rectangle([[46.143770, 9.200980], [45.657239, 9.452421]]).addTo(map)
//        .bindPopup('Ecco');
            
        // Esempio manuale: una linea che collega due punti a Milano
        var latlngs = [
            [45.921772, 9.442667], // Duomo
            [45.921719, 9.443777],
            [45.922305, 9.443968]// Stazione Centrale
        ];

        var polyline = L.polyline(latlngs, {
            color: 'red',      // Colore della linea
            weight: 5,         // Spessore in pixel
            opacity: 0.7,      // Trasparenza
            smoothFactor: 1    // Semplificazione della linea per performance
        }).addTo(map);
        
        // Adatta la vista della mappa per contenere tutta la linea
       // map.fitBounds(polyline.getBounds());

// Percorso del file (può essere un file locale o un URL di un'API PHP)
//const geojsonUrl = 'strade_provinciali.geojson';
//const geojsonUrl = 'mappa.geojson';
//const geojsonUrl = 'primaluna.geojson';
const geojsonUrl = 'strade_convertito.geojson';

// STRADE PROVINCIALI
/*
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
            	console.log(feature);
                if (feature.properties && feature.properties.Sigla) {
                    layer.bindPopup(feature.properties.Sigla);
                    console.log("nome: "+feature.properties.Sigla);
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
    */

    </script>
</body>

</html>