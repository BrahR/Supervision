// import './assets/main.css'
import './style.css'

// @ts-ignore
import App from './App.vue'
import router from './router'
import { createApp } from 'vue'
import { createPinia } from 'pinia'

import GridLayout from 'vue3-drr-grid-layout'
import 'vue3-drr-grid-layout/dist/style.css'

import Toast, { POSITION } from "vue-toastification";
import type { PluginOptions } from 'vue-toastification'
import 'vue-toastification/dist/index.css'

import 'vue-skeletor/dist/vue-skeletor.css';

const options: PluginOptions = {
  transition: "Vue-Toastification__fade",
  maxToasts: 20,
  newestOnTop: true,
  position: POSITION.TOP_CENTER,
  timeout: 4000,
  closeOnClick: true,
  pauseOnFocusLoss: true,
  pauseOnHover: true,
  draggable: true,
  draggablePercent: 0.3,
  showCloseButtonOnHover: true,
  hideProgressBar: false,
  closeButton: "button",
  icon: true,
}

const app = createApp(App)
  .use(GridLayout)
  .use(createPinia())
  .use(router)
  .use(Toast, options)
  .mount('#app')
