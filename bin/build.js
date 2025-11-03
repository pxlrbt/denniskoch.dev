import { build } from 'esbuild';

async function buildCSS() {
  try {
    console.log('Building CSS with esbuild...');
    await build({
      entryPoints: ['./resources/assets/css/_main.css'],
      outfile: './public/assets/main.css',
      bundle: true,
      minify: true,
      loader: {
        '.css': 'css',
      },
      external: ['/assets/fonts/*', '/assets/images/*'],
      assetNames: '/[name]-[hash]',
      publicPath: '/',
    });
    console.log('CSS build complete!');
  } catch (error) {
    console.error('CSS build failed:', error);
    process.exit(1);
  }
}

async function buildJS() {
  try {
    console.log('Building JS with esbuild...');
    await build({
      entryPoints: ['./resources/assets/js/main.js'],
      outfile: './public/assets/main.js',
      bundle: true,
      minify: true,
      format: 'iife',
      target: ['es2020'],
      define: {
        'process.env.NODE_ENV': '"production"'
      },
      external: ['/assets/fonts/*', '/assets/images/*'],
      assetNames: '/[name]-[hash]',
      publicPath: '/',
    });
    console.log('JS build complete!');
  } catch (error) {
    console.error('JS build failed:', error);
    process.exit(1);
  }
}

await buildCSS();
await buildJS();
