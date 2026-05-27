<x-rep-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">


                @if ($start)
                    <h2>Pratiche da iniziare:</h2>
                    <x-table-dash :elencoPratiche=$start :titoloColonna="'Termine Esecutivo'" :campo="'ese_at'"/>
                    <br>
                @endif

                @if ($prog)
                    <h2>Progettazione:</h2>
                    <x-table-dash :elencoPratiche=$prog :titoloColonna="'Termine Esecutivo'" :campo="'ese_at'"/>
                    <br>
                @endif

                @if ($cds)
                    <h2>Conferenze dei servizi:</h2>
                    <x-table-dash :elencoPratiche=$cds :titoloColonna="'Avvio CdS'" :campo="'cds_avvio_at'"/>
                    <br>
                @endif

                @if ($gara)
                    <h2>Procedura d'appalto:</h2>
                    <x-table-dash :elencoPratiche=$gara :titoloColonna="'Termine Affidamento'" :campo="'scadenza_affidamento_at'"/>
                    <br>
                @endif

                @if ($lavori)
                    <h2>Esecuzione Lavori:</h2>
                    <x-table-dash :elencoPratiche=$lavori :titoloColonna="'Termine Eseccuzione'" :campo="'scadenza_esecuzione_at'"/>
                    <br>
                @endif

                @if ($cre)
                    <h2>Lavori conclusi - CRE:</h2>
                    <x-table-dash :elencoPratiche=$cre :titoloColonna="'Emesso CRE'" :campo="'cre_at'"/>
                @endif



            </div>
        </div>
    </div>
    </div>
</x-rep-layout>