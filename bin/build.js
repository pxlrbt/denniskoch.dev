import { build } from 'esbuild';

async function buildCSS() {
  try {
    console.log('Building CSS with esbuild...');
    await build({
      entryPoints: ['./resources/assets/css/_main.css'],
      outfile: './public/dist/main.css',
      bundle: true,
      minify: true,
      loader: {
        '.css': 'css',
        '.woff2': 'file',
        '.woff': 'file',
        '.ttf': 'file'
      },
      assetNames: 'assets/[name]-[hash]',
      publicPath: '/'
    });
    console.log('CSS build complete!');
  } catch (error) {
    console.error('CSS build failed:', error);
    process.exit(1);
  }
}

await buildCSS();
