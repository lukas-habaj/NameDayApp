<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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

    /**
     * Retrieves from DB record by name, adds formated date and returns the collection
     *
     * @param string $name
     * @return mixed
     */
    public function getByName(string $name)
    {
        $nameData = $this->where('name', $name)->first();

        $month = ltrim(substr($nameData->month_day, 0, 2), '\0');
        $day = ltrim(substr($nameData->month_day, 2, 2), '\0');

        $nameData->date = $day . '. ' . $month . '.';

        return $nameData;
    }

    public function getAllNames()
    {
        $allNames = Cache::get('all_names');

        if ($allNames) {
            return $allNames;
        }

        $allNames = $this->pluck('name')->toJson();
        Cache::put('all_names', $allNames);

        return $allNames;
    }
}
