<template>
  <div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Liste des Commandes</h1>
    <RouterLink to="/commande" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
      Ajout Produit
    </RouterLink>

    <div class="overflow-x-auto bg-white rounded-lg shadow mt-3">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-40">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
            <th class="px-6 py-3">Prenom</th>
            <th class="px-6 py-3">Email</th>
            <th class="px-6 py-3">Adresse</th>
            <th class="px-6 py-3">Téléphone</th>
            <th class="px-6 py-3">Ville</th>
            <th class="px-6 py-3">Code postale</th>
            <th class="px-6 py-3">Site web</th>
            <th class="px-6 py-3">Commentaire</th>
            <th class="px-6 py-3">Produit</th>
            <th class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="commande in commandes" :key="commande.id" class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">{{ commande.Nom }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ commande.Nom_family }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ commande.Email }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ commande.Adresse }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ commande.Numero_telephone }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ commande.Ville }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ commande.Code_postale }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ commande.Site_web }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ commande.Commentaire }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ commande.Produit }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              <RouterLink
                :to="`/commandeListe/${commande.id}`"
                class="text-indigo-600 hover:text-indigo-900 mr-3"
              >
                Éditer
              </RouterLink>
              <button @click="demanderConfirmation(commande.id)" class="text-red-600 hover:text-red-900">
                Supprimer
              </button>
            </td>
          </tr>
          <tr v-if="commandes.length === 0">
            <td colspan="11" class="px-6 py-4 text-center text-gray-500">
              Aucune commande disponible
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modale de confirmation -->
    <div v-if="commandeASupprimer !== null" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-semibold mb-4">Confirmer la suppression</h2>
        <p class="mb-6 text-gray-600">Souhaitez-vous vraiment supprimer cette commande ?</p>
        <div class="flex justify-end gap-4">
          <button @click="annulerSuppression" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100">Annuler</button>
          <button @click="supprimerCommande" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Supprimer</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ListeCommande',
  data() {
    return {
      commandes: [],
      commandeASupprimer: null,
      loading: false,
      error: null
    };
  },
  created() {
    this.chargerCommandes();
  },
  methods: {
    async chargerCommandes() {
      try {
        this.loading = true;
        const response = await axios.get('/commandeListe');
        this.commandes = response.data;
      } catch (error) {
        console.error("Erreur de chargement :", error);
        this.error = "Erreur lors du chargement des commandes.";
      } finally {
        this.loading = false;
      }
    },
    demanderConfirmation(id) {
      this.commandeASupprimer = id;
    },
    annulerSuppression() {
      this.commandeASupprimer = null;
    },
    async supprimerCommande() {
      try {
        if (this.commandeASupprimer !== null) {
          await axios.delete(`/commandeListe/${this.commandeASupprimer}`);
          this.commandeASupprimer = null;
          this.chargerCommandes();
        }
      } catch (error) {
        console.error("Erreur lors de la suppression :", error);
        alert("Erreur lors de la suppression !");
      }
    }
  }
};
</script>

<style scoped>
/* Vous pouvez ajouter ici vos transitions personnalisées si souhaité */
</style>
