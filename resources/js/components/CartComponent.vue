<template>
    <table class="table">
        <thead>
        <tr>
            <th class="text-center">Фото товара</th>
            <th>Название</th>
            <th>Цена (руб.)</th>
            <th>Количество</th>
            <th>Сумма (руб.)</th>
            <th class="text-center">Удалить</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                products: []
            }
        },
        methods: {
            getProducts() {
                return axios
                    .get('/api/cart')
                    .then(response => (response.data));
            }
        },
        mounted() {
            console.log(this.getProducts());
        }
    }
</script>