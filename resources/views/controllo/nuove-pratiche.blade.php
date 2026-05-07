<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controllo nuove pratiche</title>
    @vite(['resources/css/backend.css', 'resources/js/app.js'])
</head>

<body>

    <div class="banner">
        <div class="grid grid-cols-1 md:grid-cols-3">
            <div>

            </div>
            <div>
                <h1>Controllo nuove pratiche</h1>
            </div>
            <div>
                <h3>Gestionale Viabilità ver 1.0</h3>
            </div>
        </div>
    </div>


    <button name="btnStart" id="btnStart" class="btn border rounded p-2 py-1">Scegli cartella</button>
    Seleziona cartella lavori
    @foreach ($practices as $prac)

    <div>
        <div>{{ $prac->codice }}</div>
        <div></div>

    </div>
    @endforeach

</body>

<script>
    const cartelle = [];

    const practices = @js( $practices );

    const btnStart = document.getElementById("btnStart");

    btnStart.addEventListener('click', async () => {

            event.preventDefault();

            if (!window.showDirectoryPicker) {
                alert("Il tuo browser non supporta questa tecnologia. Usa Chrome o Edge aggiornati.");
                return;
            }

            try {
                const dirHandle = await window.showDirectoryPicker({
                    mode: 'read' //Richiesta accesso esplicito in SOLA LETTURA
                });

                for await (const entry of dirHandle.values()) { // Itera solo le directory presenti nella RADICE
                    if(entry.kind === 'directory' && entry.name.substr(0, 1) == "V"){
                        
                        cartella = entry.name.substr(0, 5);
console.log(practices);

                        if( typeof practices[cartella] !== 'undefined'){
                            console.log("Ce");
                        } else {
                            console.log("NO");

                        }

                        console.log(entry.name.substr(0, 5));
                        cartelle.push(entry.name.substr(0, 5));

                    }
                    // Verifica la corrispondenza della pratica selezionata
                    // if (entry.name.substr(0, 5) == document.getElementById('codice').value) {

                    //     file_nuovi.value = ""; // Cancella la casella dei nuovi file

                    //     const stats = { total: 0 }; // Inizializza i conteggi

                    //     const startTime = performance.now();

                    //     // 2. Avvio scansione ottimizzata
                    //     await scanEfficient(entry, selectedDate, stats, entry.name);

                    //     const endTime = performance.now();
                    //     const duration = ((endTime - startTime) / 1000).toFixed(2);

                    //     file_effettivi_count.value = stats.total;

                    //     file_nuovi.value += `\n___ Scansione completata in ${duration} secondi ___`;

                    // }
                }
                console.log(cartelle);


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