<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praticometro - Pratica {{ $practice->codice }}</title>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @vite(['resources/css/app.css', 'resources/css/backend.css', 'resources/js/app.js'])
    <style>
        #map {
            height: 300px;
            width: 300px;
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
    {{-- <h1>PRATICA <b>{{ $practice->codice }}</b></h1> --}}

    <a href="{{ route('practices.index') }}?is_in_corso=on">← Elenco Pratiche</a>

    {{-- <small>Creato il: {{ $practice->created_at->format('d/m/Y') }}</small> --}}

    <body>


        <form action="{{ route('practices.update', $practice->id) }}" method="POST" class="form">
            {{-- $task->exists ? route('tasks.update', $task) : route('tasks.store') --}}

            @csrf

            {{-- Se stiamo modificando, Laravel ha bisogno del metodo PUT --}}
            @if($practice->exists)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-4 gap-2 p-2">
                <div class=" p-2 rounded-xs md:col-span-2">
                    <div class="grid grd-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            {{-- Usiamo l'helper old() per mantenere i dati in caso di errore di validazione --}}
                            <label for="codice">Pratica</label>
                            <input name="codice" id="codice" value="{{ old('codice', $practice->codice) }}"
                                class="text-3xl w-30" />
                        </div>
                        <div>
                            <label for="is_in_corso">In corso</label>
                            <input type="checkbox" value="1" name="is_in_corso" id="is_in_corso" {{ old(
    'is_in_corso',
    $practice->is_in_corso
) ?
    "checked" :
    "" }} />
                            <br>

                            <label for="cup">cup</label>
                            <input name="cup" id="cup" value="{{ old('cup', $practice->cup) }}" class="w-50" />
                        </div>
                    </div>
                    <label for="titolo">Titolo</label>
                    <input name="titolo" id="titolo" value="{{ old('titolo', $practice->titolo) }}" class="w-full" />
                    <br>
                    <label for="titolo_esteso">Titolo esteso</label>
                    <textarea name="titolo_esteso" id="titolo_esteso"
                        class="w-full h-20">{{ old('titolo_esteso', $practice->titolo_esteso) }}</textarea>


                </div>

                <div class="p-2 rounded-xs">

                    <label for="fascicolo">fascicolo</label>
                    <input name="fascicolo" id="fascicolo" value="{{ old('fascicolo', $practice->fascicolo) }}"
                        class="w-40" />
                    <br>


                    <label for="rup">rup</label>
                    <input name="rup" id="rup" value="{{ old('rup', $practice->rup) }}" />
                    <br>

                    <label for="rup_note">rup_note</label>
                    <input name="rup_note" id="rup_note" value="{{ old('rup_note', $practice->rup_note) }}"
                        class="w-full" />
                    <br>

                    <label for="determina_gruppo">determina_gruppo</label>
                    <input name="determina_gruppo" id="determina_gruppo"
                        value="{{ old('determina_gruppo', $practice->determina_gruppo) }}" class="w-30" />
                    <br>
                    <label for="gruppo">gruppo</label>
                    <input name="gruppo" id="gruppo" value="{{ old('gruppo', $practice->gruppo) }}" class="w-30" />
                    <br>

                    <label for="importo">importo</label>
                    <input name="importo" id="importo" value="{{ old('importo', $practice->importo) }}" class="w-40" />

                </div>

                <div class="p-2 rounded-xs">

                    <label for="finanziamento">finanziamento</label>
                    <input name="finanziamento" id="finanziamento"
                        value="{{ old('finanziamento', $practice->finanziamento) }}" />
                    <br>

                    <label for="finanziamento_note">finanziamento_note</label>
                    <input name="finanziamento_note" id="finanziamento_note"
                        value="{{ old('finanziamento_note', $practice->finanziamento_note) }}" />
                    <br>

                    <label for="capitolo">capitolo</label>
                    <input name="capitolo" id="capitolo" value="{{ old('capitolo', $practice->capitolo) }}" />
                    <br>

                    <label for="is_rl">is_rl</label>
                    <input type="checkbox" value="1" name="is_rl" id="is_rl" {{ old('is_rl', $practice->is_rl) ?
    "checked" : "" }} />
                    <br>

                    <label for="is_mims">is_mims</label>
                    <input type="checkbox" value="1" name="is_mims" id="is_mims" {{ old('is_mims', $practice->is_mims) ? "checked" :
    "" }} />
                    <br>

                    <label for="rl_codice">rl_codice</label>
                    <input name="rl_codice" id="rl_codice" value="{{ old('rl_codice', $practice->rl_codice) }}" />
                    <br>

                    <label for="mims_codice">mims_codice</label>
                    <input name="mims_codice" id="mims_codice"
                        value="{{ old('mims_codice', $practice->mims_codice) }}" />
                </div>
            </div>

            <br>

            <div class="p-2">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="grid-rows-2">

                        <div class="border border-l-8 border-yellow-400 rounded-xs">
                            <div class="titolo-colonna bg-yellow-400 text-white">1. Progettazione</div>


                            <label for="is_avvio_progettazione">is_avvio_progettazione</label>
                            <input type="checkbox" value="1" name="is_avvio_progettazione" id="is_avvio_progettazione"
                                {{ old(
    'is_avvio_progettazione',
    $practice->is_avvio_progettazione
) ? "checked" : "" }} />
                            <br>
                            <label for="avvio_servizio_at">avvio_servizio_at</label>
                            <input type="date" name="avvio_servizio_at" id="avvio_servizio_at"
                                value="{{ old('avvio_servizio_at', $practice->avvio_servizio_at) }}" />
                            <br>
                            <label for="progettista">progettista</label>
                            <input name="progettista" id="progettista"
                                value="{{ old('progettista', $practice->progettista) }}" />
                            <br>
                            <label for="fte_at">fte_at</label>
                            <input type="date" name="fte_at" id="fte_at"
                                value="{{ old('fte_at', $practice->fte_at) }}" />
                            <br>
                            <label for="def_at">def_at</label>
                            <input type="date" name="def_at" id="def_at"
                                value="{{ old('def_at', $practice->def_at) }}" />
                            <br>
                            <label for="cds_at">cds_at</label>
                            <input type="date" name="cds_at" id="cds_at"
                                value="{{ old('cds_at', $practice->cds_at) }}" />
                            <br>
                            <label for="cds_chiusa_at">cds_chiusa_at</label>
                            <input type="date" name="cds_chiusa_at" id="cds_chiusa_at"
                                value="{{ old('cds_chiusa_at', $practice->cds_chiusa_at) }}" />
                            <br>
                            <label for="ese_at">ese_at</label>
                            <input type="date" name="ese_at" id="ese_at"
                                value="{{ old('ese_at', $practice->ese_at) }}" />
                            <br>
                            <label for="scadenza_progetto">scadenza_progetto</label>
                            <input type="date" name="scadenza_progetto" id="scadenza_progetto"
                                value="{{ old('scadenza_progetto', $practice->scadenza_progetto) }}" />
                        </div>
                        <br>
                        <div class="border border-l-8 border-green-500 rounded-xs">
                            <div class="titolo-colonna bg-green-500 text-white">2. Gara appalto</div>

                            <label for="is_avvio_gara">is_avvio_gara</label>
                            <input type="checkbox" value="1" name="is_avvio_gara" id="is_avvio_gara" {{ old(
    'is_avvio_gara',
    $practice->is_avvio_gara
) ?
    "checked" : ""
                            }} />
                            <br>
                            <label for="contratto_at">contratto_at</label>
                            <input type="date" name="contratto_at" id="contratto_at"
                                value="{{ old('contratto_at', $practice->contratto_at) }}" />
                            <br>
                            <label for="scadenza_affidamento">scadenza_affidamento</label>
                            <input type="date" name="scadenza_affidamento" id="scadenza_affidamento"
                                value="{{ old('scadenza_affidamento', $practice->scadenza_affidamento) }}" />
                        </div>

                    </div>


                    <div class="grid-rows-2">
                        <div class="border border-l-8 border-blue-600 rounded-xs">
                            <div class="titolo-colonna bg-blue-600 text-white">3. Lavori</div>

                            <label for="is_lavori_in_corso">is_lavori_in_corso</label>
                            <input type="checkbox" value="1" name="ish_lavori_in_corso" id="is_lavori_in_corso" {{ old(
    'is_lavori_in_corso',
    $practice->is_lavori_in_corso
) ?
    "checked" : "" }} />

                            <label for="direttore_lavori">direttore_lavori</label>
                            <input name="direttore_lavori" id="direttore_lavori"
                                value="{{ old('direttore_lavori', $practice->direttore_lavori) }}" />

                            <label for="assistente_dl">assistente_dl</label>
                            <input name="assistente_dl" id="assistente_dl"
                                value="{{ old('assistente_dl', $practice->assistente_dl) }}" />

                            <label for="consegna_lavori_at">consegna_lavori_at</label>
                            <input type="date" name="consegna_lavori_at" id="consegna_lavori_at"
                                value="{{ old('consegna_lavori_at', $practice->consegna_lavori_at) }}" />

                            <label for="impresa">impresa</label>
                            <input name="impresa" id="impresa" value="{{ old('impresa', $practice->impresa) }}" />

                            <label for="lavori_note">lavori_note</label>
                            <input name="lavori_note" id="lavori_note"
                                value="{{ old('lavori_note', $practice->lavori_note) }}" />

                            <label for="sicurezza">sicurezza</label>
                            <input name="sicurezza" id="sicurezza"
                                value="{{ old('sicurezza', $practice->sicurezza) }}" />

                            <label for="appunti_progettazione">appunti_progettazione</label>
                            <input name="appunti_progettazione" id="appunti_progettazione"
                                value="{{ old('appunti_progettazione', $practice->appunti_progettazione) }}" />
                        </div>

                        <br>

                        <div class="border border-l-8 border-purple-500 rounded-xs">
                            <div class="titolo-colonna bg-purple-500 text-white">4. CRE</div>
                            <label for="is_cre">is_cre</label>
                            <input type="checkbox" value="1" name="is_cre" id="is_cre" {{ old('is_cre', $practice->is_cre) ? "checked" :
    ""
                            }} />

                            <label for="cre_at">cre_at</label>
                            <input type="date" name="cre_at" id="cre_at"
                                value="{{ old('cre_at', $practice->cre_at) }}" />

                            <label for="scadenza_esecuzione">scadenza_esecuzione</label>
                            <input type="date" name="scadenza_esecuzione" id="scadenza_esecuzione"
                                value="{{ old('scadenza_esecuzione', $practice->scadenza_esecuzione) }}" />


                        </div>
                    </div>


                    <div class="border-l-8 border-blue-700 p-6 rounded-xs">
                        <div class="titolo-colonna text-red-700">Dati tecnici</div>

                        <label for="zona">zona</label>
                        <input name="zona" id="zona" value="{{ old('zona', $practice->zona) }}" />

                        <label for="strade">strade</label>
                        <input name="strade" id="strade" value="{{ old('strade', $practice->strade) }}" />

                        <label for="coordinate">coordinate</label>
                        <input name="coordinate" id="coordinate"
                            value="{{ old('coordinate', $practice->coordinate) }}" />

                        <div id="map"></div>

                    </div>


                    <div class="grid-rows-2">

                        <div class="border-l-8 border-blue-700 p-6 rounded-xs">
                            <div class="titolo-colonna text-blue-700">Bdap</div>
                            <label for="bdap">bdap</label>
                            <input name="bdap" id="bdap" value="{{ old('bdap', $practice->bdap) }}" />

                            <label for="bdap_convalidato">bdap_convalidato</label>
                            <input name="bdap_convalidato" id="bdap_convalidato"
                                value="{{ old('bdap_convalidato', $practice->bdap_convalidato) }}" />

                            <label for="bdap_note">bdap_note</label>
                            <input name="bdap_note" id="bdap_note"
                                value="{{ old('bdap_note', $practice->bdap_note) }}" />

                            <label for="sito_internet">sito_internet</label>
                            <input name="sito_internet" id="sito_internet"
                                value="{{ old('sito_internet', $practice->sito_internet) }}" />

                            <label for="sito_internet_nota">sito_internet_nota</label>
                            <input name="sito_internet_nota" id="sito_internet_nota"
                                value="{{ old('sito_internet_nota', $practice->sito_internet_nota) }}" />

                            <label for="rif_llpp">rif_llpp</label>
                            <input name="rif_llpp" id="rif_llpp" value="{{ old('rif_llpp', $practice->rif_llpp) }}" />
                        </div>



                        <div class="grid grid-cols-1 md:grid-cols-4 gap-2">

                            <div class="border-l-8 border-blue-700 p-6 rounded-xs">
                                <div class="titolo-colonna text-blue-700">Check</div>

                                <label for="file_count">file_count</label>
                                <input name="file_count" id="file_count"
                                    value="{{ old('file_count', $practice->file_count) }}" />

                                <label for="file_effettivi_count">file_effettivi_count</label>
                                <input name="file_effettivi_count" id="file_effettivi_count"
                                    value="{{ old('file_effettivi_count', $practice->file_effettivi_count) }}" />

                                <label for="check_at">check_at</label>
                                <input name="check_at" id="check_at"
                                    value="{{ old('check_at', $practice->check_at) }}" />

                                <label for="modifica_at">modifica_at</label>
                                <input name="modifica_at" id="modifica_at"
                                    value="{{ old('modifica_at', $practice->modifica_at) }}" />

                                <label for="modifica_utente">modifica_utente</label>
                                <input name="modifica_utente" id="modifica_utente"
                                    value="{{ old('modifica_utente', $practice->modifica_utente) }}" />

                                <label for="alias">alias</label>
                                <input name="alias" id="alias" value="{{ old('alias', $practice->alias) }}" />
                            </div>



                        </div>



                    </div>


                </div>

                <br>



                <button type="submit" class="inner bg-green-600 text-white font-bold">Salva aggiornamenti</button>
        </form>



        <button id="btnStart" class="outer border-green-600 text-green-600 font-bold">Verifica Aggiornamenti</button>
        <div id="status-bar">
            <div>Stato: <span id="statusText">Pronto</span></div>
            <div>File analizzati: <strong id="fileCount">0</strong></div>
        </div>
        <div id="log">I risultati appariranno qui...</div>


        <button id="btnAllinea">Allinea il conteggio</button>

        <script>
            // Gestione controllo aggiornamenti
            const btnStart = document.getElementById('btnStart');
            const logElement = document.getElementById('log');
            const statusElement = document.getElementById('statusText');
            const file_effettivi_count = document.getElementById('file_effettivi_count');

            function writeLog(text, className = "") {
                const span = document.createElement('div');
                if (className) span.className = className;
                span.innerHTML = text;
                logElement.appendChild(span);
                // Autoscroll verso il basso
                logElement.scrollTop = logElement.scrollHeight;
            }

            async function scanEfficient(directoryHandle, targetTimestamp, stats, path = "") {
                // .values() è un iteratore asincrono che non carica tutto in memoria

                for await (const entry of directoryHandle.values()) {
                    const currentPath = path ? `${path}/${entry.name}` : entry.name;
                    if (entry.kind === 'file') {

                        stats.total++; // Incrementa il contatore totale

                        // Aggiorna l'interfaccia ogni 50 file per performance
                        if (stats.total % 50 === 0) {
                            document.getElementById('fileCount').innerText = stats.total;
                        }

                        try {
                            // Otteniamo solo i metadati (operazione leggera)
                            const file = await entry.getFile();

                            if (file.lastModified > targetTimestamp) {
                                const dateStr = new Date(file.lastModified).toLocaleString();
                                writeLog(`<span class="file-entry">������ ${currentPath}</span> <span class="highlight">[Modificato: ${dateStr}]</span>`);
                            }
                        } catch (err) {
                            writeLog(`⚠️ Errore accesso file: ${entry.name}`, "dir-entry");
                        }
                    } else if (entry.kind === 'directory') {
                        // Ricorsione asincrona per le sottocartelle
                        await scanEfficient(entry, targetTimestamp, stats, currentPath);
                    }

                    // Trucco per la memoria: cede il controllo alla UI ogni tanto
                    // Impedisce al browser di segnalare "Pagina bloccata"
                    await new Promise(resolve => setTimeout(resolve, 0));
                    /*
                    setTimeout(resolve, 0): Durante la scansione ricorsiva, questa riga permette al 
                    browser di "respirare", aggiornare il log a video e non mostrare il messaggio di 
                    "Pagina che non risponde" anche se scansiona 10.000 file.
                    */
                }
            }

            btnStart.addEventListener('click', async () => {

                const selectedDate = new Date(@js($practice->check_at)).getTime();

                if (isNaN(selectedDate)) {
                    alert("Per favore, seleziona una data valida.");
                    return;
                }

                if (!window.showDirectoryPicker) {
                    alert("Il tuo browser non supporta questa tecnologia. Usa Chrome o Edge aggiornati.");
                    return;
                }

                try {
                    // 1. Richiesta accesso esplicito in SOLA LETTURA
                    const dirHandle = await window.showDirectoryPicker({
                        mode: 'read'
                    });
                    /*
                    Garanzia mode: 'read': La configurazione iniziale blocca qualsiasi
                    tentativo accidentale di scrittura.
                    */

                    // Reset interfaccia
                    logElement.innerHTML = "";

                    statusElement.innerText = "Scansione in corso (Sola Lettura)...";

                    const stats = { total: 0 }; // Inizializza i conteggi
                    document.getElementById('fileCount').innerText = "0";

                    const startTime = performance.now();

                    // 2. Avvio scansione ottimizzata

                    await scanEfficient(dirHandle, selectedDate, stats, dirHandle.name);


                    const endTime = performance.now();
                    const duration = ((endTime - startTime) / 1000).toFixed(2);

                    // Aggiornamento finale del contatore per precisione
                    document.getElementById('fileCount').innerText = stats.total;
                    statusElement.innerText = `Scansione completata in ${duration} secondi.`;
                    writeLog("<br>✅ Operazione terminata con successo.", "highlight");

                } catch (err) {
                    if (err.name === 'AbortError') {
                        statusElement.innerText = "Operazione annullata.";
                    } else {
                        console.error(err);
                        statusElement.innerText = "Errore critico: " + err.message;
                    }
                } finally {
                    btnStart.disabled = false;
                }
            });


            // Allinea il numero del controllo file e la data
            const check_at = document.getElementById('check_at');
            const btnAllinea = document.getElementById('btnAllinea');
            const fileCount = document.getElementById('fileCount');

            btnAllinea.addEventListener('click', () => {
                console.log(fileCount.innerText);
            });


        </script>




        <script>
            // Inizializza la mappa centrata sul Lecco
            var map = L.map('map').setView([45.890284, 9.3783311], 9);

            // Aggiunge il layer di OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Recupero le coordinate memorizzate

            const coo = @js($practice->coordinate);
            if (coo != null && coo != "") {
                @js($practice->coordinate).split("|").forEach(coordinata => {
                    // Aggiungi il marker
                    L.marker(coordinata.split(",")).addTo(map)
                        .bindPopup('{{ $practice->titolo_esteso }}');
                    //.openPopup();         // Mostra il popup
                });
            } else {
                console.log("Coordinate non presenti");
            }

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