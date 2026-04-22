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
            height: 550px;
            width: 100%;
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
                            {{ $practice->file_count != $practice->file_effettivi_count ? "🗘" : "" }}
                        </div>
                        <div>
                            <label for="is_in_corso">In corso</label>
                            <input type="checkbox" value="1" name="is_in_corso" id="is_in_corso" {{ old( 'is_in_corso' ,
                                $practice->is_in_corso
                            ) ?
                            "checked" :
                            "" }} />
                            <br>

                            <label for="cup">CUP</label>
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

                    <label for="fascicolo">Fascicolo</label>
                    <input name="fascicolo" id="fascicolo" value="{{ old('fascicolo', $practice->fascicolo) }}"
                        class="w-40" />
                    <br>


                    <label for="rup">RUP</label>
                    <input name="rup" id="rup" value="{{ old('rup', $practice->rup) }}" />
                    <br>

                    <label for="pratica_note">Note Pratica</label>
                    <input name="pratica_note" id="pratica_note"
                        value="{{ old('pratica_note', $practice->pratica_note) }}" class="w-full" />
                    <br>

                    <label for="determina_gruppo">Determina Gruppo di Lavoro</label>
                    <input name="determina_gruppo" id="determina_gruppo"
                        value="{{ old('determina_gruppo', $practice->determina_gruppo) }}" class="w-30" />
                    <br>
                    <label for="gruppo">gruppo</label>
                    <input name="gruppo" id="gruppo" value="{{ old('gruppo', $practice->gruppo) }}" class="w-30" />
                    <br>

                    <label for="importo">Importo €</label>
                    <input name="importo" id="importo" value="{{ old('importo', $practice->importo) }}" class="w-40" />

                </div>

                <div class="p-2 rounded-xs">

                    <label for="finanziamento">Finanziamento</label>
                    <input name="finanziamento" id="finanziamento"
                        value="{{ old('finanziamento', $practice->finanziamento) }}" />
                    <br>

                    <label for="finanziamento_note">Note Finanziamento</label>
                    <input name="finanziamento_note" id="finanziamento_note"
                        value="{{ old('finanziamento_note', $practice->finanziamento_note) }}" />
                    <br>

                    <label for="is_rl">Finanziamento RL</label>
                    <input type="checkbox" value="1" name="is_rl" id="is_rl" {{ old('is_rl', $practice->is_rl) ?
                    "checked" : "" }} />

                    <br>

                    <label for="rl_codice">Codice RL</label>
                    <input name="rl_codice" id="rl_codice" value="{{ old('rl_codice', $practice->rl_codice) }}" />
                    <br>

                    <label for="is_mims">Finanziamento MIMS</label>
                    <input type="checkbox" value="1" name="is_mims" id="is_mims" {{ old('is_mims', $practice->is_mims) ?
                    "checked" : "" }} />
                    <br>

                    <label for="mims_codice">Codice MIMS</label>
                    <input name="mims_codice" id="mims_codice"
                        value="{{ old('mims_codice', $practice->mims_codice) }}" />
                </div>
            </div>
            <hr class="border-gray-500 mb-3">

            <div class="p-2">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="grid-rows-2">

                        <div class="border border-l-8 border-yellow-400 rounded-xs {{  $practice->is_avvio_progettazione ? "
                            bg-yellow-100" : "" }}">
                            <div class="titolo-colonna bg-yellow-400 text-white">1. Progettazione</div>


                            <input type="checkbox" value="1" name="is_avvio_progettazione" id="is_avvio_progettazione"
                                {{ old( 'is_avvio_progettazione' , $practice->is_avvio_progettazione
                            ) ? "checked" : "" }} />
                            <label for="is_avvio_progettazione">Fase progettazione avviata</label>
                            <br><br>
                            <label for="avvio_servizio_at">Avvio servizio il</label>
                            <input type="date" name="avvio_servizio_at" id="avvio_servizio_at"
                                value="{{ old('avvio_servizio_at', $practice->avvio_servizio_at) }}"
                                class="{{ !isset($practice->avvio_servizio) ? " date-vuoto" : "" }}" />
                            <br>
                            <label for="progettista">Progettista</label>
                            <input name="progettista" id="progettista"
                                value="{{ old('progettista', $practice->progettista) }}" />
                            <br>
                            <label for="fte_at">Fattibilità approvazione</label>
                            <input type="date" name="fte_at" id="fte_at" value="{{ old('fte_at', $practice->fte_at) }}"
                                class="{{ !isset($practice->fte_at) ? " date-vuoto" : "" }}" />
                            <br>
                            <label for="def_at">Definitivo approvazione</label>
                            <input type="date" name="def_at" id="def_at" value="{{ old('def_at', $practice->def_at) }}"
                                class="{{ !isset($practice->def_at) ? " date-vuoto" : "" }}" />
                            <br>

                            <label for="is_cds">Necessaria CDS</label>
                            <input type="checkbox" value="1" name="is_cds" id="is_cds" {{ old('is_cds',
                                $practice->is_cds) ?
                            "checked" : "" }} />
                            <label for="cds_chiusa_at">→ Cds Verbale</label>
                            <input type="date" name="cds_chiusa_at" id="cds_chiusa_at"
                                value="{{ old('cds_chiusa_at', $practice->cds_chiusa_at) }}"
                                class="{{ !isset($practice->cds_chiusa_at) ? " date-vuoto" : "" }}" />
                            <br>
                            <label for="ese_at">Esecutivo approvazione</label>
                            <input type="date" name="ese_at" id="ese_at" value="{{ old('ese_at', $practice->ese_at) }}"
                                class="{{ !isset($practice->ese_at) ? " date-vuoto" : "" }}" />

                            <br>
                            <label for="appunti_progettazione">Appunti Prog.</label>
                            <textarea name="appunti_progettazione"
                                id="appunti_progettazione">{{ old('appunti_progettazione', $practice->appunti_progettazione) }}</textarea>
                            <br>
                            <hr class="border-yellow-400">
                            <label for="scadenza_progetto">Termine Progettazione</label>
                            <input type="date" name="scadenza_progetto" id="scadenza_progetto"
                                value="{{ old('scadenza_progetto', $practice->scadenza_progetto) }}"
                                class="{{ !isset($practice->scadenza_progetto) ? " date-vuoto" : "" }}" />
                        </div>
                        <br>
                        <div class="border border-l-8 border-green-500 rounded-xs  {{ $practice->is_avvio_gara ? "
                            bg-green-100" : "" }}">
                            <div class="titolo-colonna bg-green-500 text-white">
                                2. Gara appalto</div>
                            <div class="check">
                                <input type="checkbox" value="1" name="is_avvio_gara" id="is_avvio_gara" {{
                                    old( 'is_avvio_gara' , $practice->is_avvio_gara
                                ) ? "checked" : "" }} />
                                <label for="is_avvio_gara">Fase gara d'appalto avviata</label>
                            </div>
                            <br>
                            <label for="contratto_at">Firma Contratto</label>
                            <input type="date" name="contratto_at" id="contratto_at"
                                value="{{ old('contratto_at', $practice->contratto_at) }}"
                                class="{{ !isset($practice->contratto_at) ? " date-vuoto" : "" }}" />
                            <br>
                            <hr class="border-green-500">
                            <label for="scadenza_affidamento">Termine Affidamento</label>
                            <input type="date" name="scadenza_affidamento" id="scadenza_affidamento"
                                value="{{ old('scadenza_affidamento', $practice->scadenza_affidamento) }}"
                                class="{{ !isset($practice->scadenza_affidamento) ? " date-vuoto" : "" }}" />
                        </div>

                    </div>


                    <div class="grid-rows-3">
                        <div class="border border-l-8 border-blue-600 rounded-xs {{ $practice->is_lavori_in_corso ? "
                            bg-blue-100" : "" }}">
                            <div class="titolo-colonna bg-blue-600 text-white">3. Lavori</div>

                            <input type="checkbox" value="1" name="is_lavori_in_corso" id="is_lavori_in_corso" {{
                                old( 'is_lavori_in_corso' , $practice->is_lavori_in_corso
                            ) ?
                            "checked" : "" }} />
                            <label for="is_lavori_in_corso">Fase Esecuzione Lavori avviata</label>
                            <br><br>
                            <label for="direttore_lavori">Dirett. Lavori</label>
                            <input name="direttore_lavori" id="direttore_lavori"
                                value="{{ old('direttore_lavori', $practice->direttore_lavori) }}" />
                            <br>
                            <label for="assistente_dl">assistente_dl</label>
                            <input name="assistente_dl" id="assistente_dl"
                                value="{{ old('assistente_dl', $practice->assistente_dl) }}" />
                            <br>
                            <label for="consegna_lavori_at">Consegna Lavori</label>
                            <input type="date" name="consegna_lavori_at" id="consegna_lavori_at"
                                value="{{ old('consegna_lavori_at', $practice->consegna_lavori_at) }}"
                                class="{{ !isset($practice->consegna_lavori_at) ? " date-vuoto" : "" }}" />
                            <br>
                            <label for="impresa">Impresa</label>
                            <input name="impresa" id="impresa" value="{{ old('impresa', $practice->impresa) }}" />
                            <br>
                            <label for="lavori_note">Note lavori</label>
                            <textarea name="lavori_note"
                                id="lavori_note">{{ old('lavori_note', $practice->lavori_note) }}</textarea>
                            <br>
                            <label for="sicurezza">sicurezza</label>
                            <input name="sicurezza" id="sicurezza"
                                value="{{ old('sicurezza', $practice->sicurezza) }}" />


                        </div>

                        <br>

                        <div class="border border-l-8 border-purple-500 rounded-xs {{ $practice->is_cre ? "
                            bg-purple-100" : "" }}">
                            <div class="titolo-colonna bg-purple-500 text-white">4. CRE</div>
                            <input type="checkbox" value="1" name="is_cre" id="is_cre" {{ old( 'is_cre' ,
                                $practice->is_cre
                            ) ? "checked" :
                            ""
                            }} />
                            <label for="is_cre">Fase CRE effettuata</label>
                            <br>
                            <br>
                            <label for="cre_at">Verbale CRE</label>
                            <input type="date" name="cre_at" id="cre_at" value="{{ old('cre_at', $practice->cre_at) }}"
                                class="{{ !isset($practice->cre_at) ? " date-vuoto" : "" }}" />

                            <hr class="border-purple-500">
                            <label for="scadenza_esecuzione">Termine Esecuzione</label>
                            <input type="date" name="scadenza_esecuzione" id="scadenza_esecuzione"
                                value="{{ old('scadenza_esecuzione', $practice->scadenza_esecuzione) }}"
                                class="{{ !isset($practice->scadenza_esecuzione) ? " date-vuoto" : "" }}" />
                        </div>

                        <br>

                        <div>
                            <button type="submit" class="inner bg-green-600 text-white font-bold">Salva
                                aggiornamenti</button>
                        </div>
                    </div>





                    <div class="grid-rows-3">
                        <div>
                            <span class="titolo-colonna">Dati tecnici</span>
                            <label for="zona">Area</label>
                            <input name="zona" id="zona" value="{{ old('zona', $practice->zona) }}" />
                            <br>
                            <label for="strade">Strade</label>
                            <input name="strade" id="strade" value="{{ old('strade', $practice->strade) }}" />
                            <br>
                            <label for="coordinate">Coordinate</label>
                            <textarea name="coordinate"
                                id="coordinate">{{ old('coordinate', $practice->coordinate) }}</textarea>
                        </div>

                        <br>

                        <div class="">

                            <span class="titolo-colonna">Bdap</span>
                            <label for="bdap">Monitorato</label>
                            <input type="checkbox" name="bdap" id="bdap" value="{{ old('bdap', $practice->bdap) }}" />

                            <label for="bdap_convalidato">Bdap Convalidato</label>
                            <input type="checkbox" name="bdap_convalidato" id="bdap_convalidato"
                                value="{{ old('bdap_convalidato', $practice->bdap_convalidato) }}" />
                            <br>
                            <label for="bdap_note">bdap_note</label>
                            <input name="bdap_note" id="bdap_note"
                                value="{{ old('bdap_note', $practice->bdap_note) }}" />
                            <br>
                            <label for="sito_internet">sito_internet</label>
                            <input type="checkbox" name="sito_internet" id="sito_internet"
                                value="{{ old('sito_internet', $practice->sito_internet) }}" />
                            <br>
                            <label for="sito_internet_nota">sito_internet_nota</label>
                            <input name="sito_internet_nota" id="sito_internet_nota"
                                value="{{ old('sito_internet_nota', $practice->sito_internet_nota) }}" />

                        </div>

                        <br>


                    </div>

                    <div class="">
                        <div id="map"></div>
                    </div>
                </div>

                <br>
                <hr class="border-gray-500 mb-3">
                <div>

                    <span class="titolo-colonna ">Check</span>

                    <label for="file_count">file_count</label>
                    <input name="file_count" id="file_count" class="in-sm"
                        value="{{ old('file_count', $practice->file_count) }}" />

                    <label for="file_effettivi_count">file_effettivi_count</label>
                    <input name="file_effettivi_count" id="file_effettivi_count" class="in-sm"
                        value="{{ old('file_effettivi_count', $practice->file_effettivi_count) }}" />

                    <label for="check_at">check_at</label>
                    <input name="check_at" id="check_at" value="{{ old('check_at', $practice->check_at) }}" />

                    <label for="modifica_at">modifica_at</label>
                    <input name="modifica_at" id="modifica_at"
                        value="{{ old('modifica_at', $practice->modifica_at) }}" />

                    <label for="modifica_utente">modifica_utente</label>
                    <input name="modifica_utente" id="modifica_utente"
                        value="{{ old('modifica_utente', $practice->modifica_utente) }}" />

                    <button id="btnStart" class="outer border-green-600 text-green-600 font-bold">Verifica</button>
                    <br>
                    <label for="file_nuovi">Nuovi File</label>
                    <textarea name="file_nuovi" id="file_nuovi"
                        class="w-full h-80 ">{{ old('file_nuovi', $practice->file_nuovi) }}</textarea>
                    {{-- <div id="status-bar">
                        <div>Stato: <span id="statusText">Pronto</span></div>
                        <div>File analizzati: <strong id="fileCount">0</strong></div>
                    </div> --}}
                    {{-- <div id="log">I risultati appariranno qui...</div> --}}


                    <button id="btnAllinea">Allinea il conteggio</button>
                </div>

        </form>





        <script>
            // Gestione controllo aggiornamenti
            const selectedDate = new Date(@js($practice->check_at)).getTime();

            const btnStart = document.getElementById('btnStart');
            const file_effettivi_count = document.getElementById('file_effettivi_count');
            const check_at = document.getElementById('check_at');
            const file_nuovi = document.getElementById('file_nuovi');
            const btnAllinea = document.getElementById('btnAllinea');
            const file_count = document.getElementById('file_count');

            async function scanEfficient(directoryHandle, targetTimestamp, stats, path = "", iterazione = 0) {

                // .values() è un iteratore asincrono che non carica tutto in memoria
                for await (const entry of directoryHandle.values()) {

                    // Identazione visiva per la'iterazione'
                    // const indent = "  ".repeat(iterazione);
                    // console.log(`${indent}[Livello ${iterazione}] ${entry.name} (${entry.kind})`);

                    const currentPath = path ? `${path}/${entry.name}` : entry.name;
                    if (entry.kind === 'file') {

                        stats.total++; // Incrementa il contatore totale

                        // Aggiorna l'interfaccia ogni 50 file per performance
                        // if (stats.total % 50 === 0) {
                        //     document.getElementById('fileCount').innerText = stats.total;
                        // }

                        try {
                            // Otteniamo solo i metadati (operazione leggera)
                            const file = await entry.getFile();

                            if (file.lastModified > targetTimestamp) {
                                const miaData = new Date(file.lastModified).toISOString();
                                const dateStr = new Date(file.lastModified).toLocaleString();
                                //                               writeLog(`<span class="file-entry">������ ${currentPath}</span> <span class="highlight">[Modificato: ${dateStr}]</span>( ${miaData} )`);
                                file_nuovi.value += dateStr.substr(0, 10) + " .. " + currentPath.substr(currentPath.search("/") + 1) + " " + '\n';
                            }
                        } catch (err) {
                            console.log(`Errore accesso file: ${entry.name}`, "dir-entry");
                        }
                    } else if (entry.kind === 'directory') {
                        // Ricorsione asincrona per le sottocartelle
                        // Sulle cartelle specifiche
                        if (iterazione == 0 && entry.name.toLowerCase().search("atti amministrativi") != -1
                            || iterazione == 0 && entry.name.toLowerCase().search("cantiere") != -1
                            || iterazione == 0 && entry.name.toLowerCase().search("conferenza dei servizi") != -1
                            || iterazione != 0) {
                            await scanEfficient(entry, targetTimestamp, stats, currentPath, iterazione + 1);
                        }
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

                event.preventDefault();

                if (isNaN(selectedDate)) {
                    alert("Data dell'ultimo check non presente.");
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

                    // Verifica la corrispondenza della pratica selezionata
                    if(  dirHandle.name.substr(0,5) == document.getElementById('codice').value ) {

                        file_nuovi.value = ""; // Cancella la casella dei nuovi file

                        const stats = { total: 0 }; // Inizializza i conteggi

                        const startTime = performance.now();

                        // 2. Avvio scansione ottimizzata
                        await scanEfficient(dirHandle, selectedDate, stats, dirHandle.name);

                        const endTime = performance.now();
                        const duration = ((endTime - startTime) / 1000).toFixed(2);

                        file_effettivi_count.value = stats.total;

                        file_nuovi.value += `\n___ Scansione completata in ${duration} secondi ___`;

                    } else {
                        file_nuovi.value += "ATTENZIONE: La cartella selezionata non corrisponde alla presente pratica!"
                    }

                } catch (err) {
                    if (err.name === 'AbortError') {
                        console.log("Operazione showDirectoryPicker annullata.");
                    } else {
                        console.error(err);
                        console.log("Errore critico showDirectoryPicker: " + err.message);
                    }
                } finally {
                    btnStart.disabled = false;
                }
            });



            // Allinea il numero del controllo file e la data e azzera la lista dei file
            btnAllinea.addEventListener('click', () => {
                event.preventDefault();
                check_at.value = (new Date()).toISOString();
                file_count.value = file_effettivi_count.value;
                file_nuovi.value = "";
            });


        </script>




        <script>
            // Inizializza la mappa centrata sul Lecco
            var map = L.map('map').setView([45.890284, 9.3783311], 9);

            // Aggiunge il layer di OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);



            // Array di oggetti marker
            let objNuovoMarker = {};

            // Aggiunge un Marker definito dall'utente
            map.on('click', function (e) {
                // e.latlng contiene le coordinate dove l'utente ha cliccato
                creaNuovoMarker(e.latlng.lat, e.latlng.lng);
            });


            // Aggiorna il campo delle coordinate
            const coord = document.getElementById("coordinate");
            function aggiornaCoordinate() {
                let count = 0;
                let stringa = "";
                Object.keys(objNuovoMarker).forEach(function (id) {
                    if (count != 0) stringa += "|";
                    stringa += objNuovoMarker[id].getLatLng().lat + "," + objNuovoMarker[id].getLatLng().lng;
                    count++;
                });
                coord.value = stringa;
            }

            function creaNuovoMarker(lat, lng, msg) {
                let rnd_id = Math.floor(Math.random() * 11000);
                var nuovoMarker = L.marker([lat, lng], {
                    id: rnd_id,
                    draggable: true, // Permette di spostarlo dopo la creazione
                    title: "Trascina per spostare, Click destro per eliminare"
                }).addTo(map)
                    .bindPopup(msg);

                console.log("Nuovo marker #" + rnd_id + " creato a:", lat, lng);

                objNuovoMarker[rnd_id] = nuovoMarker;

                aggiornaCoordinate();


                // --- Gestione Eventi del singolo Marker ---

                // 1. Intercettare la fine dello spostamento (Drag)
                nuovoMarker.on('dragend', function (event) {
                    var markerSpostato = event.target;
                    var nuovaPosizione = markerSpostato.getLatLng();
                    console.log("Marker spostato #" + markerSpostato.options.id + " a:", nuovaPosizione.lat, nuovaPosizione.lng);
                    aggiornaCoordinate();
                });

                // 2. Cancellazione (con il tasto destro / Context Menu)
                nuovoMarker.on('contextmenu', function (event) {
                    map.removeLayer(event.target);
                    console.log("Marker rimosso");
                    delete objNuovoMarker[event.target.options.id];
                    aggiornaCoordinate();
                });
            }

            // Recupero le coordinate memorizzate e creo i marker
            const coo = @js($practice->coordinate);
            if (coo != null && coo != "") {
                @js($practice->coordinate).split("|").forEach(coordinata => {

                    creaNuovoMarker(coordinata.split(",")[0], coordinata.split(",")[1], '{{ $practice->titolo_esteso }}');


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