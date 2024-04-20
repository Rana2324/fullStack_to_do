import axios from "axios";
import { useRoute, useRouter } from "vue-router";

export function useTodoList(){
    const route = useRoute();
    const router = useRouter();

    const addTodo = async (formValue) => {
        try {
            const response = await axios.post("/api/todo-list", formValue);
            if (response.data.success) {
                router.push({ name: "index" });
            }
        } catch (error) {
            console.error("Error adding todo:", error);
        }
    };
    const updateTodo = async (formValue) => {
        try {
            const response = await axios.put(
                `/api/todo-list/${route.params.id}`,
                formValue
            );
            if (response.data.success) {
                router.push({ name: "index" });
            }
        } catch (error) {
            console.error("Error updating todo:", error);
        }

    };
    const fetchData = async () => {
        try {
            // Fetch todo details
            const todoResponse = await axios.get(
                `/api/todo-list/${route.params.id}`
            );
            return todoResponse.data.data;

        } catch (error) {}
    };

    return{
        addTodo,
        updateTodo,
        fetchData
    }
}
