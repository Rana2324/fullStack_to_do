import axios from "axios";

export function useTodoType() {
    const fetchTodoTypes = async () => {
        try {
            const response = await axios.get("/api/todo-types");
            return response.data.data;
        } catch (error) {
            console.error("Error fetching todo types:", error);
        }
    };
    return {
        fetchTodoTypes
    }
}
