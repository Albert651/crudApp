<template>
    <div class="flex flex-col min-h-screen">
      <!-- Header -->
      <header class="sticky top-0 z-10 flex justify-between items-center px-8 py-4 bg-gray-50 shadow-sm">
        <div class="flex items-center">
          <div class="w-10 h-10 mr-4 mt-1">
            <img src="../Component//logoVue.png" alt="">
          </div>
          <!-- Bouton responsive -->
          <button @click="toggleSidebar" class="bg-green-500 text-white border-none py-2 px-4 rounded cursor-pointer m-2">
            {{ isSidebarOpen ? 'Fermer' : 'Menu' }}
          </button>
        </div>
  
        <nav class="flex-1 mx-8">
          <ul class="flex justify-center list-none p-0 m-0">
            <li v-for="link in navLinks" :key="link.id" class="mx-4">
              <router-link :to="link.url" class="no-underline text-gray-600 font-medium hover:text-green-500 transition-colors">
                {{ link.text }}
              </router-link>
            </li>
          </ul>
        </nav>
  
        <div class="flex items-center">
          <button @click="login" class="bg-green-500 text-white border-none py-2 px-4 rounded cursor-pointer">
            Partie clients
          </button>
          <button @click="login" class="bg-green-500 text-white border-none py-2 px-4 rounded cursor-pointer ms-2">
            Connexion
          </button>
        </div>
      </header>
  
      <div class="flex flex-1 relative">
        <!-- Sidebar -->
        <aside
          :class="[
            'fixed left-0 top-[76px] z-50 h-[calc(100vh-76px)] bg-gray-50 border-r border-gray-200 shadow-md w-64 md:w-64 lg:w-72 transition-transform duration-300 ease-in-out',
            isSidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'
          ]"
        >
          <nav class="flex-grow py-4 overflow-y-auto">
            <h3 class="text-xs text-gray-500 uppercase mx-4 my-2">Menu principal</h3>
            <ul class="list-none p-0 m-0 mb-4">
              <li v-for="item in menuItems" :key="item.id" class="m-0">
                <router-link
                  :to="item.url"
                  @click="onMobileClick"
                  class="flex items-center py-3 px-4 text-gray-800 no-underline hover:bg-gray-200 transition-colors"
                  :class="{
                    'bg-green-50 text-green-500 font-semibold': $route.path === item.url
                  }"
                >
                  <i :class="[item.icon, 'mr-3 w-5 text-center']"></i>
                  <span>{{ item.text }}</span>
                </router-link>
              </li>
            </ul>
  
            <h3 class="text-xs text-gray-500 uppercase mx-4 my-2">Configuration</h3>
            <ul class="list-none p-0 m-0 mb-4">
              <li v-for="item in configItems" :key="item.id" class="m-0">
                <router-link
                  :to="item.url"
                  @click="onMobileClick"
                  class="flex items-center py-3 px-4 text-gray-800 no-underline hover:bg-gray-200 transition-colors"
                  :class="{
                    'bg-green-50 text-green-500 font-semibold': $route.path === item.url
                  }"
                >
                  <i :class="[item.icon, 'mr-3 w-5 text-center']"></i>
                  <span>{{ item.text }}</span>
                </router-link>
              </li>
            </ul>
          </nav>
  
          <div class="p-4 border-t border-gray-200">
            <button @click="login" class="w-full py-2 bg-green-500 text-white border-none rounded cursor-pointer">
              Connexion
            </button>
          </div>
        </aside>
  
        <!-- Overlay pour mobile -->
        <div
          v-if="isSidebarOpen && window.innerWidth < 768"
          @click="closeSidebar"
          class="fixed inset-0 bg-black bg-opacity-50 z-40"
        ></div>
  
        <!-- Contenu principal -->
        <main :class="['flex-1 p-6 transition-all duration-300 ease-in-out', 'md:ml-64 lg:ml-72']">
          <Formulairecommande />
          <router-view />
        </main>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
import Formulairecommande from './Formulaire/Formulairecommande.vue';
  
  export default {
    name: 'IndexPage',
    components: {
      Formulairecommande
    },
    setup() {
      const router = useRouter();
      const isSidebarOpen = ref(false);
  
      const navLinks = ref([
        { id: 1, text: 'Accueil', url: '/' },
        { id: 2, text: 'À propos', url: '/about' },
        { id: 3, text: 'Services', url: '/services' },
        { id: 4, text: 'Contact', url: '/contact' }
      ]);
  
      const menuItems = ref([
        { id: 1, text: 'Tableau de bord', url: '/', icon: 'fa fa-home' },
        { id: 2, text: 'Produits', url: '/pageAcceuil', icon: 'fa fa-box' },
        { id: 3, text: 'Commandes', url: '/commande', icon: 'fa fa-shopping-cart' }
      ]);
  
      const configItems = ref([
        { id: 6, text: 'Listes des produits', url: '/produit', icon: 'fa fa-cog' },
        { id: 7, text: 'Listes des commandes', url: '/commandeListe', icon: 'fa fa-user' }
      ]);
  
      const login = () => {
        router.push('/pageAcceuil');
        if (window.innerWidth < 768) {
          closeSidebar();
        }
      };
  
      const toggleSidebar = () => {
        isSidebarOpen.value = !isSidebarOpen.value;
      };
  
      const closeSidebar = () => {
        isSidebarOpen.value = false;
      };
  
      const onMobileClick = () => {
        if (window.innerWidth < 768) {
          closeSidebar();
        }
      };
  
      return {
        navLinks,
        menuItems,
        configItems,
        isSidebarOpen,
        toggleSidebar,
        closeSidebar,
        onMobileClick,
        login
      };
    }
  };
  </script>
  