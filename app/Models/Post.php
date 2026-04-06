<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false; // Disabilita create_at e update_at non riconosciute da sqlite

    protected $fillable = ['title', 'body'];
}
