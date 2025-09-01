import './bootstrap';
import { createApp } from 'vue';
import app from './Component/App.vue';
import router from './route';

createApp(app).use(router).mount("#app")
