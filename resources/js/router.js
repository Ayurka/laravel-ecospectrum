import VueRouter from 'vue-router';
import Cart from './components/CartComponent.vue';

export default new VueRouter({
    routes: [
        {
            'path' : '/cart',
            'components' : Cart
        }
    ]
});