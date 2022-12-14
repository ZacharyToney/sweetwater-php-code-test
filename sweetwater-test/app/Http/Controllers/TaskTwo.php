<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class TaskTwo extends Controller
{
    public function index()
    {
        $sweetwater_test = DB::table('sweetwater_test')->get();
        foreach ($sweetwater_test as $record){
            //if date is in comments
            //dd($record->comments);
            if(str_contains(strtolower($record->comments),'expected ship date')){
                if(date_parse($record->comments)){
                    //get date from string
                    $dateFromString = date_parse($record->comments);
                    $year = $dateFromString['year'] ?: '';
                    if(empty($year)){
                        continue;
                    }
                    $month = $dateFromString['month'] ?: '';
                    if(empty($month)){
                        continue;
                    }
                    $day = $dateFromString['day'] ?: '';
                    if(empty($day)){
                        continue;
                    }
                    //sql wants YYYYMMDD
                    $record->shipdate_expected = "$year$month$day";
                    try {
                        DB::update("update sweetwater_test set shipdate_expected = '$year-$month-$day' where orderid = ?",[$record->orderid]);
                    }
                    catch (\Exception $e){
                        continue;
                    }

                }
            }
        }
        return view('task2');
    }
}
