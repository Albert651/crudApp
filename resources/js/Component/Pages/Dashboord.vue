<template>
  <div class="dashboard-container">
    <!-- En-tête du tableau de bord -->
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Tableau de bord</h1>
      <p class="text-gray-600 mt-1">Bienvenue sur votre espace d'administration</p>
    </div>

    <!-- Cartes statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-lg shadow p-6 flex flex-col">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-gray-500 text-sm font-medium">Total des ventes</h3>
          <div class="bg-green-100 text-green-600 p-2 rounded-full">
            <i class="fa fa-euro-sign"></i>
          </div>
        </div>
        <p class="text-3xl font-bold">12,540 €</p>
        <div class="text-green-500 text-sm mt-2 flex items-center">
          <i class="fa fa-arrow-up mr-1"></i>
          <span>8.2% depuis le mois dernier</span>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow p-6 flex flex-col">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-gray-500 text-sm font-medium">Nouveaux clients</h3>
          <div class="bg-blue-100 text-blue-600 p-2 rounded-full">
            <i class="fa fa-users"></i>
          </div>
        </div>
        <p class="text-3xl font-bold">432</p>
        <div class="text-blue-500 text-sm mt-2 flex items-center">
          <i class="fa fa-arrow-up mr-1"></i>
          <span>12.5% depuis le mois dernier</span>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow p-6 flex flex-col">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-gray-500 text-sm font-medium">Commandes</h3>
          <div class="bg-purple-100 text-purple-600 p-2 rounded-full">
            <i class="fa fa-shopping-cart"></i>
          </div>
        </div>
        <p class="text-3xl font-bold">826</p>
        <div class="text-purple-500 text-sm mt-2 flex items-center">
          <i class="fa fa-arrow-up mr-1"></i>
          <span>4.2% depuis le mois dernier</span>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow p-6 flex flex-col">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-gray-500 text-sm font-medium">Taux de conversion</h3>
          <div class="bg-yellow-100 text-yellow-600 p-2 rounded-full">
            <i class="fa fa-chart-line"></i>
          </div>
        </div>
        <p class="text-3xl font-bold">3.6%</p>
        <div class="text-red-500 text-sm mt-2 flex items-center">
          <i class="fa fa-arrow-down mr-1"></i>
          <span>1.8% depuis le mois dernier</span>
        </div>
      </div>
    </div>

    <!-- Graphique et données récentes -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Graphique -->
      <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
        <h2 class="text-lg font-semibold mb-4">Aperçu des ventes</h2>
        <div class="h-64 flex items-center justify-center border border-dashed border-gray-300 rounded-lg bg-gray-50">
          <!-- Placeholder pour graphique -->
          <p class="text-gray-500">Graphique des ventes mensuelles</p>
        </div>
      </div>

      <!-- Commandes récentes -->
      <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Commandes récentes</h2>
        <ul class="divide-y divide-gray-200">
          <li v-for="(order, index) in recentOrders" :key="index" class="py-3">
            <div class="flex justify-between">
              <p class="font-medium">{{ order.customer }}</p>
              <span :class="[order.status === 'Livré' ? 'bg-green-100 text-green-800' : order.status === 'En cours' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800', 'px-2 py-1 text-xs rounded-full']">
                {{ order.status }}
              </span>
            </div>
            <p class="text-sm text-gray-500 mt-1">{{ order.product }}</p>
            <p class="text-sm text-gray-400 mt-1">{{ order.date }}</p>
          </li>
        </ul>
        <button class="mt-4 text-blue-600 hover:text-blue-800 text-sm font-medium">
          Voir toutes les commandes →
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  name: 'DashboardView',
  setup() {
    const recentOrders = ref([
      { 
        customer: 'Martin Dupont', 
        product: 'iPhone 14 Pro - 256GB', 
        status: 'Livré', 
        date: '15 avril 2025' 
      },
      { 
        customer: 'Sophie Martin', 
        product: 'MacBook Air M3', 
        status: 'En cours', 
        date: '14 avril 2025' 
      },
      { 
        customer: 'Jean Petit', 
        product: 'AirPods Pro 2', 
        status: 'En attente', 
        date: '13 avril 2025' 
      },
      { 
        customer: 'Emma Bernard', 
        product: 'iPad Air 2023', 
        status: 'Livré', 
        date: '12 avril 2025' 
      }
    ]);

    return {
      recentOrders
    };
  }
};
</script>