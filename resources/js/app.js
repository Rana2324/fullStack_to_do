import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from "./App.vue";
import './bootstrap';
import router from './router/router';
import axios from 'axios';
import { useAuthStore } from './stores/AuthStore';

axios.get("api/me")
.then(response=>{
    const authStore = useAuthStore();
    if (response.data.success) {
        authStore.setAuthenticated(true);
        authStore.setUser(response.data.data);

    }
})
.finally(()=>{
    const pinia = createPinia();
    const app = createApp(App);

    app.use(pinia)
    app.use(router)
    app.mount("#app");
})


