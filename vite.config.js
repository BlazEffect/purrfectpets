import {fileURLToPath, URL} from 'node:url'

import {defineConfig} from 'vite'
import vue from '@vitejs/plugin-vue'
import 'dotenv/config'

export default defineConfig({
  plugins: [vue()],
  server: {
    host: process.env.SERVER_IP,
    port: process.env.SERVER_PORT,
    proxy: {
      '/api': {
        target: process.env.API_SERVER_URL,
        changeOrigin: true,
      }
    }
  },
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  }
})
