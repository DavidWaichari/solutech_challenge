import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
  plugins: [
    vue(),
    laravel([
      'resources/sass/app.scss',
      'resources/js/app.js',
    ]),
  ],
  resolve: {
    alias: {
      '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
      '@': '/resources/js',
    },
  },
  build: {
    rollupOptions: {
      external: [
        // externalize all image files and assets under the admin folder
        /^\/admin\/(.+)\.(png|jpe?g|gif|svg|woff2?|eot|ttf|otf)$/i,
      ],
    },
    base: '/solutech-challenge.herokuapp.com/',
  },
  server: {
    port: 3000,
    proxy: {
      '/api': {
        target: 'https://solutech-challenge.herokuapp.com',
        changeOrigin: true,
      },
    },
  },
});
