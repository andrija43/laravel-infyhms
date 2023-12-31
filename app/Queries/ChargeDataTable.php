<?php

namespace App\Queries;

use App\Models\Charge;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ChargeDataTable
 */
class ChargeDataTable
{
    /**
     * @return Charge|Builder
     */
    public function get(array $input = [])
    {
        /** @var Charge $query */
        $query = Charge::with('chargeCategory')->select('charges.*');

        $query->when(! empty($input['charge_type']),
            function (Builder $q) use ($input) {
                $q->where('charge_type', $input['charge_type']);
            });

        return $query;
    }
}
