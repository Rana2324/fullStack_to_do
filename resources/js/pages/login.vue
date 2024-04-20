<template>
    <div class="container-fluid">
        <!-- Login Form -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4">Login</h2>
                        <form @submit.prevent="login">
                            <!-- Email Input -->
                            <div class="mb-3">
                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="Email"
                                    v-model="userLogin.email"
                                    required
                                />
                            </div>
                            <!-- Password Input -->
                            <div class="mb-3">
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Password"
                                    v-model="userLogin.password"
                                    required
                                />
                            </div>
                            <!-- Login Button -->
                            <button type="submit" class="btn btn-primary w-100">
                                Login
                            </button>
                        </form>
                        <!-- Forgot Password Link -->
                        <div class="text-center mt-3">
                            <router-link
                                to="/forgot-password"
                                class="link-primary"
                                >Forgot your password?</router-link
                            >
                        </div>
                        <!-- Social Logins -->
                        <div class="text-center mt-3">
                            <button
                                class="btn btn-google"
                                @click="loginWithGoogle"
                            >
                                <i class="fab fa-google"></i> Login with Google
                            </button>
                            <button
                                class="btn btn-github"
                                @click="loginWithGitHub"
                            >
                                <i class="fab fa-github"></i> Login with GitHub
                            </button>
                        </div>
                        <!-- Registration Link -->
                        <div class="text-center mt-3">
                            <router-link
                                :to="{ name: 'registration' }"
                                class="link-primary"
                                >Don't have an account? Register</router-link
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import { useAuth } from "../composables/auth";

const userLogin = reactive({
    email: "",
    password: "",
});
const { loginUser } = useAuth();
const login = async () => {
    await loginUser(userLogin);
};
</script>

<style scoped>
.card {
    border-radius: 15px;
}

.btn-primary {
    background-color: #4caf50;
    border-color: #4caf50;
}

.btn-primary:hover {
    background-color: #45a049;
    border-color: #45a049;
}

.btn-google {
    background-color: #db4437;
    border-color: #db4437;
    color: #fff;
    margin-right: 10px;
}

.btn-github {
    background-color: #333;
    border-color: #333;
    color: #fff;
    margin-left: 10px;
}

.link-primary {
    color: #4caf50;
}

.link-primary:hover {
    color: #45a049;
}
</style>
