<?php

namespace App\Http\Controllers;

use App\Models\NameDay;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class NameDayController extends Controller
{
    /**
     * Instance of NameDay model
     *
     * @var NameDay
     */
    private $nameDay;

    public function __construct()
    {
        $this->nameDay = new NameDay();
    }

    /**
     * Display a listing of the resource.
     *
     * @return object
     */
    public function index()
    {
        $todaysNamesWithCount = $this->nameDay->getTodaysNames();
        $dayOfWeekName = NameDay::DAYS_OF_WEEK[date('N')];

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
     * @param Name $name
     * @return Response
     */
    public function show(Name $name)
    {
        return view('name.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Name $name
     * @return Response
     */
    public function edit(Name $name)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Name $name
     * @return Response
     */
    public function update(Request $request, Name $name)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Name $name
     * @return Response
     */
    public function destroy(Name $name)
    {
        //
    }
}
