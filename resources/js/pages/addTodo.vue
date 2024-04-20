<script setup>
import { reactive } from "vue";
import TodoForm from "../components/TodoForm.vue";
import { useTodoList } from "../composables/todoList";

const { addTodo } = useTodoList();

const todoList = reactive({
    title: null,
    deadline: null,
    type: null,
});
</script>

<template>
    <div class="container">
        <h1>Add New Todo</h1>
        <TodoForm :todo-list="todoList" @submit="addTodo" />
    </div>
</template>

<style scoped></style>
