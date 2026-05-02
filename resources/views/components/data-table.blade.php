@props(['elencoPratiche', 'annoBase', 'titoloColonna', 'campo'])

<?php $importo_totale = 0; ?>

<div class="overflow-auto">
    <table class="table-auto">
        <thead>
            <tr>
                <th>Codice</th>
                <th>Titolo Pratica</th>
                <th>{{ $titoloColonna }}</th>
                <th>Area</th>
                <th>Strade</th>
                <th>Importo</th>
                <th>Finanziamento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($elencoPratiche as $prac)
                <tr id="prat-{{ $prac->id }}">

                    <td class="text-center">
                        {{ $prac->codice }}
                    </td>
                    <td class="min-w-70 max-w-150">{{ $prac->titolo_esteso }}</td>
                    <td class="whitespace-nowrap text-center">
                        {{ isset($prac->$campo) ? $prac->$campo : "In corso" }}
                    </td>
                    <td class="text-center">{{ $prac->zona }}</td>
                    <td class="text-center">{{$prac->strade}} </td>
                    @php
                        $importo = (float) str_replace(",", ".", str_replace(".", "", $prac->importo));
                    @endphp
                    {{-- <td class="">{{
                        number_format((float)str_replace(str_replace($prac->importo,".",""),",",".") , 2,
                        "," ,
                        ".")}} €</td> --}}
                    <td class="text-right pr-2 whitespace-nowrap">{{ number_format($importo, 2, ",", ".") }} €
                    </td>

                    <td class="text-center">{{ $prac->finanziamento }}</td>
                </tr>

                <?php    $importo_totale += $importo; ?>

            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td class="text-center">Numero Pratiche: <span class="font-bold">{{ sizeof($elencoPratiche) }}</span>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td class="font-bold whitespace-nowrap text-right pr-2">
                    {{ number_format($importo_totale, 2, ",", ".") }} €</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>