import Vue from 'vue'
import routes from './routes'

import VueImageCompare from 'vue-image-compare';

Vue.use(VueImageCompare);

require('./bootstrap');

console.log(Vue.http);
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
