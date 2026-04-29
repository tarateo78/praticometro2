<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controllo</title>
</head>

<body>
    <h1>Controllo</h1>
    <p>Effettua controllo su intero archivio</p>

    @foreach ($practices as $prac)
    {{-- <span>{{ $prac->codice }}</span><br> --}}

    @endforeach

    <button id="btnStart">Verifica</button>
    <br>

</body>

<script>
    const obj_practis = {};
    const practices = @js( $practices );
    practices.forEach(element => {
     
        obj_practis[element.codice] = element;
        
    });

    // Object.keys(obj_practis).forEach( (prac) => {
    //     console.log(prac);
    //     console.log(obj_practis[prac]);
    // });

    // const p = "V2327";
    // console.log( typeof obj_practis[p] );
    // console.log( typeof obj_practis[p] !== 'undefined' ? "c'è" : "none" );
    // if ( typeof obj_practis[p] !== 'undefined' ){
    //     console.log( obj_practis[p] );
    // }

    /* ================================================================ */

    const btnStart = document.getElementById('btnStart');



    async function scanEfficient(directoryHandle, path = "") {

        // .values() è un iteratore asincrono che non carica tutto in memoria
        for await (const entry of directoryHandle.values()) {

            // Identazione visiva per la'iterazione'
            // const indent = "  ".repeat(iterazione);
            // console.log(`${indent}[Livello ${iterazione}] ${entry.name} (${entry.kind})`);

            const currentPath = path ? `${path}/${entry.name}` : entry.name;
            if (entry.kind === 'file') {
                

                // stats.total++; // Incrementa il contatore totale

                // Aggiorna l'interfaccia ogni 50 file per performance
                // if (stats.total % 50 === 0) {
                //     document.getElementById('fileCount').innerText = stats.total;
                // }
                
                try {
                    // Otteniamo solo i metadati (operazione leggera)
                    const file = await entry.getFile();
                    console.log(entry);
                    
                    // if (file.lastModified > targetTimestamp) {
                    //     const miaData = new Date(file.lastModified).toISOString();
                    //     const dateStr = new Date(file.lastModified).toLocaleString();
                    //     //                               writeLog(`<span class="file-entry">������ ${currentPath}</span> <span class="highlight">[Modificato: ${dateStr}]</span>( ${miaData} )`);
                    //     // file_nuovi.value += dateStr.substr(0, 10) + " .. " + currentPath.substr(currentPath.search("/") + 1) + " " + '\n';
                    // }
                } catch (err) {
                    console.log(`Errore accesso file: ${entry.name}`, "dir-entry");
                }
            } else if (entry.kind === 'directory') {
                // Ricorsione asincrona per le sottocartelle
                // Sulle cartelle specifiche
                // if (iterazione == 0 && entry.name.toLowerCase().search("atti amministrativi") != -1
                //     || iterazione == 0 && entry.name.toLowerCase().search("cantiere") != -1
                //     || iterazione == 0 && entry.name.toLowerCase().search("conferenza dei servizi") != -1
                //     || iterazione != 0) {
                //     await scanEfficient(entry, targetTimestamp, stats, currentPath, iterazione + 1);
                // }
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

                // if (isNaN(selectedDate)) {
                //     alert("Data dell'ultimo check non presente.");
                //     return;
                // }

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
                    if(  true ){ //dirHandle.name.substr(0,5) == document.getElementById('codice').value ) {

                        // file_nuovi.value = ""; // Cancella la casella dei nuovi file

                        // const stats = { total: 0 }; // Inizializza i conteggi

                        // const startTime = performance.now();

                        // 2. Avvio scansione ottimizzata
                        await scanEfficient(dirHandle, dirHandle.name);

                        // const endTime = performance.now();
                        // const duration = ((endTime - startTime) / 1000).toFixed(2);

                        // file_effettivi_count.value = stats.total;

                        // file_nuovi.value += `\n___ Scansione completata in ${duration} secondi ___`;

                    } else {
                        // file_nuovi.value += "ATTENZIONE: La cartella selezionata non corrisponde alla presente pratica!"
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

</script>



</html>