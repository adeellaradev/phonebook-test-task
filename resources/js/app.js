import './bootstrap';
import '../css/app.css';
import * as bootstrap from 'bootstrap/dist/js/bootstrap.bundle';
import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import axios from 'axios';
// Set the CSRF token in the default headers
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', {eager: true})
        return pages[`./Pages/${name}.vue`]
    },
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .provide("bootstrap", bootstrap)
            .use(plugin)
            .mount(el)
    },
}).then(r => {
    console.log("app error: ", r)
});
