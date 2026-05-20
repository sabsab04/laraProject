import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  base: './',

  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
      fonts: [
        bunny('Instrument Sans', {
          weights: [400, 500, 600],
        }),
      ],
    }),
    tailwindcss(),
  ],

  // Configure Vite's development server
  server: {
    host: '0.0.0.0',

    port: 5173,

    hmr: {
      host: 'localhost',
    },

    watch: {
      usePolling: true,
      ignored: ['**/vendor/**', '**/node_modules/**', '**/storage/**'],
    },
  },
});
