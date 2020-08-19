<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class LegalEntity extends Model
{
    protected $table = 'legal_entities';

    protected $fillable = [
        'name_company', 'address', 'inn', 'kpp', 'ogrn'
    ];

    /**
     * Получить всех физических лиц.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function users()
    {
        return $this->morphMany('App\User', 'usertable');
    }

    /**
     * Получить физического лица
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function user()
    {
        return $this->morphOne('App\User', 'usertable');
    }
}
