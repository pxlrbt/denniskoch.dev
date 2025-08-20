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
      assetNames: '/assets/dist/[name]-[hash]',
      publicPath: '/'
    });
    console.log('CSS build complete!');
  } catch (error) {
    console.error('CSS build failed:', error);
    process.exit(1);
  }
}

await buildCSS();
