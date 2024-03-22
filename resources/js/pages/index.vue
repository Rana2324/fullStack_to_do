<script setup>
import axios from "axios";
import { onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";

const todos = ref([]);
const router = useRouter();

const goToEdit = (id) => {
    router.push({ name: "edit", params: { id: id } });
};

const getTodoList = async () => {
    const response = await axios.get("/api/todo-list");
    todos.value = response.data.data;
};
const deleteTodo = async (id) => {
    if (confirm("Are you Sure!")) {
        const response = await axios.delete(`/api/todo-list/${id}`);
        if (response.data.success) {
            alert("Delete Successfully");
            getTodoList();
        } else {
            alert("Delete Failed");
        }
    }
};
onMounted(() => {
    getTodoList();
});
</script>

<template>
    <div class="container p-3">
        <h1 class="mb-4">Todo List</h1>
        <router-link :to="{ name: 'addTodo' }" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Add New</router-link
        >

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="todo in todos" :key="todo.id">
                    <td>{{ todo.id }}</td>
                    <td>{{ todo.title }}</td>
                    <td>{{ todo.deadline }}</td>
                    <td>{{ todo.todo_type.title }}</td>
                    <td>{{ todo.is_active ? "Completed" : "In Progress" }}</td>

                    <td>
                        <button
                            @click="goToEdit(todo.id)"
                            class="btn btn-primary btn-sm"
                        >
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button
                            @click="deleteTodo(todo.id)"
                            class="btn btn-danger btn-sm"
                        >
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped></style>
