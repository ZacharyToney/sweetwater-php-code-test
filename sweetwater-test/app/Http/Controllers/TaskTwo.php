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
            $loweredComments = strtolower($record->comments);
            if(str_contains($loweredComments,'expected ship date')){
                $commentSplit = explode('expected ship date',$loweredComments);
                foreach ($commentSplit as $split){
                    if(date_parse($split)){
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
                        try {
                            DB::update("update sweetwater_test set shipdate_expected = '$year-$month-$day' where orderid = ?",[$record->orderid]);
                        }
                        catch (\Exception $e){
                            continue;
                        }
                    }
                }
            }
        }
        return view('task2');
    }
}
