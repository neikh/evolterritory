import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import routes from './routes';
import Datetime from 'vue-datetime';
import VueSweetalert2 from 'vue-sweetalert2';
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css';
import VueImageCompare from 'vue-image-compare';
import KonamiCode from 'vue-konami-code';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import Tabs from 'bootstrap-vue/es/components/tabs';

const options = {
  confirmButtonColor: '#343a40',
  cancelButtonColor: '#ff7674'
};

Vue.use(VueSweetalert2, options);

Vue.use(Datetime);
Vue.use(VueImageCompare);
Vue.use(Tabs);
Vue.use(KonamiCode, {callback: function () {
    Vue.swal.fire({
        html:
        '<iframe id="inlineFrameExample"' +
        'title="Inline Frame Example"' +
        'width="1600"' +
        'height="750"' +
        'src="snake/index.html">' +
        '</iframe>',
        showConfirmButton: false,
        width: 1920,
        height: 1080
    })
}})

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
