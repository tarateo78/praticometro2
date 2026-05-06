<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    @vite(['resources/css/report.css', 'resources/js/app.js'])
</head>

<body>

    @php
    if (isset($_GET['annoBase']))
    $annoBase = $_GET['annoBase'];
    else
    $annoBase = date("Y"); // Anno corrente
    @endphp

    <h1>Report annualità {{ $annoBase }}</h1>

    <div class="text-right">

        <label for="annoBase">Selezionare l'anno di riferimento:</label>

        <select name="annoBase" id="annoBase">
            @php
            for ($anno = date("Y"); $anno > date("Y") - 5; $anno--) {
            $selected = $anno == $annoBase ? "selected" : "";
            echo ("<option value='$anno'" . $selected . ">$anno</option>");
            }
            @endphp
        </select>
    </div>

    <script>
        const annoBase = document.getElementById('annoBase');

        annoBase.addEventListener('change', () => {
            window.location.href = "?annoBase=" + annoBase.value;
        });
    </script>

    @php
    $progettazione = [];
    $cds = [];
    $gara = [];
    $lavori = [];
    @endphp


    @foreach ($practices as $prac)
    @if (($prac->is_avvio_progettazione && substr($prac->codice, 1, 2) == substr($annoBase, 2, 2)) || ($prac->ese_at >
    Date($annoBase . "-01-01") && Date($prac->ese_at) < Date($annoBase . "-12-31" ))) @php $progettazione[$prac->codice]
        = $prac;
        @endphp
        @endif
        @endforeach

        @foreach ($practices as $prac)
        @if ( ($prac->cds_avvio_at > Date($annoBase . "-01-01") && $prac->cds_avvio_at < Date($annoBase . "-12-31" )) ||
            ($prac->
            cds_chiusa_at > Date($annoBase . "-01-01") && Date($prac->cds_chiusa_at) < Date($annoBase . "-12-31" )))
                @php $cds[$prac->codice] = $prac;
                @endphp
                @endif
                @endforeach

                @foreach ($practices as $prac)
                @if (($prac->is_avvio_gara && $prac->contratto_at > Date($annoBase . "-01-01") && $prac->contratto_at <
                    Date($annoBase . "-12-31" ))) @php $gara[$prac->codice] = $prac;
                    @endphp
                    @endif
                    @endforeach

                    @foreach ($practices as $prac)
                    @if (($prac->is_lavori_in_corso && $prac->consegna_lavori_at > Date($annoBase . "-01-01") &&
                    $prac->consegna_lavori_at < Date($annoBase . "-12-31" ))) @php $lavori[$prac->codice] = $prac;
                        @endphp
                        @endif
                        @endforeach


                        <h2>Progettazioni {{ $annoBase }}:</h2>
                        <x-data-table :elencoPratiche=$progettazione :annoBase=$annoBase
                            :titoloColonna="'Prog Esecutivo'" :campo="'ese_at'" />
                        <br> <br>


                        <h2>Conferenze dei servizi {{ $annoBase }}:</h2>
                        <x-data-table :elencoPratiche=$cds :annoBase=$annoBase :titoloColonna="'Conf. Servizi'"
                            :campo="'cds_chiusa_at'" />
                        <br> <br>

                        <h2>Gare d'appalto {{ $annoBase }}:</h2>
                        <x-data-table :elencoPratiche=$gara :annoBase=$annoBase :titoloColonna="'Firma Contratto'"
                            :campo="'contratto_at'" />
                        <br> <br>

                        <h2>Esecuzione Lavori {{ $annoBase }}:</h2>
                        <x-data-table :elencoPratiche=$lavori :annoBase=$annoBase :titoloColonna="'Fine Lavori'"
                            :campo="'cre_at'" />
                        <br> <br>

                        <div class="flex justify-end">

                            <a href="{{ route('practices.index') }}?is_in_corso=on"
                                class="m-2 p-2 border border-blue-600 rounded-2xl">Vai a
                                Area Riservata</a>
                        </div>
                        <br>
                        <span>

                            {{-- {{ $practices[0] }} --}}
                        </span>

</body>

</html>