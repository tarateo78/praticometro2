<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    public $timestamps = false; // Disabilita create_at e update_at non riconosciute da sqlite

    protected $fillable = [
        'codice',
        'is_in_corso',
        'titolo',
        'titolo_esteso',
        'zona',
        'strade',
        'cup',
        'finanziamento',
        'finanziamento_note',
        'rup',
        'fascicolo',
        'importo',
        'is_rl',
        'is_mims',
        'rl_codice',
        'mims_codice',
        'is_avvio_progettazione',
        'progettista',
        'sicurezza',
        'file_count',
        'file_effettivi_count',
        'is_cds',
        'is_avvio_gara',
        'is_lavori_in_corso',
        'direttore_lavori',
        'assistente_dl',
        'impresa',
        'lavori_note',
        'is_cre',
        'appunti_progettazione',
        'pratica_note',
        'bdap',
        'bdap_convalidato',
        'bdap_note',
        'sito_internet',
        'sito_internet_nota',
        'determina_gruppo',
        'modifica_utente',
        'gruppo',
        'coordinate',
        'file_nuovi',

        // date
        'avvio_servizio_at',
        'fte_at',
        'def_at',
        'ese_at',
        'cds_avvio_at',
        'cds_chiusa_at',
        'contratto_at',
        'consegna_lavori_at',
        'cre_at',
        'check_at',
        'modifica_at',
        'scadenza_progetto_at',
        'scadenza_affidamento_at',
        'scadenza_esecuzione_at',
    ];

    protected $casts = [

        // 'numero' => 'integer',

        // Decimal
        'importo' => 'decimal:2',

        // Date
        'avvio_servizio_at' => 'date',
        'fte_at' => 'date',
        'def_at' => 'date',
        'ese_at' => 'date',
        'cds_avvio_at' => 'date',
        'cds_chiusa_at' => 'date',
        'contratto_at' => 'date',
        'consegna_lavori_at' => 'date',
        'cre_at' => 'date',
        'check_at' => 'date',
        'modifica_at' => 'date',
        'scadenza_progetto_at' => 'date',
        'scadenza_affidamento_at' => 'date',
        'scadenza_esecuzione_at' => 'date',
    ];
}



