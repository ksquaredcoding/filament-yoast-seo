import { defineConfig } from 'vite';

export default defineConfig({ 
    build: {
        outDir: './resources/dist/components',
        target: 'es2020',
        minify: true,
        lib: {
            entry: './resources/js/filament-yoast-seo.js',
            name: 'yoastSeoManager',
            formats: ['es']
        }
    }
})