// vite.config.client.ts
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import tailwindcss from '@tailwindcss/vite'
import path from 'path'

export default defineConfig({
  plugins: [vue(), tailwindcss()],
  resolve: {
    alias: {
      "@": path.resolve(__dirname, './src'),
      "#server": path.resolve(__dirname, './server'),
    }
  },
  build: {
    outDir: 'dist/client',
    emptyOutDir: true,
    rollupOptions: {
      input: path.resolve(__dirname, 'index.html') // указываем HTML как точку входа
    },
    sourcemap: true,
    cssCodeSplit: true, // отдельный CSS
    base: process.env.BASE || '/',
  }
})
