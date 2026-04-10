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
    <p>Titolo: {{ $practice->titolo }}</p>
    <p>Cup: {{ $practice->cup }}</p>
    {{-- <small>Creato il: {{ $practice->created_at->format('d/m/Y') }}</small> --}}

<p>{{ $practice->id }}</p> 
<p>{{ $practice->codice }}</p> 
<p>{{ $practice->is_in_corso }}</p> 
<p>{{ $practice->titolo }}</p> 
<p>{{ $practice->titolo_esteso }}</p> 
<p>{{ $practice->zona }}</p> 
<p>{{ $practice->cup }}</p> 
<p>{{ $practice->finanziamento }}</p> 
<p>{{ $practice->finanziamento_note }}</p> 
<p>{{ $practice->rup }}</p> 
<p>{{ $practice->fascicolo }}</p> 
<p>{{ $practice->importo }}</p> 
<p>{{ $practice->is_rl }}</p> 
<p>{{ $practice->is_mims }}</p> 
<p>{{ $practice->rl_codice }}</p> 
<p>{{ $practice->mims_codice }}</p> 
<p>{{ $practice->avvio_servizio_at }}</p> 
<p>{{ $practice->is_avvio_progettazione }}</p> 
<p>{{ $practice->progettista }}</p> 
<p>{{ $practice->sicurezza }}</p> 
<p>{{ $practice->file_count }}</p> 
<p>{{ $practice->file_effettivi_count }}</p> 
<p>{{ $practice->fte_at }}</p> 
<p>{{ $practice->def_at }}</p> 
<p>{{ $practice->ese_at }}</p> 
<p>{{ $practice->cds_at }}</p> 
<p>{{ $practice->cds_chiusa_at }}</p> 
<p>{{ $practice->is_avvio_gara }}</p> 
<p>{{ $practice->contratto_at }}</p> 
<p>{{ $practice->is_lavori_in_corso }}</p> 
<p>{{ $practice->direttore_lavori }}</p> 
<p>{{ $practice->assistente_dl }}</p> 
<p>{{ $practice->consegna_lavori_at }}</p> 
<p>{{ $practice->impresa }}</p> 
<p>{{ $practice->lavori_note }}</p> 
<p>{{ $practice->is_cre }}</p> 
<p>{{ $practice->cre_at }}</p> 
<p>{{ $practice->appunti_progettazione }}</p> 
<p>{{ $practice->rup_note }}</p> 
<p>{{ $practice->capitolo }}</p> 
<p>{{ $practice->urgente }}</p> 
<p>{{ $practice->urgente_nota }}</p> 
<p>{{ $practice->prossima_scadenza_nota }}</p> 
<p>{{ $practice->prossima_scadenza_at }}</p> 
<p>{{ $practice->bdap }}</p> 
<p>{{ $practice->bdap_convalidato }}</p> 
<p>{{ $practice->bdap_note }}</p> 
<p>{{ $practice->sito_internet }}</p> 
<p>{{ $practice->sito_internet_nota }}</p> 
<p>{{ $practice->rif_llpp }}</p> 
<p>{{ $practice->determina_gruppo }}</p> 
<p>{{ $practice->check_at }}</p> 
<p>{{ $practice->modifica_at }}</p> 
<p>{{ $practice->modifica_utente }}</p> 
<p>{{ $practice->alias }}</p> 
<p>{{ $practice->scadenza_progetto }}</p> 
<p>{{ $practice->scadenza_affidamento }}</p> 
<p>{{ $practice->scadenza_esecutivo }}</p> 
<p>{{ $practice->gruppo }}</p> 

</body>
</html>