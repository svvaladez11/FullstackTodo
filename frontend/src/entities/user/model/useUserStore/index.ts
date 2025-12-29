import { defineStore } from "pinia";
import {computed, reactive, ref} from "vue";
import {type AuthState, type User} from "@/entities/user/types/model/store";

export default defineStore('user', () => {
    const state = reactive<AuthState>({
        user: import.meta.env.SSR ? null : JSON.parse(localStorage.getItem('user')),
        token: import.meta.env.SSR ? null : localStorage.getItem('token'),
        isAuthenticated: import.meta.env.SSR ? false : !!localStorage.getItem('user'),
    });

    const setUser = (params: {user: User}) => {
        state.user = params.user;
        state.isAuthenticated = true;
    }
    const setToken = (params: { token: string}) => {
        state.token = params.token;
        state.isAuthenticated = true;
    }
    const clearState = () => {
        state.user = null;
        state.token = null;
        state.isAuthenticated = false;
    }

    return {
        state,
        setUser,
        setToken,
        clearState,
    }
})