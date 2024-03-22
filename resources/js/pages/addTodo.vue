<script setup>
import axios from "axios";
import { onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

const todoList = reactive({
    title: null,
    deadline: null,
    type: null,
});

const todoTypes = ref([]);

const fetchTodoTypes = async () => {
    try {
        const response = await axios.get("/api/todo-types");
        todoTypes.value = response.data.data;
    } catch (error) {
        console.error("Error fetching todo types:", error);
    }
};

const addTodo = async () => {
    try {
        const response = await axios.post("/api/todo-list", todoList);
        if (response.data.success) {
            router.push({ name: "index" });
        }
    } catch (error) {
        console.error("Error adding todo:", error);
    }
};

onMounted(async () => {
    await fetchTodoTypes();
});
</script>

<template>
    <div class="container">
        <h1>Add New Todo</h1>
        <form @submit.prevent="addTodo">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                    type="text"
                    class="form-control"
                    id="title"
                    required
                    v-model="todoList.title"
                />
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input
                    type="date"
                    class="form-control"
                    id="deadline"
                    v-model="todoList.deadline"
                    required
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
                    <option value="" disabled>Select type</option>
                    <option
                        v-for="type in todoTypes"
                        :key="type.id"
                        :value="type.id"
                    >
                        {{ type.title }}
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Todo</button>
        </form>
    </div>
</template>

<style scoped></style>
