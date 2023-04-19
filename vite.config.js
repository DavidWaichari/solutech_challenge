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
                // externalize all image files and assets under the admin folder
                /^\/admin\/(.+)\.(png|jpe?g|gif|svg|woff2?|eot|ttf|otf)$/i,
            ],
        }
    }
});