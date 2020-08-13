<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DateTimeController extends Controller
{
    /**
     * DatetimeController
     */
    public function __construct()
    {
        //
    }



    public function handleData(Request $request, $mode) { //main function to deal with data from client side
        if((!isset($request->firstDate) || !isset($request->secondDate)) && !isset($request->timezone)){
            $message = 'Lack of parameter';
            return response()->json($message);
        } //validation

        function check_date($input){// check if an input is a valid date
            if(date('Y-m-d H:i:s', strtotime($input)) ==  $input) {
                return 1; //is a valid date
            } else {
                return 0; //not a valid date
            }
        }

        if(isset($request->firstDate)){
            $firstDate =  urldecode($request->firstDate);//get correct format of input
            $test = check_date($firstDate);
            if($test === 0) {
                return response()->json('First Date is not valid');
            }
        }


        if(isset($request->secondDate)){
            $secondDate =  urldecode($request->secondDate);//get correct format of input
            $test = check_date($secondDate);
            if($test === 0) {
                return response()->json('Second Date is not valid');
            }
        }

        if(isset($request->convert)){
            $convert = $request->convert;
        }


        if($mode === '1'){
            // find out the number of days between two datetime

            $days = round((strtotime($firstDate) - (strtotime($secondDate)) )/ 3600 / 24);

            $result = 'About ' . abs($days) . (abs($days) > 1 ? ' days': ' day') . ' between these two dates';

            return response()->json($result);

        } else if ($mode === '2') {
            //find out the number of weekdays between two datetime

        } else if ($mode === '3') {
            //find out the number of complete weeks between two datetime

        } else if ($mode === '4') {
            //Allow the specification of a timezone for comparison of input parameters from
            //different timezones.

        }


    }



    //
}
