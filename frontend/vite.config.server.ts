import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      "@": path.resolve(__dirname, './src'),
      "#server": path.resolve(__dirname, './server'),
      "#dist-client": path.resolve(__dirname, './dist/client'),
      "#dist-server": path.resolve(__dirname, './dist/server'),
    }
  },
  build: {
    ssr: './src/entry-server.ts',
    outDir: 'dist/server',
    sourcemap: true,
  },
  ssr: {
    noExternal: ["tailwindcss"]
  }
});
