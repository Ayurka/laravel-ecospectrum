import PNotify from 'pnotify/dist/es/PNotify'
import PNotifyButtons from 'pnotify/dist/es/PNotifyButtons.js'
import PNotifyStyleMaterial from 'pnotify/dist/es/PNotifyStyleMaterial.js'

PNotify.defaults.styling = 'material';
PNotify.defaults.icons = 'material';

export function cart(){
    $('.product-item').on('click', '.btn-to-cart', function(){
        let $this = $(this).closest('.product-item'),
            id = $this.attr('data-id'),
            quantity = $this.find('.product-quantity').val();

        $.ajax({
            url: '/cart/add',
            method: 'GET',
            data: {id: id, quantity: quantity},
            success: function(data){
                PNotify.success({
                    title: 'Успешно!',
                    text: 'Товар успешно добавлен в корзину!',
                    stack: {
                        'dir1': 'down',
                        'firstpos1': 25
                    },
                });
            },
            error: function(data){
                PNotify.error({
                    title: 'Ошибка!',
                    text: 'Произошла ошибка на сервере.',
                    stack: {
                        'dir1': 'down',
                        'firstpos1': 25
                    },
                });
            }
        });
    });

    $('.cart-item').on('input', '.cart-item-quantity', function(){

        let $this = $(this).closest('tr'),
            price = $this.find('.cart-item-price').text(),
            quantity = $(this).val(),
            subtotal = price * quantity;

        $this.find('.cart-item-subtotal').text(subtotal);

    }).on('change', '.cart-item-quantity', function () {

        let id = $(this).closest('.cart-item').attr('data-id'),
            quantity = $(this).val();

        $.ajax({
            url: '/cart/update',
            method: 'GET',
            data: {id: id, quantity: quantity},
            success: function(data){
                console.log('Корзина успешно обновлена');
            },
            error: function(data){
                console.log('Ошибка на сервере');
            }
        });

    }).on('click', '.cart-btn-remove', function () {

        let id = $(this).attr('data-id'),
            $this = $(this).closest('tr'),
            $cart_block = $(this).closest('.cart-block'),
            $count_product = $cart_block.find('tr');

        $.ajax({
            url: 'cart/remove',
            method: 'GET',
            data: {id: id},
            success: function (data) {
                if($count_product.length > 2){
                    $this.remove();
                }else{
                    $cart_block.empty();
                    $cart_block.append("<h3 class='text-center'>Нет товаров в корзине</h3>");
                }
                PNotify.success({
                    title: 'Успешно!',
                    text: 'Товар успешно удален!',
                    stack: {
                        'dir1': 'down',
                        'firstpos1': 25
                    },
                });
            },
            error: function () {
                PNotify.error({
                    title: 'Ошибка!',
                    text: 'Произошла ошибка на сервере',
                    stack: {
                        'dir1': 'down',
                        'firstpos1': 25
                    },
                });
            }
        });
    });
}