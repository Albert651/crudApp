<template>
    <section class="w-full min-h-screen bg-white flex items-center justify-center p-4">
      <div class="max-w-6xl w-full mx-auto flex flex-col lg:flex-row">
        <!-- Logo en haut à gauche -->
        <div class="absolute top-8 left-8 fade-in">
          <img src="../Component/Pages/Logo.png" alt="E-SHOP" class="w-28 h-auto">
        </div>
        
        <!-- Contenu principal -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center space-y-6 pr-4">
          <div class="space-y-2">
            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight slide-in-left">
              Bienvenue sur le plateforme E-commerce
            </h1>
            <p class="text-lg text-gray-800 mt-4 slide-in-left" style="animation-delay: 0.3s">
              Cliquer le bouton Connexion si vous avez continue
            </p>
          </div>
          
          <div class="mt-8 slide-in-left" style="animation-delay: 0.6s">
            <button
              @click="goToAbout"
              class="bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-12 rounded-full transition duration-300 cursor-pointer  pulse"
            >
            Connexion
            </button>
          </div>
        </div>
        <!-- Image à droite -->
        <div class="w-full lg:w-1/2 flex justify-center items-center mt-8 lg:mt-0 fade-in-up">
          <img 
            src="../Component/Pages/E-commerce.jpg" 
            alt="E-commerce illustration" 
            class="w-full max-w-lg h-auto"
          >
        </div>
      </div>
    </section>
  </template>
  
  <script>

  export default {
  name: "WelcomePage",
  mounted() {
    document.body.classList.add('loaded');
  },
  methods: {
    goToAbout() {
      this.$router.push('/headerClient');
    }
  }

  }
  </script>
  
  <style scoped>
  /* Animation pour le texte qui glisse depuis la gauche */
  .slide-in-left {
    animation: slideInLeft 1s ease forwards;
    opacity: 0;
    transform: translateX(-50px);
  }
  
  @keyframes slideInLeft {
    from {
      opacity: 0;
      transform: translateX(-50px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }
  
  /* Animation pour l'image qui apparaît en montant */
  .fade-in-up {
    animation: fadeInUp 1.2s ease forwards;
    opacity: 0;
    transform: translateY(40px);
  }
  
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(40px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  /* Animation simple d'apparition */
  .fade-in {
    animation: fadeIn 1s ease forwards;
    opacity: 0;
  }
  
  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }
  
  /* Animation de pulsation pour le bouton */
  .pulse {
    animation: pulse 2s infinite;
  }
  
  @keyframes pulse {
    0% {
      transform: scale(1);
      box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    }
    70% {
      transform: scale(1.05);
      box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
    }
    100% {
      transform: scale(1);
      box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
    }
  }
  
  /* Pour s'assurer que les animations commencent correctement après chargement */
  body:not(.loaded) .slide-in-left,
  body:not(.loaded) .fade-in-up,
  body:not(.loaded) .fade-in {
    opacity: 0;
  }
  </style>