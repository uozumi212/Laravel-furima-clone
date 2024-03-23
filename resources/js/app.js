// // import './bootstrap';
//
// import { creteApp } from "vue/dist/vue.esm-bundler";
// const counter = {
//     data() {
//         return {
//             counter: 0.
//         };
//     },
//     mounted() {
//         setInterval(() => {
//             this.counter++;
//         }, 1000);
//     },
// };
// createApp(Counter).mount("#counter");
//
//
// import Alpine from 'alpinejs';
//
// window.Alpine = Alpine;
//
// Alpine.start();
// require('./bootstrap.js');
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import StarIcon from './components/StarIcon.vue';
import axios from 'axios';

// new Vue({
//     el: '#app',
//     components: {
//         StarIcon,
//     },
// });

// Vue アプリケーションを作成し、Vue コンポーネントを登録します
const app = createApp({});

app.component('example-component', ExampleComponent);
app.component('star-icon', StarIcon);


// Vue アプリケーションをマウントします
app.mount('#app');

// require('./bootstrap');
//
//
// Vue.component('test-component', require('./components/TestComponent.vue').default);
//
// import ExampleComponent from "./components/ExampleComponent";
// createApp({
//     components: {"example-component": ExampleComponent}
// }).mount('#app')
