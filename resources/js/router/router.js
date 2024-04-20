import editTodo from "../pages/editTodo.vue";
import index from "../pages/index.vue";
import addTodo from "../pages/addTodo.vue";
import {createRouter,createWebHistory} from "vue-router";
import login from "../pages/login.vue";
import registration from "../pages/registration.vue";
import { useAuthStore } from "../stores/AuthStore";





const routes = [
    {
        path:"/",
        name:"index",
        component:index,
        beforeEnter: (to, from, next) => {
            const {isAuthenticated} = useAuthStore();
            if(isAuthenticated){
                next();
            }
            else{
                next({name:"login"})
            }
        }
    },
    {
        path:"/addTodo",
        name:"addTodo",
        component:addTodo,
        beforeEnter: (to, from, next) => {
            const {isAuthenticated} = useAuthStore();
            if(isAuthenticated){
                next();
            }
            else{
                next({name:"login"})
            }
        }
    },

    {
        path:"/edit/:id",
        name:"edit",
        component:editTodo,
        beforeEnter: (to, from, next) => {
            const {isAuthenticated} = useAuthStore();
            if(isAuthenticated){
                next();
            }
            else{
                next({name:"login"})
            }
        }
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
