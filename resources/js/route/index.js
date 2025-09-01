import { createRouter, createWebHistory } from "vue-router";
//import pagesIndex from '../Component/Pages/index.vue';
import pageAcceul from '../Component/Acceuil.vue'
import FormulaireProduit from "../Component/Pages/FormulaireProduit.vue";
import Formulairecommande from "../Component/Pages/Formulaire/Formulairecommande.vue";

const routes = [
    /************************Partie Client************************ */
    {
        path: '/',
        name: 'acceuil',
        component: () => import('../Partieclient/AcceuilClient.vue')
    },

    {
        path: '/headerClient',
        name: 'header',
        component: () => import('../Partieclient/HeaderClient.vue')
    },

    //{
    //   path: '/acceuil',
    // name: 'acceuil',
    //component: () => import('../Partieclient/Acceuil.vue')
    //},
    /****************************Partie Admine************************************** */
    {
        path: '/dashboard',
        name: 'dashboord',
        component: () => import('../Component/Pages/Dashboord.vue')
    },

    {
        path: '/produit',
        name: 'TableProduit',
        component: () => import('../Component/Pages/TableProduit.vue')
    },
    {
        path: '/pageAcceuil/:id',
        name: 'editProduit',
        component: FormulaireProduit,
        props: true,
    },
    {
        path: '/pageAcceuil',
        name: 'pageAcceuil',
        component: pageAcceul
    },
    {
        path: '/commande',
        name: 'Commande',
        component: () => import('../Component/Pages/Commande.vue')
    },
    {
        path: '/commandeListe/:id',
        name: 'editCommande',
        component: Formulairecommande,
        props: true,
    },

    {
        path: '/commandeListe',
        name: 'ListeCommande',
        component: () => import('../Component/Pages/ListeCommande.vue')
    }

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router