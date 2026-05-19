
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pratiche') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">



                <?php $importo_totale = 0; ?>

                <div class="table-container" id="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Codice</th>
                                <th>Titolo</th>
                                <th>Stato</th>
                                <th>Area</th>
                                <th>Strade</th>
                                <th>Mappa</th>
                                <th>Cup</th>
                                <th>Importo</th>
                                <th>Finanziamento</th>
                                <th>RUP</th>
                                <th>Fascicolo</th>
                                <th>RL</th>
                                <th>MIMS</th>
                                <th>Progettista</th>
                                <th>Sicurezza</th>
                                <th>CdS</th>
                                <th>Direttore Lavori</th>
                                <th>Impresa</th>
                                <th class="whitespace-nowrap">det Grup Lav</th>
                                <th>Gru</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($practices as $prac)
                                <tr id="prat-{{ $prac->id }}">

                                    <td>
                                        <a href="{{ route('practices.edit', $prac) }}" class="link">{{ $prac->codice }}</a>
                                        {{ $prac->file_count != $prac->file_effettivi_count ? "🗘" : "" }}
                                    </td>
                                    <td>{{ $prac->titolo }}</td>
                                    <td>
                                        @if ($prac->is_avvio_progettazione)
                                            <span class="tag bg-yellow-200/60">Prog</span>
                                        @endif

                                        @if($prac->is_avvio_gara)
                                            <span class="tag bg-green-200/60">Gara</span>
                                        @endif

                                        @if($prac->is_lavori_in_corso)
                                            <span class="tag bg-blue-200/60">Lavori</span>
                                        @endif

                                        @if($prac->is_cre)
                                            <span class="tag bg-violet-200/60">Cre</span>
                                        @endif
                                    </td>
                                    <td>{{ $prac->zona }}</td>
                                    <td class="whitespace-nowrap">
                                        @if($prac->strade)
                                            @foreach (explode(",", $prac->strade) as $sp)
                                                <span class='tag bg-gray-200 '>{{ $sp }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if($prac->coordinate != "")
                                            <img src="assets/images/marker/marker-red.svg" alt="tag">
                                        @endif
                                    </td>
                                    <td>{{ $prac->cup }}</td>
                                    <td class="text-right">{{ number_format($prac->importo, 2, ",", ".") }} €</td>
                                    <td>{{ $prac->finanziamento }}</td>
                                    <td>{{ $prac->rup }}</td>
                                    <td>{{ $prac->fascicolo }}</td>
                                    <td>{{ $prac->is_rl }}</td>
                                    <td>{{ $prac->is_mims }}</td>
                                    <td>{{ $prac->progettista }}</td>
                                    <td>{{ $prac->sicurezza }}</td>
                                    <td>{{ $prac->cds_chiusa_at }}</td>
                                    <td>{{ $prac->direttore_lavori }}</td>
                                    <td>{{ $prac->impresa }}</td>
                                    <td>{{ $prac->determina_gruppo }}</td>
                                    <td>{{ $prac->gruppo }}</td>
                                </tr>
                                @php
                                    $importo_totale += $prac->importo;
                                @endphp

                            @endforeach
                        </tbody>
                        <tfoot>
                            <td></td>
                            <td>Numero di interventi: <span class="font-bold">{{ $practices->count() }}</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">Totale:</td>
                            <td class="font-bold whitespace-nowrap">€ {{ number_format($importo_totale, 2, ",", ".")}} €</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tfoot>
                    </table>
                </div>

                <div class="banner-filtro">
                    <div class="grid grid-cols-1 md:grid-cols-12">
                        <div class="md:col-span-6">
                            <form action="{{ route('practices.index') }}" method="GET">
                                @csrf
                                <label for="is_in_corso">In corso</label>
                                <input type="checkbox" name="is_in_corso" id="is_in_corso" {{ isset($_GET['is_in_corso'])
                ? "checked" : "" }}>
                                <input type="text" name="filtra" id="filtra" class="w-40" />
                                <button type="submit" class="filtro-button">Applica</button>
                            </form>
                        </div>
                        <div class="md:col-span-3 ">
                            @if(isset($_GET['filtra']) && $_GET['filtra'] != "")
                                        <div class="tag-filtro">{{
                                $_GET['filtra'] }}
                                            <a
                                                href="{{ route('practices.index') }}{{ isset($_GET['is_in_corso']) ? '?is_in_corso=on' : ''
                                                                                                                                                            }}"><span
                                                    class="text-sm bg-white text-black px-1  rounded-lg ml-2">×</span></a>
                                        </div>
                            @endif
                        </div>

                        <div class=" md:col-span-3 text-right">
                            <button id="btnCopy" class="filtro-button">Copia negli appunti</button>
                        </div>
                    </div>
                    
                </div>



                <div class="flex justify-end">
                    <a href="{{ route('openweb.index') }}" class="m-2 p-2 border border-blue-600 rounded-2xl">Vai a
                        OpenWeb</a>
                    <a href="{{ route('report.index') }}" class="m-2 p-2 border border-blue-600 rounded-2xl">Vai a
                        Report</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>




    


    <script>
        // Assegna l'arrey degli oggetti pratiche filtrate
        const practices = @js($practices);

        // la variabile practice è istanziata nella pagina di dettaglio (show)
        let practice = null;
        const paginaDettaglio = false;

        const pathDettaglio = "elenco";
        const pathOperazione = "/edit";

        // Segue: marker-lavori.js e strade-provincia.js
    </script>



    <script>
        // Copia i dati in memoria
        document.getElementById('btnCopy').addEventListener('click', function() {
            copiaPerFogliDiCalcolo(practices);
        });

        function copiaPerFogliDiCalcolo(arrayDati) {
            if (arrayDati.length === 0) return;

            const headers = Object.keys(arrayDati[0]);
            
            // Creiamo le righe usando il carattere TAB (\t) come separatore
            const righe = arrayDati.map(riga => {
                return headers.map(header => {
                    let valore = riga[header] ?? '';
                    // Puliamo il valore da eventuali ritorni a capo interni che romperebbero le celle
                    return valore.toString().replace(/\r?\n|\r/g, " ");
                }).join('\t'); // Tabulazione per separare le colonne
            });

            // Aggiungiamo l'intestazione in cima
            const testoFinale = headers.join('\t') + '\n' + righe.join('\n');

            // Usiamo l'API degli appunti (Clipboard API)
            navigator.clipboard.writeText(testoFinale).then(() => {
                console.log("Dati copiati! Ora puoi incollarli su Excel o Google Sheets.");
            }).catch(err => {
                console.error('Errore nel copia:', err);
            });
        }
    </script>

