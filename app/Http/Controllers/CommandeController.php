<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commande = DB::table('commande')
            ->leftJoin('produit','produit.Nom_produit', '=','produit.id')
            ->select(
                    'commande.*',
                    'produit.Nom_produit',
                ) 
            ->get();

        return response()->json($commande,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try{
            $validateData = $request->validate([
                'Nom' => 'required|string|max:150',
                'Nom_family' => 'required|string|max:100',
                'Email' => 'required|string|max:100',
                'Adresse' =>'required|string|max:100',
                'Numero_telephone' => 'required|string|max:15',
                'Ville' => 'required|string|max:100',
                'Code_postale' => 'required|string|max:100',
                'Site_web' =>'required|string|max:100',
                'Commentaire' =>'required|string|max:250',
                'Produit' => 'required|string|max:100'
            ]);
            $commande = commande::create($validateData);
            return response()->json(['message'=>'Commande envoyer avec succés', $commande],201);
        }catch(\exception $e){
             // Cette partie va vous montrer l'erreur exacte
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Commande::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
      public function update(Request $request, string $id)
    {
        try {
            $commande = Commande::findOrFail($id);
            
            $validateData = $request->validate([
               'Nom' => 'required|string|max:150',
                'Nom_family' => 'required|string|max:100',
                'Email' => 'required|string|max:100',
                'Adresse' =>'required|string|max:100',
                'Numero_telephone' => 'required|string|max:15',
                'Ville' => 'required|string|max:100',
                'Code_postale' => 'required|string|max:100',
                'Site_web' =>'required|string|max:100',
                'Commentaire' =>'required|string|max:250',
                'Produit' => 'required|string|max:100'
            ]);
            
            // Transformation des données pour correspondre au modèle
            $commande->Nom = $validateData['Nom'];
            $commande->Nom_family = $validateData['Nom_family'];
            $commande->Email = $validateData['Email'];
            $commande->Adresse = $validateData['Adresse'];
            $commande->Numero_telephone = $validateData['Numero_telephone'];
            $commande->Ville = $validateData['Ville'];
            $commande->Code_postale = $validateData['Code_postale'];
            $commande->Site_web = $validateData['Site_web'];
            $commande->Commentaire = $validateData['Commentaire'];
            $commande->Produit = $validateData['Produit'];

            $commande->save();
            
            return response()->json(['message' => 'Commande mise à jour avec succès', 'data' => $commande], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $commande = Commande::findOrFail($id);
            $commande->delete();
            
            return response()->json(['message' => 'Commande supprimée avec succès'], 200);
    }
    
}
