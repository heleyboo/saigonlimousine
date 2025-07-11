import * as esbuild from 'esbuild';

esbuild.build({
    entryPoints: [
        './resources/js/components/xcchart.js',
        './resources/js/components/fchart.js',
        './resources/js/components/vhchart.js',
        './resources/js/chart-js-plugins.js'
    ],
    outdir: 'dist',
    // outfile: 'dist/xcchart.js',
    bundle: true,
    mainFields: ['module', 'main'],
    platform: 'neutral',
    treeShaking: true,
    target: 'es2020',
    minify: true,
});
