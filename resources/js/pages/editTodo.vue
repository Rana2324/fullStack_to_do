<script setup>
import axios from "axios";
import { onMounted, reactive } from "vue";
import TodoForm from "../components/TodoForm.vue";
import { useTodoList } from "../composables/todoList";

const { updateTodo, fetchData } = useTodoList();

const todoList = reactive({
    title: null,
    deadline: null,
    type: null,
    status: null,
});

const fetchTodoList = async () => {
    try {
        // Fetch todo details
        const todoResponse = await fetchData();
        todoList.title = todoResponse.title;
        todoList.deadline = todoResponse.deadline;
        todoList.type = todoResponse.todo_type_id;
        todoList.status = todoResponse.is_active;
    } catch (error) {}
};

onMounted(async () => {
    await fetchTodoList();
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
                <TodoForm :todo-list="todoList" @submit="updateTodo" />
            </div>
        </div>
    </div>
</template>

<style scoped></style>
