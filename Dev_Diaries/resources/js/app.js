import { createApp } from 'vue';
import App from './components/App.vue';
import router from './Router/index.js';
import "@fortawesome/fontawesome-free/css/all.min.css";

createApp(App).use(router).mount("#app");