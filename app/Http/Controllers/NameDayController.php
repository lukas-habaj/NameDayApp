<?php

namespace App\Http\Controllers;

use App\Models\NameDay;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class NameDayController extends Controller
{
    /**
     * Instance of NameDay model
     *
     * @var NameDay
     */
    private NameDay $nameDay;

    public function __construct()
    {
        $this->nameDay = new NameDay();
        View::share( 'allNames', $this->nameDay->getAllNames());
    }

    /**
     * Display a listing of the resource.
     *
     * @return object
     */
    public function index(): object
    {
        $todaysNamesWithCount = $this->nameDay->getTodaysNames();
        $dayOfWeekName = NameDay::DAYS_OF_WEEK[date('N') - 1];

        return view('name_day.index', compact('todaysNamesWithCount', 'dayOfWeekName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param string $name
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $name)
    {
        $nameData = $this->nameDay->getByName($name);

        return view('name_day.show', compact('nameData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param NameDay $nameDay
     * @return Response
     */
    public function edit(NameDay $nameDay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param NameDay $nameDay
     * @return Response
     */
    public function update(Request $request, NameDay $nameDay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param NameDay $nameDay
     * @return Response
     */
    public function destroy(NameDay $nameDay)
    {
        //
    }

    /**
     * Vyhlada v databaze mena vyhovujuce query z ajax requestu
     *
     * @param Request $request
     * @return array
     */
    public function nameSearch(Request $request)
    {
        return NameDay::where('name', 'like', '%' . $request->query('q') . '%')->pluck('name')->toArray();
    }


}
