<!-- Produit.vue (corrigé avec modale de confirmation fonctionnelle et suppression) -->
<template>
  <div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Liste des Produits</h1>
    <RouterLink to="/pageAcceuil" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Ajout Produit</RouterLink>

    <div class="overflow-x-auto bg-white rounded-lg shadow mt-4">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
            <th class="px-6 py-3">Nom Produit</th>
            <th class="px-6 py-3">Qualité</th>
            <th class="px-6 py-3">Quantité</th>
            <th class="px-6 py-3">Marque</th>
            <th class="px-6 py-3">Prix</th>
            <th class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="produit in produits" :key="produit.id" class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap"> <img
              v-if="produit.image_path"
              :src="`/storage/${produit.image_path}`"
              alt="Image"
              class="w-16 h-16 object-cover rounded"
              />
            <span v-else class="text-gray-400">Aucune</span></td>
            <td class="px-6 py-4 whitespace-nowrap">{{ produit.Nom_produit }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ produit.Qualiter }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ produit.Quantiter }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ produit.Marque }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ produit.Prix }} €</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              <RouterLink
                :to="`/pageAcceuil/${produit.id}`"
                class="text-indigo-600 hover:text-indigo-900 mr-3"
              >
                Éditer
              </RouterLink>
              <button @click="confirmSuppression(produit.id)" class="text-red-600 hover:text-red-900">Supprimer</button>
            </td>
          </tr>
          <tr v-if="produits.length === 0">
            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
              Aucun produit disponible
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modale de confirmation -->
    <div v-if="confirmationProduitId" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-semibold mb-4">Confirmer la suppression</h2>
        <p class="mb-6 text-gray-600">Souhaitez-vous vraiment supprimer ce produit ?</p>
        <div class="flex justify-end gap-4">
          <button @click="annulerSuppression" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100">Annuler</button>
          <button @click="confirmerSuppression" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Supprimer</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { watch } from 'vue';

export default {
  name: 'Produit',
  data() {
    return {
      produits: [],
      loading: true,
      error: null,
      confirmationProduitId: null
    };
  },
  created() {
    this.chargerProduits();
  },
  watch: {
    '$route'() {
      this.chargerProduits();
    }
  },
  methods: {
    async chargerProduits() {
      try {
        this.loading = true;
        const response = await axios.get('/produit');
        this.produits = response.data;
      } catch (error) {
        console.error("Erreur complète:", error);
        this.error = "Erreur lors du chargement des produits: " + error.message;
      } finally {
        this.loading = false;
      }
    },
    confirmSuppression(id) {
      this.confirmationProduitId = id;
    },
    annulerSuppression() {
      this.confirmationProduitId = null;
    },
    async confirmerSuppression() {
      try {
        await axios.delete(`/produit/${this.confirmationProduitId}`);
        this.confirmationProduitId = null;
        this.chargerProduits();
      } catch (error) {
        console.error("Erreur suppression", error);
      }
    }
  }
};
</script>

<style>
/* (optionnel) ajout de transition modale ici si besoin */
</style>
