<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Income
 *
 * @property int $id
 * @property string $income_head
 * @property string $name
 * @property string|null $invoice_number
 * @property \Illuminate\Support\Carbon $date
 * @property float $amount
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $document_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereIncomeHead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Income extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'incomes';

    const PATH = 'income';

    const INCOME_HEAD = [
        1 => 'Canteen Rent',
        2 => 'Hospital Charges',
        3 => 'Special Campaign',
        4 => 'Vehicle Stand Charges',
    ];

    const FILTER_INCOME_HEAD = [
        0 => 'All',
        2 => 'Hospital Charges',
        3 => 'Special Campaign',
        1 => 'Canteen Rent',
        4 => 'Vehicle Stand Charges',
    ];

    public $fillable = [
        'income_head',
        'name',
        'date',
        'currency_symbol',
        'invoice_number',
        'amount',
        'description',
    ];

    protected $casts = [
        'id' => 'integer',
        'income_head' => 'integer',
        'name' => 'string',
        'date' => 'date',
        'invoice_number' => 'string',
        'amount' => 'double',
        'description' => 'string',
        'currency_symbol' => 'string',
    ];

    public static $rules = [
        'income_head' => 'required|string',
        'name' => 'required|unique:incomes,name|string',
        'date' => 'required|date',
        'invoice_number' => 'string|nullable',
        'amount' => 'required',
        'description' => 'string|nullable',
    ];

    protected $appends = ['document_url'];

    public function getDocumentUrlAttribute()
    {
        $media = $this->media->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return '';
    }

    public function UserRole()
    {
        $roles = Department::orderBy('name')->pluck('name', 'id')->toArray();
    }
}
