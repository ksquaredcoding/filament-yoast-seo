import * as esbuild from 'esbuild'

esbuild.build({
    entryPoints: ['./resources/js/index.js'],
    outfile: './resources/dist/components/filament-yoast-seo.js',
    bundle: true,
    mainFields: ['module', 'main'],
    platform: 'node',
    format: 'esm',
    treeShaking: true,
    target: ['es2020'],
    minify: true,
})