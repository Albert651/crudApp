<?php

namespace App\Models;

use Illuminate\Database\eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    //
    use HasFactory;
    protected $table = 'commande';
    protected $primaryKey = 'id';
    protected $fillable = [
            'Nom',
            'Nom_family',
            'Email',
            'Adresse',
            'Numero_telephone',
            'Ville',
            'Code_postale',
            'Site_web',
            'Commentaire',
            'Produit',
    ];

    public $timestamps = false;
}
