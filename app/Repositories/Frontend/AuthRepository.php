<?php

namespace App\Repositories\Frontend;

use App\Models\Backend\Individual;
use App\Models\Backend\LegalEntity;
use App\User;
use Illuminate\Support\Facades\DB;

class AuthRepository
{
    protected $user;
    protected $individual;
    protected $legalEntity;
    protected $company;

    /**
     * AuthRepository constructor.
     * @param Individual $individual
     * @param LegalEntity $legalEntity
     */
    public function __construct(Individual $individual, LegalEntity $legalEntity)
    {
        $this->individual = $individual;
        $this->legalEntity = $legalEntity;
    }

    /**
     * Сохраняем нового пользователя и компанию
     *
     * @param $request
     * @return User $user
     */
    public function storeUserAndCompany($request)
    {
        DB::transaction(function () use ($request) {

            if ($request->get('typeCompany') === 'ИП') {
                $this->company = $this->individual->create([
                    'name_company' => $request->get('company')['nameCompany'],
                    'address' => $request->get('company')['address'],
                    'inn' => $request->get('company')['inn'],
                    'ogrnip' => $request->get('company')['ogrnip']
                ]);
            } else {
                $this->company = $this->legalEntity->create([
                    'name_company' => $request->get('company')['nameCompany'],
                    'address' => $request->get('company')['address'],
                    'inn' => $request->get('company')['inn'],
                    'kpp' => $request->get('company')['kpp'],
                    'ogrn' => $request->get('company')['ogrn']
                ]);
            }

            $this->user = $this->company->user()->create([
                'type_company' => $request->get('typeCompany'),
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'password' => bcrypt($request->get('password'))
            ]);
        });

        return $this->user;
    }
}
