import path, { resolve } from 'path';

/** @type {import('vite').UserConfig} */
export default {
    server: {
        host: path.basename(__dirname) + '.test'
    },

    build: {
        rollupOptions: {
            input: {
                main: resolve(__dirname, 'index.html'),
                imprint: resolve(__dirname, 'imprint.html'),
                privacy: resolve(__dirname, 'privacy.html'),
            }
        }
    }
}
