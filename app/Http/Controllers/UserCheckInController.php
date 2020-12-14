<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\UserCheckInLog;
use Illuminate\Support\Arr;

class UserCheckInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $time = Carbon::now()->format('Y-m-d');
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d'); //这月开始时间
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d'); //这月开始时间
        $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d'); //这周开始时间紧
        $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d'); //这周结束时间
        $arr['y'.Carbon::parse($startOfWeek)->format('Ynj')] =0;
        for ($i = 1; $i <= 6; $i++) {
            $arr['y'.Carbon::parse($startOfWeek)->addDays($i)->format('Ynj')] = 0;
        }
        $userCheckInLog=UserCheckInLog::query()->select('year','month','day')->get();
        $arr2=$userCheckInLog->mapWithKeys(function ($item){
            return ['y'.$item['year'].$item['month'].$item['day']=>1];
        })->toArray();
        $arr3=array_merge($arr,$arr2);
        return $arr3;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $time = Carbon::now();
        $year=$time->format('Y');
        $month=$time->format('n');
        $day=$time->format('j');
        $userCheckInLogCount=UserCheckInLog::query()->ofYear($year)->ofMonth($month)->ofDay($day)->count();
        if ($userCheckInLogCount==0) {
            $userCheckInLog = new UserCheckInLog();
            $userCheckInLog->year = $year;
            $userCheckInLog->month = $month;
            $userCheckInLog->day = $day;
            $userCheckInLog->user_id = 1;
            $userCheckInLog->save();
            return '添加成功！';
        }else{
            return '添加失败！';
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
