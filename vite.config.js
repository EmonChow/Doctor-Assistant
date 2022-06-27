import {defineConfig} from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
    root: 'resources/js',
    build: {
        outDir: '../../public'
    },
    plugins: [vue()],
    rollupOutputOptions: {
        entryFileNames: '[name].js',
    }
})
