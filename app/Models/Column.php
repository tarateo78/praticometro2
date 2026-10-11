<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{

    public $timestamps = false; // Disabilita create_at e update_at non riconosciute da sqlite

    // Nel caso in cui la chiave non è ID e non è un numero autoincrementale
    protected $primarykey = 'nome_column';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'titolo_column',
        'is_selezionabile',
        'is_visibile',
        'order',
    ];

    // protected $cast = [];

    
    
    // RELAZIONI NEI MODELLI user_practice

    // public function users()
    // {
    //     return $this->belongsToMany(User::class)->withPivot('priority', 'note');
    // }
}
