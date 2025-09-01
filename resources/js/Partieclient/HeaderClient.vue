<template>
    <header class="sticky top-0 z-10 flex justify-between items-center px-4 md:px-8 py-4 bg-gray-50 shadow-sm">
      <!-- Logo et bouton de menu mobile -->
      <div class="flex items-center">
        <div class="w-10 h-10 mr-2 md:mr-4 mt-1">
          <img src="../Component/Pages/Logo.png" alt="Logo">
        </div>
        <!-- Bouton de menu mobile (visible uniquement sur mobile) -->
        <button 
          @click="toggleMobileMenu" 
          class="md:hidden bg-transparent border-none p-2 cursor-pointer focus:outline-none"
          aria-label="Toggle navigation menu"
        >
          <svg 
            v-if="!mobileMenuOpen" 
            xmlns="http://www.w3.org/2000/svg" 
            class="h-6 w-6 text-gray-700" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg 
            v-else 
            xmlns="http://www.w3.org/2000/svg" 
            class="h-6 w-6 text-gray-700" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
  
      <!-- Navigation pour desktop -->
      <nav class="hidden md:block flex-1 mx-8">
        <ul class="flex justify-center list-none p-0 m-0">
          <li v-for="link in navLinks" :key="link.id" class="mx-4">
            <router-link 
              :to="link.url" 
              class="no-underline text-gray-600 font-medium hover:text-green-500 transition-colors"
            >
              {{ link.text }}
            </router-link>
          </li>
        </ul>
      </nav>
  
      <!-- Boutons pour desktop -->
      <div class="hidden md:flex items-center">
        <button @click="login" class="bg-green-500 text-white border-none py-2 px-4 rounded cursor-pointer">
          Bienvenies 
        </button>
        <RouterLink to="/pageAcceuil" class="bg-green-500 text-white border-none py-2 px-4 rounded cursor-pointer ms-2">
          Connexion
        </RouterLink>
      </div>
    </header>
  
    <!-- Menu mobile (s'affiche lorsque mobileMenuOpen est vrai) -->
    <div 
      v-if="mobileMenuOpen" 
      class="md:hidden fixed inset-0 bg-white z-20 pt-20 pb-6 px-4 overflow-y-auto transition-all duration-300"
      :class="{ 'translate-x-0 opacity-100': mobileMenuOpen, 'translate-x-full opacity-0': !mobileMenuOpen }"
    >
      <nav class="mb-8">
        <ul class="list-none p-0 m-0 space-y-4">
          <li v-for="link in navLinks" :key="link.id" class="border-b border-gray-100 pb-2">
            <router-link 
              :to="link.url" 
              class="block py-2 text-gray-800 font-medium hover:text-green-500 transition-colors"
              @click="mobileMenuOpen = false"
            >
              {{ link.text }}
            </router-link>
          </li>
        </ul>
      </nav>
      
      <!-- Boutons dans le menu mobile -->
      <div class="flex flex-col space-y-3 mt-6">
        <button @click="login" class="w-full bg-green-500 text-white border-none py-3 px-4 rounded cursor-pointer">
          Partie clients
        </button>
        <button @click="login" class="w-full bg-green-500 text-white border-none py-3 px-4 rounded cursor-pointer">
          Connexion
        </button>
      </div>
    </div>
    <SectionClient />
  </template>
  
  <script>
import { RouterLink } from 'vue-router'
import SectionClient from './SectionClient.vue'

export default {
    components:{
    SectionClient,
    },

    data() {
      return {
        mobileMenuOpen: false,
        navLinks: [
          { id: 1, text: 'Accueil', url: '/' },
          { id: 2, text: 'Produits', url: '/produits' },
          { id: 3, text: 'Catégories', url: '/categories' },
          { id: 4, text: 'À propos', url: '/about' },
          { id: 5, text: 'Contact', url: '/contact' }
        ]
      }
    },
    methods: {
      toggleMobileMenu() {
        this.mobileMenuOpen = !this.mobileMenuOpen
        
        // Empêche le défilement du body lorsque le menu est ouvert
        if (this.mobileMenuOpen) {
          document.body.style.overflow = 'hidden'
        } else {
          document.body.style.overflow = ''
        }
      },
      login() {
        // Votre logique de connexion ici
        // Si nécessaire, fermez le menu mobile après le clic
        this.mobileMenuOpen = false
      }
    },
    // S'assurer que le défilement est rétabli si le composant est détruit
    beforeUnmount() {
      document.body.style.overflow = ''
    },
    // Fermer le menu mobile si la fenêtre est redimensionnée à une taille desktop
    mounted() {
      window.addEventListener('resize', () => {
        if (window.innerWidth >= 768 && this.mobileMenuOpen) {
          this.mobileMenuOpen = false
          document.body.style.overflow = ''
        }
      })
    }
  }
  </script>
  
  <style scoped>
  /* Animation pour le menu mobile */
  @keyframes slideIn {
    from {
      transform: translateX(100%);
      opacity: 0;
    }
    to {
      transform: translateX(0);
      opacity: 1;
    }
  }
  
  @keyframes slideOut {
    from {
      transform: translateX(0);
      opacity: 1;
    }
    to {
      transform: translateX(100%);
      opacity: 0;
    }
  }
  </style>