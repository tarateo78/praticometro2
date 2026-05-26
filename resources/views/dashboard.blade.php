<x-rep-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    {{ __("Dashboard di") }} <strong>{{ auth()->user()->name }}</strong>
                    {{-- <i>{{ auth()->user()->email }}</i> --}}
                </div>

                <h2>Da iniziare:</h2>
                <x-table-dash :elencoPratiche=$start />
                <br>

                <h2>Progettazioni:</h2>
                <x-table-dash :elencoPratiche=$prog />
                <br>


                <h2>Conferenze dei servizi:</h2>
                <x-table-dash :elencoPratiche=$cds />
                <br>

                <h2>Gare d'appalto:</h2>
                <x-table-dash :elencoPratiche=$gara />
                <br>

                <h2>Esecuzione Lavori:</h2>
                <x-table-dash :elencoPratiche=$lavori />
                <br>

                <h2>Fine Lavori - CRE:</h2>
                <x-table-dash :elencoPratiche=$cre />



            </div>
        </div>
    </div>
    </div>
</x-rep-layout>