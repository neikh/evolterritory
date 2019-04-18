import Vue from 'vue'
import routes from './routes'
import Datetime from 'vue-datetime'
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css';
import VueImageCompare from 'vue-image-compare';

Vue.use(Datetime);
Vue.use(VueImageCompare);

require('./bootstrap');

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
