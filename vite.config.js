import {defineConfig} from 'vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'

const path = require('path')

// https://vitejs.dev/config/
export default defineConfig({
    // root: 'resources/js',
    // build: {
    //     outDir: '../../public'
    // },
    plugins: [
        laravel([
            'resources/js/main.js'
        ]),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false
                }
            }
        })
    ],
    // rollupOutputOptions: {
    //     entryFileNames: '[name].js',
    // },
    resolve: {
        extensions: ['.mjs', '.js', '.ts', '.jsx', '.tsx', '.json', '.vue'],
        alias: {
            "@": path.resolve(__dirname, "./resources/js"),
            '~': path.resolve(__dirname, "./node_modules"),
            'public': path.resolve(__dirname, "./public")
        }
    }
})
