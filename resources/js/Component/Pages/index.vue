<template>
    <div class="flex flex-col min-h-screen">
        <!-- Header -->
        <header class="sticky top-0 z-10 flex justify-between items-center px-8 py-4 bg-gray-50 shadow-sm">
            <div class="flex items-center">
                <div class="w-10 h-10 mr-4 mt-1">
                    <img src="../logoVue.png" alt="">
                </div>
                <div class="flex">
                    <button @click="menuSidebar" class="bg-green-500 text-white border-none py-2 px-4 rounded cursor-pointer m-2">Menu</button>
                    <button @click="menuSidebar2" class=" bg-red-500 text-white border-none py-2 px-4 rounded cursor-pointer m-2">
                    x
                    </button>
                </div>
                 
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
            <div class="relative mt-4">
                <!-- Bouton hamburger pour mobile -->
                <button @click="toggleSidebar" class="fixed top-4 left-4 z-50 hidden flex-col justify-between w-8 h-5 bg-transparent border-none cursor-pointer p-0 mt-4 md:hidden">
                    <span class="h-0.5 w-full bg-gray-800 rounded"></span>
                    <span class="h-0.5 w-full bg-gray-800 rounded"></span>
                    <span class="h-0.5 w-full bg-gray-800 rounded"></span>
                </button>

                <!-- Sidebar -->
                <aside id="sidebar" style="display: none;" :class="['fixed left-0 w-64 bg-gray-50 border-r border-gray-200 shadow-md flex flex-col z-50 transition-transform duration-300 ease-in-out', {'translate-x-0': isSidebarOpen, '-translate-x-full md:translate-x-0': !isSidebarOpen}, 'top-[76px] h-[calc(100vh-76px)] mt-2', 'md:w-64 lg:w-72']">
                    <nav class="flex-grow py-4 overflow-y-auto">
                        <button @click="closeSidebar" class="hidden md:hidden text-xl text-gray-500 cursor-pointer bg-transparent border-none">×</button>

                        <h3 class="text-xs text-gray-500 uppercase mx-4 my-2">Menu principal</h3>
                        <ul class="list-none p-0 m-0 mb-4">
                            <li v-for="item in menuItems" :key="item.id" class="m-0">
                                <router-link :to="item.url" @click="onMobileClick" class="flex items-center py-3 px-4 text-gray-800 no-underline hover:bg-gray-200 transition-colors" :class="{'bg-green-50 text-green-500 font-semibold': $route.path === item.url}">
                                    <i :class="[item.icon, 'mr-3 w-5 text-center']"></i>
                                    <span>{{ item.text }}</span>
                                </router-link>
                            </li>
                        </ul>

                        <h3 class="text-xs text-gray-500 uppercase mx-4 my-2">Configuration</h3>
                        <ul class="list-none p-0 m-0 mb-4">
                            <li v-for="item in configItems" :key="item.id" class="m-0">
                                <router-link :to="item.url" @click="onMobileClick" class="flex items-center py-3 px-4 text-gray-800 no-underline hover:bg-gray-200 transition-colors" :class="{'bg-green-50 text-green-500 font-semibold': $route.path === item.url}">
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

                <!-- Overlay pour fermer le sidebar en mobile -->
                <div v-if="isSidebarOpen" @click="closeSidebar" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>
            </div>

            <!-- Zone de contenu principal -->
            <main :class="['flex-1 p-6 transition-all duration-300 ease-in-out', 'md:ml-64 lg:ml-72']">
                <Dashbooard />
                <router-view />
            </main>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import Dashbooard from '../Pages/Dashboord.vue';

export default {
     
    name: 'IndexPage',
   components: {
       Dashbooard,
    },
    setup() {
        const router = useRouter();
        const isSidebarOpen = ref(false);

        // Header navigation links
        const navLinks = ref([
            { id: 1, text: 'Accueil', url: '/' },
            { id: 2, text: 'À propos', url: '/about' },
            { id: 3, text: 'Services', url: '/services' },
            { id: 4, text: 'Contact', url: '/contact' }
        ]);

        // Sidebar menu items
        const menuItems = ref([
            { id: 1, text: 'Tableau de bord', url: '/', icon: 'fa fa-home' },
            { id: 2, text: 'Produits', url: '/pageAcceuil', icon: 'fa fa-box' },
            { id: 3, text: 'Commandes', url: '/commande', icon: 'fa fa-shopping-cart' },
        ]);

        const configItems = ref([
            { id: 6, text: 'Listes des produits', url: '/produit', icon: 'fa fa-cog' },
            { id: 7, text: 'Listes des commandes', url: '/commandeListe', icon: 'fa fa-user' },
        ]);

        // Navigation functions
        const login = () => {
            router.push('/pageAcceuil');
            if (window.innerWidth < 768) {
                closeSidebar();
            }
        };

        // Sidebar functions
        const toggleSidebar = () => {
            isSidebarOpen.value = !isSidebarOpen.value;
        };

        const closeSidebar = () => {
            isSidebarOpen.value = false;
        };

        // Pour les appareils mobiles, fermer le sidebar après clic sur un lien
        const onMobileClick = () => {
            if (window.innerWidth < 768) {
                closeSidebar();
            }
        };

        const menuSidebar = () => {
            document.getElementById('sidebar').style.display = 'block';
        }

        const menuSidebar2 = () => {
            document.getElementById('sidebar').style.display = 'none';
        }

        return {
            // Header related
            navLinks,

            // Sidebar related
            isSidebarOpen,
            menuItems,
            configItems,
            toggleSidebar,
            closeSidebar,
            onMobileClick,
            menuSidebar,
            menuSidebar2,
            // Shared
            login
        };
    }
}
</script>