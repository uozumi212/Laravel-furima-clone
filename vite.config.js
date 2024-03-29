import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue'; // Vueをインポート
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.ts',
            ],
            refresh: true,

        }),
    ],
});
