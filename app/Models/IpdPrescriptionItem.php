<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class IpdPrescriptionItem
 *
 * @version September 10, 2020, 11:42 am UTC
 *
 * @property int $ipd_prescription_id
 * @property int $category_id
 * @property int $medicine_id
 * @property string $dosage
 * @property string $instruction
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereDosage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereInstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereIpdPrescriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereMedicineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 *
 * @property-read Medicine $medicine
 * @property-read Category $medicineCategory
 */
class IpdPrescriptionItem extends Model
{
    public $table = 'ipd_prescription_items';

    public $fillable = [
        'ipd_prescription_id',
        'category_id',
        'medicine_id',
        'dosage',
        'dose_interval',
        'day',
        'time',
        'instruction',
    ];

    protected $casts = [
        'id' => 'integer',
        'ipd_prescription_id' => 'integer',
        'category_id' => 'integer',
        'medicine_id' => 'integer',
        'dosage' => 'string',
        'dose_interval' => 'string',
        'day' => 'string',
        'time' => 'string',
        'instruction' => 'string',
    ];

    public static $rules = [
        'category_id' => 'required',
    ];

    public function medicineCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}
