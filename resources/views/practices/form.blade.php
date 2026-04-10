<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettaglio</title>
</head>

<body>
    <a href="{{ route('practices.index') }}">← Torna alla lista</a>
    <h1>{{ $practice->codice }}</h1>
    <h2>{{ $practice->exists ? 'Modifica Pratica' : 'Nuovo Pratica' }}</h2>
    {{-- prevedere solo lettura --}}

    {{-- <small>Creato il: {{ $practice->created_at->format('d/m/Y') }}</small> --}}

    <form action="{{ $practice->exists ? route('practices.update', $practice) : route('practices.store') }}"
        method="POST">
        @csrf

        {{-- Se stiamo modificando, Laravel ha bisogno del metodo PUT --}}
        @if($practice->exists)
        @method('PUT')
        @endif

        <label for="is_in_corso">is_in_corso</label><input type="checkbox" name="is_in_corso" {{ $practice->is_in_corso
        ?
        "checked" : ""}} /><br>
        <label for="titolo">titolo</label><input name="titolo" value="{{ $practice->titolo }}" /><br>
        <label for="titolo_esteso">titolo_esteso</label><input name="titolo_esteso"
            value="{{ $practice->titolo_esteso }}" /><br>
        <label for="zona">zona</label><input name="zona" value="{{ $practice->zona }}" /><br>
        <label for="cup">cup</label><input name="cup" value="{{ $practice->cup }}" /><br>
        <label for="finanziamento">finanziamento</label><input name="finanziamento"
            value="{{ $practice->finanziamento }}" /><br>
        <label for="finanziamento_note">finanziamento_note</label><input name="finanziamento_note"
            value="{{ $practice->finanziamento_note }}" /><br>
        <label for="rup">rup</label><input name="rup" value="{{ $practice->rup }}" /><br>
        <label for="fascicolo">fascicolo</label><input name="fascicolo" value="{{ $practice->fascicolo }}" /><br>
        <label for="importo">importo</label><input name="importo" value="{{ $practice->importo }}" /><br>
        <label for="is_rl">is_rl</label><input type="checkbox" name="is_rl" {{ $practice->is_rl ? "checked" : "" }}
        /><br>
        <label for="is_mims">is_mims</label><input type="checkbox" name="is_mims" {{ $practice->is_mims ? "checked" : ""
        }}
        /><br>
        <label for="rl_codice">rl_codice</label><input name="rl_codice" value="{{ $practice->rl_codice }}" /><br>
        <label for="mims_codice">mims_codice</label><input name="mims_codice"
            value="{{ $practice->mims_codice }}" /><br>
        <label for="avvio_servizio_at">avvio_servizio_at</label><input name="avvio_servizio_at"
            value="{{ $practice->avvio_servizio_at }}" /><br>
        <label for="is_avvio_progettazione">is_avvio_progettazione</label><input type="checkbox"
            name="is_avvio_progettazione" {{ $practice->is_avvio_progettazione ? "checked" : "" }} /><br>
        <label for="progettista">progettista</label><input name="progettista"
            value="{{ $practice->progettista }}" /><br>
        <label for="sicurezza">sicurezza</label><input name="sicurezza" value="{{ $practice->sicurezza }}" /><br>
        <label for="file_count">file_count</label><input name="file_count" value="{{ $practice->file_count }}" /><br>
        <label for="file_effettivi_count">file_effettivi_count</label><input name="file_effettivi_count"
            value="{{ $practice->file_effettivi_count }}" /><br>
        <label for="fte_at">fte_at</label><input name="fte_at" value="{{ $practice->fte_at }}" /><br>
        <label for="def_at">def_at</label><input name="def_at" value="{{ $practice->def_at }}" /><br>
        <label for="ese_at">ese_at</label><input name="ese_at" value="{{ $practice->ese_at }}" /><br>
        <label for="cds_at">cds_at</label><input name="cds_at" value="{{ $practice->cds_at }}" /><br>
        <label for="cds_chiusa_at">cds_chiusa_at</label><input name="cds_chiusa_at"
            value="{{ $practice->cds_chiusa_at }}" /><br>
        <label for="is_avvio_gara">is_avvio_gara</label><input type="checkbox" name="is_avvio_gara" {{
            $practice->is_avvio_gara ? "checked" : "" }} /><br>
        <label for="contratto_at">contratto_at</label><input name="contratto_at"
            value="{{ $practice->contratto_at }}" /><br>
        <label for="is_lavori_in_corso">is_lavori_in_corso</label><input type="checkbox" name="ish_lavori_in_corso" {{
            $practice->is_lavori_in_corso ? "checked" : "" }} /><br>
        <label for="direttore_lavori">direttore_lavori</label><input name="direttore_lavori"
            value="{{ $practice->direttore_lavori }}" /><br>
        <label for="assistente_dl">assistente_dl</label><input name="assistente_dl"
            value="{{ $practice->assistente_dl }}" /><br>
        <label for="consegna_lavori_at">consegna_lavori_at</label><input name="consegna_lavori_at"
            value="{{ $practice->consegna_lavori_at }}" /><br>
        <label for="impresa">impresa</label><input name="impresa" value="{{ $practice->impresa }}" /><br>
        <label for="lavori_note">lavori_note</label><input name="lavori_note"
            value="{{ $practice->lavori_note }}" /><br>
        <label for="is_cre">is_cre</label><input type="checkbox" name="is_cre" {{ $practice->is_cre ? "checked" : "" }}
        /><br>
        <label for="cre_at">cre_at</label><input name="cre_at" value="{{ $practice->cre_at }}" /><br>
        <label for="appunti_progettazione">appunti_progettazione</label><input name="appunti_progettazione"
            value="{{ $practice->appunti_progettazione }}" /><br>
        <label for="rup_note">rup_note</label><input name="rup_note" value="{{ $practice->rup_note }}" /><br>
        <label for="capitolo">capitolo</label><input name="capitolo" value="{{ $practice->capitolo }}" /><br>
        <label for="urgente">urgente</label><input name="urgente" value="{{ $practice->urgente }}" /><br>
        <label for="urgente_nota">urgente_nota</label><input name="urgente_nota"
            value="{{ $practice->urgente_nota }}" /><br>
        <label for="prossima_scadenza_nota">prossima_scadenza_nota</label><input name="prossima_scadenza_nota"
            value="{{ $practice->prossima_scadenza_nota }}" /><br>
        <label for="prossima_scadenza_at">prossima_scadenza_at</label><input name="prossima_scadenza_at"
            value="{{ $practice->prossima_scadenza_at }}" /><br>
        <label for="bdap">bdap</label><input name="bdap" value="{{ $practice->bdap }}" /><br>
        <label for="bdap_convalidato">bdap_convalidato</label><input name="bdap_convalidato"
            value="{{ $practice->bdap_convalidato }}" /><br>
        <label for="bdap_note">bdap_note</label><input name="bdap_note" value="{{ $practice->bdap_note }}" /><br>
        <label for="sito_internet">sito_internet</label><input name="sito_internet"
            value="{{ $practice->sito_internet }}" /><br>
        <label for="sito_internet_nota">sito_internet_nota</label><input name="sito_internet_nota"
            value="{{ $practice->sito_internet_nota }}" /><br>
        <label for="rif_llpp">rif_llpp</label><input name="rif_llpp" value="{{ $practice->rif_llpp }}" /><br>
        <label for="determina_gruppo">determina_gruppo</label><input name="determina_gruppo"
            value="{{ $practice->determina_gruppo }}" /><br>
        <label for="check_at">check_at</label><input name="check_at" value="{{ $practice->check_at }}" /><br>
        <label for="modifica_at">modifica_at</label><input name="modifica_at"
            value="{{ $practice->modifica_at }}" /><br>
        <label for="modifica_utente">modifica_utente</label><input name="modifica_utente"
            value="{{ $practice->modifica_utente }}" /><br>
        <label for="alias">alias</label><input name="alias" value="{{ $practice->alias }}" /><br>
        <label for="scadenza_progetto">scadenza_progetto</label><input name="scadenza_progetto"
            value="{{ $practice->scadenza_progetto }}" /><br>
        <label for="scadenza_affidamento">scadenza_affidamento</label><input name="scadenza_affidamento"
            value="{{ $practice->scadenza_affidamento }}" /><br>
        <label for="scadenza_esecutivo">scadenza_esecutivo</label><input name="scadenza_esecutivo"
            value="{{ $practice->scadenza_esecutivo }}" /><br>
        <label for="gruppo">gruppo</label><input name="gruppo" value="{{ $practice->gruppo }}" /><br>

        <button type="submit">
            {{ $practice->exists ? 'Aggiorna' : 'Salva' }}
        </button>

    </form>

</body>

</html>