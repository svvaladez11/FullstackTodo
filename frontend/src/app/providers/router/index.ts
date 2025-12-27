import {createMemoryHistory, createRouter as createVueRouter, createWebHistory} from "vue-router";
import {routes} from "@/app/consts/routes";

export default function createRouter() {
    const isServer = typeof window === "undefined";

    return createVueRouter({
        history: isServer ? createMemoryHistory() : createWebHistory(),
        routes,
    });
}