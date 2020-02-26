import $ from 'jquery'
import 'bootstrap/dist/js/bootstrap.min.js'
import 'slick-carousel/slick/slick.min.js'
import '@fortawesome/fontawesome-free/js/all.min.js'
import {menu} from './menu'
import {cart} from './cart'
import {slick} from './slick'

window.$ = window.jQuery = $;

$(function(){

    menu();
    slick();
    cart();

});