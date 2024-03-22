<script setup>
import axios from "axios";
import { onMounted, reactive, ref } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const todoList = reactive({
    title: null,
    deadline: null,
    type: null,
    status: null,
});
const todoTypes = ref([]);
const fetchData = async () => {
    try {
        // Fetch todo details
        const todoResponse = await axios.get(
            `/api/todo-list/${route.params.id}`
        );
        todoList.title = todoResponse.data.data.title;
        todoList.deadline = todoResponse.data.data.deadline;
        todoList.type = todoResponse.data.data.todo_type_id;
        todoList.status = todoResponse.data.data.is_active;

        // Fetch todo types
        const typesResponse = await axios.get("/api/todo-types");
        todoTypes.value = typesResponse.data.data;
    } catch (error) {}
};

const updateTodo = async () => {
    try {
        const response = await axios.put(
            `/api/todo-list/${route.params.id}`,
            todoList
        );
        if (response.data.success) {
            router.push({ name: "index" });
        }
    } catch (error) {
        console.error("Error updating todo:", error);
    }
};

onMounted(async () => {
    await fetchData();
});
</script>

<template>
    <div class="container mt-5">
        <!-- Edit Todo Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Edit Todo</h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="updateTodo()">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input
                            type="text"
                            class="form-control"
                            id="title"
                            placeholder="Enter title"
                            v-model="todoList.title"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="deadline" class="form-label"
                            >Deadline</label
                        >
                        <input
                            type="date"
                            class="form-control"
                            id="deadline"
                            v-model="todoList.deadline"
                        />
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select
                            class="form-select"
                            id="type"
                            v-model="todoList.type"
                            required
                        >
                            <option value="" selected>Select type</option>
                            <option
                                v-for="type in todoTypes"
                                :key="type.id"
                                :value="type.id"
                            >
                                {{ type.title }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select
                            class="form-select"
                            id="status"
                            v-model="todoList.status"
                        >
                            <option selected>Select status</option>
                            <option value="1">Completed</option>
                            <option value="0">In Progress</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>
                    <router-link
                        :to="{ name: 'index' }"
                        class="btn btn-secondary ms-2"
                        >Cancel</router-link
                    >
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
