<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'quantity', 'total', 'delivery_address', 'status'
    ];

    const STATUS = [
        1 => 'Новый',
        2 => 'В обработке',
        3 => 'Ожидание оплаты',
        4 => 'Товар в пути',
        5 => 'Завершён',
        6 => 'Отменен'
    ];

    /**
     * Получаем товары
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Backend\Product', 'order_products', 'order_id', 'product_id')->withPivot('quantity');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
