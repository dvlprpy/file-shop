import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: 'larafiles.local', // اینجا همون دامنه مجازی پروژه
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'larafiles.local',
            protocol: 'http',
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'],
            refresh: true,
        }),
    ],
});
