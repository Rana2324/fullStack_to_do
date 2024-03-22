import editTodo from "../pages/editTodo.vue";
import index from "../pages/index.vue";
import addTodo from "../pages/addTodo.vue";
import {createRouter,createWebHistory} from "vue-router";
import login from "../pages/login.vue";
import registration from "../pages/registration.vue";

const routes = [
    {
        path:"/",
        name:"index",
        component:index
    },
    {
        path:"/addTodo",
        name:"addTodo",
        component:addTodo
    },

    {
        path:"/edit/:id",
        name:"edit",
        component:editTodo
    },
    {
        path:"/login",
        name:"login",
        component:login
    },
    {
        path:"/registration",
        name:"registration",
        component:registration
    }
]
export default  createRouter({
    history:createWebHistory("/"),
    routes
})
