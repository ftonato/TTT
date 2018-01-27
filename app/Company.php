<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use JansenFelipe\Utils\Utils as Utils;
use JansenFelipe\Utils\Mask as Mask;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'cnpj'];
    protected $dates = ['deleted_at'];

    public function orders() {
        return $this->hasMany('App\Order');
    }

    public static function getCompaniesToSelectComponent() {
        $data = DB::table('companies')
            ->select('id', 'name')
            ->whereNull('deleted_at')
            ->orderBy('name', 'asc')
            ->get();

        return $data;
    }

    public static function listCompanies($companies) {
        if (count($companies) == 0) {
            $companies = [];
        }

        foreach ($companies as $key => $company) {
        	$companies[$key]->cnpj = Utils::mask($company->cnpj, Mask::CNPJ);
        	$companies[$key]->amountOrders = count($company->orders);
        }

        return $companies;
    }
}
