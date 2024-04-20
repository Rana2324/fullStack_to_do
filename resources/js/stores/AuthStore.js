import { defineStore } from 'pinia'


export const useAuthStore = defineStore('auth', {

    state:()=>({
        authenticated : false,
        user:null
    }),
    getters:{
        isAuthenticated(){
            return this.authenticated
        },
        getUser(){
            return this.user
        }
    },
    actions:{
        setAuthenticated(value){
            this.authenticated = value
        },
        setUser(value){
            this.user = value
        }
    }

})
