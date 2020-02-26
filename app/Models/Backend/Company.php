<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    protected $fillable = [
        'user_id', 'nameCompany', 'address', 'inn', 'kpp', 'nameBank', 'bik', 'paymentAccount', 'correlationAccount'
    ];

    /**
     * Get user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
