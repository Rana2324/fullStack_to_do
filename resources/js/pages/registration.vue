<script setup>
import { reactive } from "vue";
import { useAuth } from "../composables/auth";

const userRegistration = reactive({
    name: "",
    email: "",
    password: "",
    confirmPassword: "",
});
const { registerUser } = useAuth();
const register = async () => {
    await registerUser(userRegistration);
};
</script>

<template>
    <div class="container-fluid">
        <!-- Registration Form -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4">Register</h2>
                        <form @submit.prevent="register">
                            <!-- Name Input -->
                            <div class="mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Name"
                                    v-model="userRegistration.name"
                                    required
                                />
                            </div>
                            <!-- Email Input -->
                            <div class="mb-3">
                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="Email"
                                    v-model="userRegistration.email"
                                    required
                                />
                            </div>
                            <!-- Password Input -->
                            <div class="mb-3">
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Password"
                                    v-model="userRegistration.password"
                                    required
                                />
                            </div>
                            <!-- Confirm Password Input -->
                            <div class="mb-3">
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Confirm Password"
                                    v-model="userRegistration.confirmPassword"
                                    required
                                />
                            </div>
                            <!-- Register Button -->
                            <button type="submit" class="btn btn-primary w-100">
                                Register
                            </button>
                        </form>
                        <!-- Already have an account Link -->
                        <div class="text-center mt-3">
                            <router-link to="/login" class="link-primary"
                                >Already have an account? Login</router-link
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

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

.link-primary {
    color: #4caf50;
}

.link-primary:hover {
    color: #45a049;
}
</style>
