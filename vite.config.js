import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/dashemr.js',
            ],
            refresh: true,
        }),
    ],
    rollupOptions: {
        external: [
            'alpinejs'
        ],
    },
});
