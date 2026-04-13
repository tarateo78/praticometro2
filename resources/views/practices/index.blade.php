<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco pratiche</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <h1>Elenco pratiche</h1>
    <?php $importo_totale = 0; ?>

    <div class="filtra">
        <div class="form">
            <form action="{{ route('practices.index') }}" method="GET">
                <label for="is_in_corso">Solo pratiche in corso</label><input type="checkbox" name="is_in_corso" id="is_in_corso" {{ isset($_GET['is_in_corso'])?"checked":"" }}>
                <input type="text" name="filtra" id="filtra" placeholder="{{ isset($_GET['filtra'])?$_GET['filtra']:"" }}"/>
                <button type="submit">Applica filtro</button>
            </form>
        </div>
        <div class="conteggio">
            <h2>Numero di pratiche: {{ $practices->count() }}</h2>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Codice</th>
                <th>Titolo</th>
                <th>Stato</th>
                <th>Area</th>
                <th>Cup</th>
                <th>Importo</th>
                <th>Finanziamento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($practices as $practice)
            <tr>

                <td class="text-blue-800">
                    <a href="{{ route('practices.edit', $practice) }}" class="hover:text-black">{{ $practice->codice }}</a></td>
                <td>{{ $practice->titolo }}</td>
                <td>
                    @if ($practice->is_avvio_progettazione)
                        <span class="tag bg-yellow-100" >Prog</span>
                    @endif

                    @if($practice->is_avvio_gara)
                        <span  class="tag bg-green-100" >Gara</span>
                    @endif
                    
                    @if($practice->is_lavori_in_corso)
                        <span  class="tag bg-blue-100" >Lavori</span>
                    @endif
                    
                    @if( $practice->is_cre )
                        <span  class="tag bg-violet-100" >Cre</span>
                    @endif
                </td>
                <td>{{ $practice->zona }}</td>
                <td>{{ $practice->cup }}</td>

                <?php $importo = (float) str_replace( ",",".", str_replace(".","", $practice->importo) ) ?>
                {{-- <td class="">{{ number_format((float)str_replace(str_replace($practice->importo,".",""),",",".") , 2, "," , ".")}} €</td> --}}
                <td class="text-right pr-2">{{ number_format( $importo, 2) }} €</td>

                <td>{{ $practice->finanziamento }}</td>
                <td></td>
            </tr>

            <?php 
            $importo_totale += $importo;
            ?>

            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right">Importo Totale:</td>
                <td class="text-right pr-2">{{ number_format( $importo_totale, 2) }} €</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>