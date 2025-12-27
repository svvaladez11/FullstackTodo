import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import tailwindcss from "@tailwindcss/vite";
import path from "path";

export default defineConfig({
    plugins: [
        vue(),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, './src'),
            '#server': path.resolve(__dirname, './server'),
            '#dist-server': path.resolve(__dirname, './dist/server'),
            '#dist-client': path.resolve(__dirname, './dist/client'),
            vue: 'vue/dist/vue.esm-bundler.js',
        },
        extensions: ['.js', '.ts', '.jsx', '.tsx', '.json', '.vue']
    },
    server: {
        watch: { usePolling: true },
    },
    ssr: {
        noExternal: ["tailwindcss"]
    }
})
