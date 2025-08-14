import { context } from 'esbuild';
import browserSync from 'browser-sync';
import { watch } from 'chokidar';

const bs = browserSync.create();

async function startDevServer() {
  try {
    console.log('Starting esbuild dev server with Browsersync...');

    // Initialize Browsersync to proxy your PHP server
    bs.init({
      proxy: 'denniskoch.dev.test',
      files: ['*.html', '*.php'],
      port: 3000,
      ui: {
        port: 3001
      },
      notify: false,
      open: false,
      injectChanges: true,
      snippetOptions: {
        rule: {
          match: /<\/head>/i,
          fn: function (snippet, match) {
            return snippet + match;
          }
        }
      }
    });

    const ctx = await context({
      entryPoints: ['./public/src/css/main.css'],
      outfile: './public/dist/main.css',
      bundle: true,
      loader: {
        '.css': 'css',
        '.woff2': 'file',
        '.woff': 'file',
        '.ttf': 'file'
      },
      assetNames: './assets/[name]-[hash]',
      publicPath: '/'
    });

    await ctx.watch();
    console.log('Watching for CSS changes...');

    // Watch the output CSS file and trigger injection
    watch('dist/main.css').on('change', () => {
      console.log('CSS file changed, injecting...');
      bs.reload('*.css');
    });

    console.log('Browsersync running at http://localhost:3000');

    // Keep the process running
    process.on('SIGINT', async () => {
      await ctx.dispose();
      bs.exit();
      process.exit(0);
    });

  } catch (error) {
    console.error('Dev server failed:', error);
    process.exit(1);
  }
}

await startDevServer();
