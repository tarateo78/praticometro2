

<x-rep-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                



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
                


            </div>
        </div>
    </div>
</x-rep-layout>
