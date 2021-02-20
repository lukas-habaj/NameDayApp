<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameDay extends Model
{
    use HasFactory;

    const DAYS_OF_WEEK = [
        'Pondelok',
        'Utorok',
        'Streda',
        'Štvrtok',
        'Piatok',
        'Sobota',
        'Nedeľa',
    ];

    /**
     * Returns array of names having nameday today
     *
     * @return array
     */
    public function getTodaysNames(): array
    {
        $monthDay = sprintf('%02s%02s', date('m'), date('d'));
        $todaysNamesArray = $this->where('month_day', $monthDay)->pluck('name')->toArray();
        $todaysNames = implode(' a ', $todaysNamesArray);
        $todaysNamesCount = count($todaysNamesArray);

        return compact('todaysNames', 'todaysNamesCount');
    }
}
