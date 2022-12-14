<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskOne extends Controller
{
    public function index()
    {


        $commentsAboutCandy = [];
        $commentsAboutCalls = [];
        $commentsAboutReferredMe = [];
        $commentsAboutSignatureRequirementsUponDelivery = [];
        $commentsAboutMiscellaneousComments = [];

        $sweetwater_test = DB::table('sweetwater_test')->get();
        foreach ($sweetwater_test as $record){
            //Comments about candy
            if(str_contains(strtolower($record->comments),'candy')){
                $commentsAboutCandy[] = $record;
            }
            //Comments about call me / don't call me
            elseif(str_contains(strtolower($record->comments),'call me') || str_contains(strtolower($record->comments),"don't call me")){
                $commentsAboutCalls[] = $record;
            }
            //Comments about who referred me
            elseif(str_contains(strtolower($record->comments),'referred')){
                $commentsAboutReferredMe[] = $record;
            }
            //Comments about signature requirements upon delivery
            elseif(str_contains(strtolower($record->comments),'signature')){
                $commentsAboutSignatureRequirementsUponDelivery[] = $record;
            }
            //Miscellaneous comments (everything else)
            else{
                $commentsAboutMiscellaneousComments[] = $record;
            }
        }
        return view('task1',
            [
                'commentsAboutCandy'=>$commentsAboutCandy,
                'commentsAboutCalls'=>$commentsAboutCalls,
                'commentsAboutReferredMe'=>$commentsAboutReferredMe,
                'commentsAboutSignatureRequirementsUponDelivery'=>$commentsAboutSignatureRequirementsUponDelivery,
                'commentsAboutMiscellaneousComments'=>$commentsAboutMiscellaneousComments
            ]
        );
    }
}
