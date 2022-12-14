<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class TaskTwo extends Controller
{
    public function index()
    {
        $sweetwaterTest = DB::table('sweetwater_test')->get();
        foreach ($sweetwaterTest as $record){
            //if date is in comments
            $loweredComments = strtolower($record->comments);
            if(str_contains($loweredComments,'expected ship date')){
                $commentSplit = explode('expected ship date',$loweredComments);
                if(isset($commentSplit[1])){
                    if (str_contains($commentSplit[1],':')){
                        $commentSplit[1] = ltrim($commentSplit[1],':');
                    }
                    $commentSplit[1] = trim($commentSplit[1]);
                    if(date_parse($commentSplit[1])){
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
                            //dd($year,$month,$day,$record->comments,$commentSplit,$commentSplit[1],$dateFromString,$record->orderid);
                            continue;
                        }
                    }
                }
            }
        }
        return view('task2');
    }
}
