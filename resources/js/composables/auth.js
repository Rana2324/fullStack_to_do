import { reactive } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { useAuthStore } from '../stores/AuthStore';



export function useAuth(){
    const router = useRouter();
    const authStore = useAuthStore();
    const registerUser = async (userRegistration) => {
        try {
            const response = await axios.post(
                "/api/registration",
                userRegistration
            );
            if (response.data.success) {
                router.push("/login");
            }
        } catch (error) {
            console.error("Registration Error:", error);
        }
    };
    const loginUser = async (userLogin) => {
        try {
            const response = await axios.post("/api/login", userLogin);
            if (response.data.success) {
                authStore.setAuthenticated(true);
                authStore.setUser(response.data.data);
                router.push({ name: "index" });
            }
        } catch (error) {
            console.error("Login Error:", error);
        }
    };




    return{
        registerUser,
        loginUser

    }
}
