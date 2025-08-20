import { build } from 'esbuild';
import { clean } from 'esbuild-plugin-clean';

async function buildCSS() {
  try {
    console.log('Building CSS with esbuild...');
    await build({
      entryPoints: ['./resources/assets/css/_main.css'],
      outdir: './public/assets/dist',
      bundle: true,
      minify: true,
      loader: {
        '.css': 'css',
      },
      external: ['/assets/fonts/*', '/assets/images/*'],
      entryNames: '/[name]-[hash]',
      assetNames: '/[name]-[hash]',
      publicPath: '/',
      plugins: [
        clean({
          patterns: ['./public/assets/dist/*']
        })
      ]
    });
    console.log('CSS build complete!');
  } catch (error) {
    console.error('CSS build failed:', error);
    process.exit(1);
  }
}

await buildCSS();
