<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    
    protected $table = 'produit'; 
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'Nom_produit',
        'Qualiter',
        'Quantiter',
        'Marque',
        'Prix',
        'image_path',
    ];
    protected $casts = [
        'Quantiter' => 'integer',
        'Prix' => 'float',
    ];
    public $timestamps = false;
}
