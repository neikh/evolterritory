import Vue from 'vue'
import routes from './routes'
import Datetime from 'vue-datetime'
import VueSweetalert2 from 'vue-sweetalert2';
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css';
import VueImageCompare from 'vue-image-compare';
 
const options = {
  confirmButtonColor: '#343a40',
  cancelButtonColor: '#ff7674'
}
 
Vue.use(VueSweetalert2, options)

Vue.use(Datetime);
Vue.use(VueImageCompare);

require('./bootstrap');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const index = new Vue({
    el: '#index',
    data: {
        currentRoute: window.location.pathname
    },
    computed: {
        ViewComponent () {

            const matchingView = routes[this.currentRoute]
            return matchingView
              ? require('./pages/' + matchingView).default
              : require('./pages/404.vue')
        }
    },
    render (h) {
        return h(this.ViewComponent)
    }
});
