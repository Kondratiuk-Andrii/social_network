import { autoAnimatePlugin } from '@formkit/auto-animate/vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { OhVueIcon, addIcons } from 'oh-vue-icons';
import * as MdIcons from 'oh-vue-icons/icons/md';
import { createPinia } from 'pinia';
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
import { DefineComponent, createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/src/js';
import '../css/app.css';
import './bootstrap';

const Md = Object.values({ ...MdIcons });
addIcons(...Md);

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./Pages/**/*.vue')
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(autoAnimatePlugin)
            .use(pinia)
            .component('v-icon', OhVueIcon)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
