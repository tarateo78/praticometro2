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

    <div class="banner-filtro text-center">
        <button name="btnStart" id="btnStart" class="border rounded p-2 py-1">Scegli cartella</button>
        <br>
        Seleziona cartella lavori
    </div>

    <div class="banner-filtro bg-green-500 text-center">
        <div id="log">

        </div>
    </div>

</body>

<script>

    const logCartelle = document.getElementById("log");
    const nuoveCartelle = [];
    const practices = @js($practices);
    const btnStart = document.getElementById("btnStart");


    function writelog(testo) {
        log.append(testo);
        log.append(document.createElement("br"));
    }



    btnStart.addEventListener('click', async () => {
        event.preventDefault();

        let stats = {
            codice: null,
            is_in_corso: 1,
        };

        if (!window.showDirectoryPicker) {
            alert("Il tuo browser non supporta questa tecnologia. Usa Chrome o Edge aggiornati.");
            return;
        }

        try {
            const dirHandle = await window.showDirectoryPicker({
                mode: 'read' //Richiesta accesso esplicito in SOLA LETTURA
            });

            for await (const entry of dirHandle.values()) { // Itera solo le directory presenti nella RADICE
                if (entry.kind === 'directory' && entry.name.substr(0, 1) == "V" && /\d/.test(entry.name.substring(1, 4))) {

                    // /\d/.test(entry.name.substring(0, 5) VERIFICA SE NEL TESTO C'E' UN NUMERO

                    cartella = entry.name.substr(0, 5);

                    const objPratica = practices.find(obj => obj.codice === (entry.name.substring(0, 5)));

                    //(entry.name.substring(0, 5))

                    if (typeof objPratica === 'undefined') {
                        stats.codice = entry.name.substr(0, 5)
                        nuoveCartelle.push(stats);
                        writelog("Aggiunta nuova pratica: " + entry.name.substr(0, 5));
                    }

                    // console.log(entry.name.substr(0, 5));

                }
            }
            console.log(nuoveCartelle);
            sendToLaravel(nuoveCartelle);


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



    async function sendToLaravel(data) {
        try {
            const response = await fetch('/api/add-directory', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '...' },
                body: JSON.stringify({ items: data })
            });

            const result = await response.json();
            console.log("Risposta server:", result);
            writelog("__ fine controllo.");
        } catch (error) {
            console.error("Errore durante l'invio:", error);
        }
    }

</script>

</html>