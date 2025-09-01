<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function index()
    {
        return Produit::all();
    }

    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'Nom_produit' => 'required|string|max:150',
                'Qualiter' => 'required|string|max:100',
                'Quantiter' => 'required|integer',
                'Marque' => 'required|string|max:100',
                'Prix' => 'required|numeric',
                'image' => 'nullable|image|max:2048', // Doit correspondre au nom du champ envoyé depuis Vue
            ]);

            $data = $request->only(['Nom_produit', 'Qualiter', 'Quantiter', 'Marque', 'Prix']);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('produits', 'public');
                $data['image_path'] = $path;
            }

            $produit = Produit::create($data);

            return response()->json([
                'message' => 'Produit ajouté avec succès',
                'produit' => $produit
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function update(Request $request, Produit $produit)
{
    $validatedData = $request->validate([
        'Nom_produit' => 'required|string|max:150',
        'Qualiter' => 'required|string|max:100',
        'Quantiter' => 'required|integer',
        'Marque' => 'required|string|max:100',
        'Prix' => 'required|numeric',
        'Image_produit' => 'nullable|image|max:2048'
    ]);

    $produit->update($validatedData);

    return response()->json(['message' => 'Produit mis à jour avec succès !']);
}


    public function show($id)
{
    return Produit::findOrFail($id);
}




public function destroy($id)
{
    $produit = Produit::findOrFail($id);
    $produit->delete();

    return response()->json(['message' => 'Suppression avec succès !']);
}


}