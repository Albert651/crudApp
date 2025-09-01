<template>
 <div class="container mx-auto max-w-2xl bg-white shadow-md rounded-md overflow-hidden my-10">
        <!-- En-tête du formulaire -->
        <div class="bg-gradient-to-r from-green-400 to-green-600 p-4 flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-white">Faire les Commandes</h1>
            <div class="flex space-x-4">
                <button class="bg-white text-green-500 px-4 py-2 rounded-md font-medium">Prévisualiser</button>
            </div>
        </div>
        
        <!-- Corps du formulaire -->
        <form @submit.prevent="submitForm">
        <div class="p-6">
            <!-- Section Nom -->
            <div class="mb-6">
                <label class="block text-gray-700 mb-2 font-medium">Nom</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <input 
                          type="text" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                          placeholder="Prénom"
                          v-model="form.Nom">
                        <span v-if="errors.Nom" class="text-red-500 text-sm">{{ errors.Nom }}</span>
                    </div>
                    <div>
                        <input 
                          type="text" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                          placeholder="Nom de famille"
                          v-model="form.Nom_family">
                        <span v-if="errors.Nom_family" class="text-red-500 text-sm">{{ errors.Nom_family }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Section Email -->
            <div class="mb-6">
                <label class="block text-gray-700 mb-2 font-medium">Email</label>
                <input 
                  type="email" 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                  placeholder="exemple@exemple.com"
                  v-model="form.Email">
                <span v-if="errors.Email" class="text-red-500 text-sm">{{ errors.Email }}</span>
            </div>
            
            <!-- Section Adresse -->
            <div class="mb-6">
                <label class="block text-gray-700 mb-2 font-medium">Adresse</label>
                <div class="space-y-4">
                    <input 
                      type="text" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                      placeholder="Numéro et rue"
                      v-model="form.Adresse">
                    <span v-if="errors.Adresse" class="text-red-500 text-sm">{{ errors.Adresse }}</span>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <input 
                              type="text" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                              placeholder="Ville"
                              v-model="form.Ville">
                            <span v-if="errors.Ville" class="text-red-500 text-sm">{{ errors.Ville }}</span>
                        </div>
                        <div>
                            <input 
                              type="text" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                              placeholder="Numero téléphone"
                              v-model="form.Numero_telephone">
                            <span v-if="errors.Numero_telephone" class="text-red-500 text-sm">{{ errors.Numero_telephone }}</span>
                        </div>
                    </div>
                    
                    <input 
                      type="text" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                      placeholder="Code Postal"
                      v-model="form.Code_postale">
                    <span v-if="errors.Code_postale" class="text-red-500 text-sm">{{ errors.Code_postale }}</span>
                </div>
            </div>
            
            <!-- Section Site Web -->
            <div class="mb-6">
                <label class="block text-gray-700 mb-2 font-medium">Site Web</label>
                <input 
                  type="url" 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                  placeholder="ex: https://claude.ai/chat/f06c719c-fabe-47d7-92c6-ab6ed27530b2"
                  v-model="form.Site_web">
                <span v-if="errors.Site_web" class="text-red-500 text-sm">{{ errors.Site_web }}</span>
            </div>
            
            <!-- Section Commentaire -->
            <div class="mb-6">
                <label class="block text-gray-700 mb-2 font-medium">Commentaire</label>
                <textarea 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 h-32" 
                  placeholder="Facultatif"
                  v-model="form.Commentaire"></textarea>
                <span v-if="errors.Commentaire" class="text-red-500 text-sm">{{ errors.Commentaire }}</span>
            </div>
            
            <!-- Section Produits -->
            <div class="mb-6">
                <label class="block text-gray-700 mb-2 font-medium">Mes produits</label>
                <div class="space-y-4">
                    <!-- Produit 1 -->
                    <div class="flex justify-between items-center border-b pb-3">
                        <div class="flex items-center">
                            <input 
                              type="checkbox" 
                              class="mr-3 h-5 w-5 text-orange-500"
                              v-model="form.produits" 
                              :value="'Produit 1'">
                            <span class="text-gray-700">Produit 1</span>
                        </div>
                        <span class="font-medium">€1.00</span>
                    </div>
                    
                    <!-- Produit 2 -->
                    <div class="flex justify-between items-center border-b pb-3">
                        <div class="flex items-center">
                            <input 
                              type="checkbox" 
                              class="mr-3 h-5 w-5 text-orange-500"
                              v-model="form.produits" 
                              :value="'Produit 2'">
                            <span class="text-gray-700">Produit 2</span>
                        </div>
                        <span class="font-medium">€1.00</span>
                    </div>
                    
                    <!-- Produit 3 -->
                    <div class="flex justify-between items-center border-b pb-3">
                        <div class="flex items-center">
                            <input 
                              type="checkbox" 
                              class="mr-3 h-5 w-5 text-orange-500"
                              v-model="form.produits" 
                              :value="'Produit 3'">
                            <span class="text-gray-700">Produit 3</span>
                        </div>
                        <span class="font-medium">€1.00</span>
                    </div>
                    
                    <!-- Produit 4 -->
                    <div class="flex justify-between items-center border-b pb-3">
                        <div class="flex items-center">
                            <input 
                              type="checkbox" 
                              class="mr-3 h-5 w-5 text-orange-500"
                              v-model="form.produits" 
                              :value="'Produit 4'">
                            <span class="text-gray-700">Produit 4</span>
                        </div>
                        <span class="font-medium">€1.00</span>
                    </div>
                    
                    <!-- Total -->
                    <div class="flex justify-end pt-3">
                        <div class="text-right">
                            <span class="font-medium mr-4">Total</span>
                            <span class="font-bold">{{ calculerTotal() }}€</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bouton de soumission -->
            <div class="flex justify-center mt-8">
                <RouterLink to="/commandeListe" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-6 rounded-md transition-colors m-3">
                    Annuler
                </RouterLink>
                <button 
                  type="submit"
                  class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-6 rounded-md transition-colors m-3"
                  :disabled="isSubmitting">
                    {{ isSubmitting ? 'Traitement en cours...' : isEditMode ? 'Mettre à jour' : 'Procéder au paiement' }}
                </button>
            </div>
        </div>
        </form>
        
        <!-- Toast notification -->
        <Toast v-if="showToast" :message="toastMessage" @close="showToast = false" />
    </div>
</template>

<script setup>
import { ref, reactive, onMounted, computed } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import axios from 'axios';

// Composants
import Toast from '../Toast.vue';

onMounted(() => {
  if (isEditMode.value) {
    chargerCommande(idCommande);
  }
});


const router = useRouter();
const route = useRoute();

const idCommande = route.params.id;
const isEditMode = ref(!!idCommande);
const isSubmitting = ref(false);
const showToast = ref(false);
const toastMessage = ref('');

const form = reactive({
  Nom: '',
  Nom_family: '',
  Email: '',
  Adresse: '',
  Numero_telephone: '',
  Ville: '',
  Code_postale: '',
  Site_web: '',
  Commentaire: '',
  Produit: '',
  produits: []
});

const errors = reactive({});

const chargerCommande = async (id) => {
  try {
    const response = await axios.get(`/commandeListe/${id}`);
    // Map backend data to form fields
    Object.keys(response.data).forEach(key => {
      if (key in form) {
        form[key] = response.data[key];
      }
    });
    
    // Handle produits array if it comes as a string
    if (typeof response.data.Produit === 'string' && response.data.Produit) {
      form.produits = response.data.Produit.split(',').map(p => p.trim());
    }
  } catch (error) {
    console.error('Erreur chargement commande:', error);
    toastMessage.value = 'Erreur lors du chargement de la commande.';
    showToast.value = true;
  }
};

const resetForm = () => {
  Object.keys(form).forEach(key => {
    form[key] = Array.isArray(form[key]) ? [] : '';
  });
  Object.keys(errors).forEach(key => delete errors[key]);
};

const calculerTotal = () => {
  return form.produits.length * 1.00;
};

const submitForm = async () => {
  isSubmitting.value = true;
  
  // Prepare data for submission
  const commandeData = { ...form };
  // Convert produits array to string for backend
  commandeData.Produit = form.produits.join(',');
  
  try {
    if (isEditMode.value) {
      await axios.put(`/commandeListe/${idCommande}`, commandeData);
      toastMessage.value = 'Commande modifiée avec succès !';
    } else {
      await axios.post('/commandeListe', commandeData);
      toastMessage.value = 'Commande enregistrée avec succès !';
    }
    showToast.value = true;
    resetForm();
    router.push('/commandeListe');
  } catch (error) {
    if (error.response?.data?.errors) {
      Object.assign(errors, error.response.data.errors);
    } else {
      toastMessage.value = 'Erreur lors de l\'envoi du formulaire.';
      showToast.value = true;
    }
    console.error('Erreur lors de la soumission:', error);
  } finally {
    isSubmitting.value = false;
  }
};
</script>