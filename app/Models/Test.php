<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


// Se la tabella non segue la convenzione posso forzare il nome: #[Table('nome_mia_tabella')]
// Per convenzione "id" è la chiave, se diversa: #[Table(key: 'mio_id')]
// Se in non è autoincrement posso specificare: #[Table(key: 'mio_id', keyType: 'string', incrementing: false)]
//     opppure solamente: #[WithoutIncrementing]
// Sqlite non supporta il timestamp: #[Table('timestamps: false')]
//     oppure solo: #[WithoutTimestamps]
//     oppure nella classe: public $timestamps = false; // Disabilita create_at e update_at non riconosciute da sqlite

#[WithoutTimestamps]
class Test extends Model
{
    protected $fillable = [
        "testo",
        "numero",
        "valuta",
        "data",
    ];

    // Opzionale: se vuoi che Laravel tratti 'data' come un oggetto Carbon (data)
    protected $casts = [
        'data' => 'date',
        'numero' => 'integer',
        'valuta' => 'decimal:2',
    ];

}
