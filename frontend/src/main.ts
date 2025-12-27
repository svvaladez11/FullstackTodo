import { createApp, createSSRApp } from 'vue'
import App from '@/app/App.vue'
import createHttpPlugin from "@/app/plugins/http";
import createRouter from "@/app/providers/router";
import createApi from "@/app/providers/api";
import createHead from "@/app/providers/head";
import createPinia from '@/app/providers/pinia';

export type Context = {
    ssr: boolean,
    apiCache: { [p: string]: any },
    url?: string
}

export async function makeApp(context: Context) {
    const createRealApp = context.ssr ? createSSRApp : createApp;
    const app = createRealApp(App);

    const http = createHttpPlugin(
        context.ssr
            ? process.env.API_BASE_URL
            : import.meta.env.VITE_API_BASE_URL
    );
    const api = createApi(http);
    const router = createRouter();
    const pinia = createPinia();
    const head = createHead();


    app.use(router);
    app.use(pinia);
    app.use(head);

    app.provide('api', api);
    app.provide('router', router);
    app.provide('apiCache', context.apiCache);
    app.provide('pinia', pinia);

    return { app, api, http, router, head, pinia };
}
