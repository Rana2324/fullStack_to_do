<template>
    <form @submit.prevent="formSubmit()">
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
            <label for="deadline" class="form-label">Deadline</label>
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
        <div v-if="route.params.id" class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" v-model="todoList.status">
                <option selected>Select status</option>
                <option value="1">Completed</option>
                <option value="0">In Progress</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <router-link :to="{ name: 'index' }" class="btn btn-secondary ms-2"
            >Cancel</router-link
        >
    </form>
</template>

<script setup>
import { useRoute } from "vue-router";
import { useTodoType } from "../composables/todoType";
import { onMounted, ref } from "vue";

const props = defineProps({
    todoList: Object,
});

const todoTypes = ref([]);
const emit = defineEmits(["submit"]);
const route = useRoute();

const { fetchTodoTypes } = useTodoType();
const formSubmit = () => {
    emit("submit", props.todoList);
};

onMounted(async () => {
    todoTypes.value = await fetchTodoTypes();
});
</script>
