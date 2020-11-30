<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use DateTime;
use Log;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events = json_decode($request->input("event"), TRUE);
        if ( !empty($events) ){
            $from = (string)$events['startDate'];
            $to = (string)$events['endDate'];
            $schedules = Schedule::where('start', '>=', $from)->where('end', '<=', $to)->get();
        }else{
            $schedules = Schedule::all();
        }
        
        return response()->json($schedules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            
        ]);
        $weekInterval = (int)$request['weekInterval'];
        if ( $weekInterval == 1){
            return Schedule::create([
                'foundation_id' => 1,
                'title'     => $request['title'],
                'content'   => $request['content'],
                'start'     => $request['startDate'].' '.$request['startTime'],
                'end'       => $request['startDate'].' '.$request['endTime'],
                'recurrence' => 1
            ]);
        }
        $weekDays = 0;
        for ($i = 1; $i <= $weekInterval; $i++ ){
            $addDays = "+".$weekDays." days";
            Schedule::create([
                'foundation_id' => 1,
                'title'     => $request['title'],
                'content'   => $request['content'],
                'start'     => date('Y-m-d H:i:s',strtotime($addDays,strtotime($request['startDate'].' '.$request['startTime']))),
                'end'       => date('Y-m-d H:i:s',strtotime($addDays,strtotime($request['startDate'].' '.$request['endTime']))),
                'recurrence' => 1
            ]);
            $weekDays = ($weekDays + 7);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
