import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import copy from 'rollup-plugin-copy';
import path from 'path'

export default defineConfig({
    plugins: [
        vue(),
        copy({
            targets: [
              {
                src: 'admin/img/**',
                dest: 'dist/admin/img'
              }
            ],
            verbose: true
          }),
        laravel([
            'resources/sass/app.scss',
            'resources/js/app.js',
        ]),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '@': '/resources/js',
        }
    },
    build: {
        rollupOptions: {
          external: [
            'admin/img/undraw_profile.svg'
          ]
        }
    }
});