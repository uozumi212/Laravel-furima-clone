// import './bootstrap';

import { creteApp } from "vue/dist/vue.esm-bundler";
const counter = {
    data() {
        return {
            counter: 0.
        };
    },
    mounted() {
        setInterval(() => {
            this.counter++;
        }, 1000);
    },
};
createApp(Counter).mount("#counter");


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
