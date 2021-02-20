<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\NameDay;

class ImportNameDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'name-days:update {timeZone=Europe/Prague} {country=sk}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieving names with their dates from api.abalin.net and inserting them into database';

    /**
     * Time zones supported by the api.abalin.net API
     *
     * @var array
     */
    const AVAILABLE_TIME_ZONES = [
        'America/Denver',
        'America/Costa_Rica',
        'America/Los_Angeles',
        'America/St_Vincent',
        'America/Toronto',
        'Europe/Amsterdam',
        'Europe/Monaco',
        'Europe/Prague',
        'Europe/Isle_of_Man',
        'Africa/Cairo',
        'Africa/Johannesburg',
        'Africa/Nairobi',
        'Asia/Yakutsk',
        'Asia/Hong_Kong',
        'Asia/Taipei',
        'Pacific/Midway',
        'Pacific/Honolulu',
        'Etc/GMT-6',
        'US/Samoa',
        'Zulu',
        'US/Hawaii',
        'Israel',
        'Etc/GMT-2',
    ];

    /**
     * Country codes supported by the api.abalin.net API
     *
     * @var array
     */
    const AVAILABLE_COUNTRIES = ['cz', 'sk', 'pl', 'fr', 'hu', 'hr', 'se', 'us', 'at', 'it', 'es', 'de', 'dk', 'fi', 'bg', 'lt', 'ee', 'lv', 'gr', 'ru'];

    /**
     * Numbers of days in each month
     *
     * @var array
     */
    const MONTHLY_DAY_COUNTS = [
        1 => 31,
        2 => 29,
        3 => 31,
        4 => 30,
        5 => 31,
        6 => 30,
        7 => 31,
        8 => 31,
        9 => 30,
        10 => 31,
        11 => 30,
        12 => 31,
    ];


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $timeZone = $this->argument('timeZone');
        if (!in_array($timeZone, self::AVAILABLE_TIME_ZONES)) {
            echo 'Error: Invalid first argument (time zone). Valid time zones are: ' . implode(', ', self::AVAILABLE_TIME_ZONES);
            return 1;
        }

        $country = $this->argument('country');
        if (!in_array($country, self::AVAILABLE_COUNTRIES)) {
            echo 'Error: Invalid second argument (country code). Valid country codes are: ' . implode(', ', self::AVAILABLE_COUNTRIES);
            return 2;
        }

        $nameDayArr = [];

        try {
            foreach (self::MONTHLY_DAY_COUNTS as $month => $dayCount) {
                for ($day = 1; $day <= $dayCount; $day++) {
                    $response = Http::get('https://api.abalin.net/namedays?' . $timeZone . '&country=' . $country . '&month=' . $month . '&day=' . $day);
                    $data = $response->json('data');

                    if (is_array($data['dates']) && is_array($data['namedays'])) {
                        $namesOfTheDay = explode(', ', $data['namedays'][$country]);

                        foreach ($namesOfTheDay as $name) {
                            $nameDayArr[] = [
                                'name' => $name,
                                'month_day' => sprintf("%02s%02s", $month, $day),
                            ];
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            return 3;
        }

        if (count($nameDayArr) > 0) {
            try {
                DB::table('name_days')->truncate();
                NameDay::insert($nameDayArr);
            } catch (\Exception $e) {
                echo $e->getMessage();
                return 4;
            }
        }

        echo 'Import successful';
        return 0;
    }
}
