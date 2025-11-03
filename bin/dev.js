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
      entryPoints: ['./resources/assets/css/_main.css'],
      outfile: './public/assets/main.css',
      bundle: true,
      loader: {
        '.css': 'css'
      },
      external: ['/assets/fonts/*', '/assets/images/*'],
      assetNames: '/[name]-[hash]',
      publicPath: '/',
    });

    const ctxJS = await context({
      entryPoints: ['./resources/assets/js/main.js'],
      outfile: './public/assets/main.js',
      bundle: true,
      format: 'iife',
      target: ['es2020'],
      define: {
        'process.env.NODE_ENV': '"development"'
      },
      external: ['/assets/fonts/*', '/assets/images/*'],
      assetNames: '/[name]-[hash]',
      publicPath: '/',
    });

    await Promise.all([ctx.watch(), ctxJS.watch()]);
    console.log('Watching for CSS changes...');

    watch('./public/assets/*.css').on('change', () => {
      console.log('CSS file changed, injecting...');
      bs.reload('*.css');
    });
    watch('./public/assets/*.js').on('change', () => {
      console.log('JS file changed, injecting...');
      bs.reload('*.js');
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
