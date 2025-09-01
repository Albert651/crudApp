<template>
  <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md flex flex-col md:flex-row gap-9">
    <!-- Image à gauche -->

    <!-- Formulaire -->
    <div class="flex-1">
      <div class="bg-gradient-to-r from-green-400 to-green-600 p-4 flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-white">Formulaire d'ajout produit</h2>
      </div>

      <form @submit.prevent class="space-y-6">
        <!-- Champs de formulaire -->
        <div v-for="(label, key) in champs" :key="key" class="p-6">
          <label :for="key" class="block text-sm font-medium text-gray-700 mb-1">{{ label }}</label>
          <input
            :id="key"
            v-model="form[key]"
            :type="key === 'Prix' || key === 'Quantiter' ? 'number' : 'text'"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
            :class="{ 'border-red-500': errors[key] }"
            required
          />
          <p v-if="errors[key]" class="text-red-500 text-xs mt-1">{{ errors[key] }}</p>
        </div>
        <div class="p-6">
          <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image du produit</label>
          <input
            id="image"
            type="file"
            @change="handleFileChange"
            accept="image/*"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
          />
          <p v-if="errors.image" class="text-red-500 text-xs mt-1">{{ errors.image }}</p>
        </div>

        <!-- Boutons du formulaire -->
        <div class="flex items-center justify-end space-x-4 pt-2">
          <RouterLink
            to="/produit"
            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
          >
            Annuler
          </RouterLink>
          <button
            type="button"
            @click="confirmationVisible = true; pendingAction = submitForm"
            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
            :disabled="isSubmitting"
          >
            <span v-if="isSubmitting">Chargement...</span>
            <span v-else>{{ isEditMode ? 'Modifier' : 'Ajouter' }} produit</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modale de confirmation personnalisée -->
  <div v-if="confirmationVisible" class="fixed inset-0 flex items-center justify-center bg-dark bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
      <h2 class="text-lg font-semibold mb-4">Confirmer l'action</h2>
      <p class="mb-6 text-gray-600">Souhaitez-vous vraiment {{ isEditMode ? 'modifier' : 'ajouter' }} ce produit ?</p>
      <div class="flex justify-end gap-4">
        <button @click="confirmationVisible = false" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100">Annuler</button>
        <button @click="confirmationVisible = false; pendingAction && pendingAction()" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Confirmer</button>
      </div>
    </div>
  </div>

  <!-- Toast notification -->
  <Toast v-if="showToast" :message="toastMessage" />
</template>

<script>
import { ref, reactive, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import axios from 'axios';
import Toast from './Toast.vue';


axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.baseURL = 'http://127.0.0.1:8000';

const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found');
}

export default {

  components: { Toast },
  name: 'FormulaireProduit',
   data() {
    return {
      form: {
        Nom_produit: '',
        Qualiter: '',
        Quantiter: '',
        Marque: '',
        Prix: '',
        image: null, // image file
      }
    };
  },

   methods: {
    handleImageChange(event) {
      this.form.image = event.target.files[0]; // 📸 Assigner le fichier image
    },
    async submitForm() {
      const formData = new FormData();
      formData.append('Nom_produit', this.form.Nom_produit);
      formData.append('Qualiter', this.form.Qualiter);
      formData.append('Quantiter', this.form.Quantiter);
      formData.append('Marque', this.form.Marque);
      formData.append('Prix', this.form.Prix);

      if (this.form.image) {
        formData.append('image', this.form.image);
      }

      try {
        const response = await axios.post('http://127.0.0.1:8000/produit', formData);
        alert('Produit enregistré avec succès!');
        console.log(response.data);
      } catch (error) {
        console.error(error);
        alert('Erreur lors de l\'enregistrement');
      }
    }
  },
  
  setup() {
    const router = useRouter();
    const route = useRoute();
    const produitId = route.params.id;

    const isEditMode = ref(false);
    const isSubmitting = ref(false);
    const confirmationVisible = ref(false);
    const pendingAction = ref(null);

    const toastMessage = ref('');
    const showToast = ref(false);

    const form = reactive({
      Nom_produit: '',
      Qualiter: '',
      Quantiter: '',
      Marque: '',
      Prix: '',
    });

    const errors = reactive({});

    const champs = {
      Nom_produit: 'Nom Produit',
      Qualiter: 'Qualité',
      Quantiter: 'Quantité',
      Marque: 'Marque',
      Prix: 'Prix',
    };
    const imageFile = ref(null);

    const handleFileChange = (event) => {
  imageFile.value = event.target.files[0];
}
    // Si mode édition, charger les données existantes
    onMounted(() => {
      if (produitId) {
        isEditMode.value = true;
        chargerProduit(produitId);
      }
    });

    const chargerProduit = async (id) => {
      try {
        const response = await axios.get(`/produit/${id}`);
        Object.assign(form, response.data);
      } catch (error) {
        console.error('Erreur chargement produit:', error);
      }
    };

    const resetForm = () => {
      Object.keys(form).forEach(key => form[key] = '');
      Object.keys(errors).forEach(key => delete errors[key]);
    };

  const submitForm = async () => {
  isSubmitting.value = true;
  const formData = new FormData();

  for (const key in form) {
    formData.append(key, form[key]);
  }
  if (imageFile.value) {
    formData.append('image', imageFile.value);
  }

  try {
    if (isEditMode.value) {
      await axios.post(`/produit/${produitId}?_method=PUT`, formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
      });
      toastMessage.value = 'Produit modifié avec succès !';
    } else {
      await axios.post('/produit', formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
      });
      toastMessage.value = 'Produit ajouté avec succès !';
    }

    showToast.value = true;
    resetForm();
    router.push({ name: 'TableProduit' });
  } catch (error) {
    if (error.response?.data?.errors) {
      Object.assign(errors, error.response.data.errors);
    } else {
      toastMessage.value = 'Erreur lors de l\'envoi du formulaire.';
      showToast.value = true;
    }
    console.error(error);
  } finally {
    isSubmitting.value = false;
  }
};


    return {
      form,
      errors,
      isSubmitting,
      submitForm,
      resetForm,
      isEditMode,
      champs,
      toastMessage,
      showToast,
      confirmationVisible,
      pendingAction
    };
  }
};
</script>

<style scoped>
/* Fade animation (facultatif si Toast.vue ne le gère pas déjà) */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>
