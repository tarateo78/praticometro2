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
	<br>
	<button id="btnStart">AVVIA</button>
	<br>

</body>



<script>
	const btnStart = document.getElementById("btnStart");

	// Array di Oggetti
	const practices = @js($practices);

	// array fittizio (da adeguare al progetto)
	// const listCodice = ['V2806', 'V2533', 'V2518', 'V2612', 'V2601'];

	// VERIFICA SE L'ARRAY CONTIENE UN OGGETTO CON ATTRIBUTO CODICE = ""
	// console.log( practices.some(obj => obj.codice === "V2613"));


	// Data controllo aggiornamenti 
	const selectedDate = new Date('2025-01-01');




	async function scanEfficient(directoryHandle, targetTimestamp, path = "") {

		let stats = {
			idPractice: null,
			rootFolderName: directoryHandle.name,
			totalFiles: 0,
			recentFiles: "", // Nomi dei file modificati dopo targetDate
			dateCheck: null
		};

		async function recursiveScan(directoryHandle, targetTimestamp, path = "", iterazione = 0) {

			// .values() è un iteratore asincrono che non carica tutto in memoria
			for await (const entry of directoryHandle.values()) {

				const currentPath = path ? `${path}/${entry.name}` : entry.name;

				if (entry.kind === 'file') {

					stats.totalFiles++; // Incrementa il conteggio dei files

					// Aggiorna l'interfaccia ogni 50 file per performance
					// if (sta.total % 50 === 0) {
					//     document.getElementById('fileCount').innerText = sta.total;
					// }

					try {

						const file = await entry.getFile();

						if (file.lastModified > targetTimestamp) {
							const dateStr = new Date(file.lastModified).toLocaleString();

							// Aggiunge i nomi dei file aggiornati di recente rispetto al targetTime
							// stats.recentFiles.push(dateStr.substr(0, 10) + " .. " + currentPath.substr(currentPath.search("/") + 1));
							stats.recentFiles += dateStr.substr(0, 10) + " .. " + currentPath.substr(currentPath.search("/") + 1) + "\n";
						}

					} catch (err) {
						console.log(`Errore accesso file: ${entry.name}`, "dir-entry");
					}

				} else if (entry.kind === 'directory') {

					// Ricorsione asincrona per le sottocartelle specifiche			
					if (iterazione == 1 && entry.name.toLowerCase().search("atti amministrativi") != -1
						|| iterazione == 1 && entry.name.toLowerCase().search("cantiere") != -1
						|| iterazione == 1 && entry.name.toLowerCase().search("conferenza dei servizi") != -1
						|| iterazione < 3) { // != 0 va in profondità completa
// console.log(iterazione + "- ".repeat(iterazione) + entry.name);
						await recursiveScan(entry, targetTimestamp, currentPath, iterazione + 1);
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

		await recursiveScan(directoryHandle, targetTimestamp, path);
		stats.dateCheck = new Date();
		return stats;
	}





	btnStart.addEventListener('click', async () => {

		event.preventDefault();
		let buffer = [];

		if (isNaN(selectedDate)) {
			alert("Data dell'ultimo check non presente.");
			return;
		}

		if (!window.showDirectoryPicker) {
			alert("Il tuo browser non supporta questa tecnologia. Usa Chrome o Edge aggiornati.");
			return;
		}

		try {

			const dirHandle = await window.showDirectoryPicker({
				mode: 'read' // Richiesta accesso esplicito in SOLA LETTURA
			});

			// Itera solo le directory presenti nella RADICE
			for await (const entry of dirHandle.values()) {

				if (entry.kind === 'directory') {

					// Verifica se il codice della directory corrisponde al codice DB
					// if (a = practices.some(obj => obj.codice === (entry.name.substring(0, 5)))) {

					// Recupera l'oggetto corrispondente
					const objPratica = practices.find(obj => obj.codice === (entry.name.substring(0, 5)));

					if (objPratica) {

						const startTime = performance.now();

						const selectedDate = new Date(objPratica.check_at ?? "2025-01-01");

						// Procede con la scansione in profndità
						const directory = await scanEfficient(entry, selectedDate, entry.name);

						// Assegna l'id della pratica
						directory.idPractice = objPratica.id;

						// Aggiunge l'oggetto al buffer
						buffer.push(directory);

						const endTime = performance.now();
						const duration = ((endTime - startTime) / 1000).toFixed(2);

						console.log("Fatto: " + entry.name.substring(0, 25) + "... " + directory.totalFiles + " files in " + duration + "s");

					}


					// Invio a Laravel quando il buffer raggiunge una certa soglia
					//if (buffer.length >= 5) { 
					//	await sendToLaravel(buffer);
					//	buffer = [];
					//}

				}
			}

			// Stampa il buffer in console
			console.log(buffer);

			// Invia il buffer a Laravel
			await sendToLaravel(buffer);

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
			const response = await fetch('/api/update-directory', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '...' },
				body: JSON.stringify({ items: data })
			});

			const result = await response.json();
			console.log("Risposta server:", result);
		} catch (error) {
			console.error("Errore durante l'invio:", error);
		}
	}



</script>



</html>