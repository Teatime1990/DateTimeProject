<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

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
            $firstDateInCarbon = Carbon::createFromDate($firstDate);
        }

        if(isset($request->secondDate)){
            $secondDate =  urldecode($request->secondDate);//get correct format of input
            $test = check_date($secondDate);
            if($test === 0) {
                return response()->json('Second Date is not valid');
            }
            $secondDateInCarbon = Carbon::createFromDate($secondDate);
        }

        if($mode === '1'){
            // find out the number of days between two datetime
            $days = $firstDateInCarbon->diffInDays($secondDateInCarbon, true);//get number of days between two dates
            $result = 'About ' . $days . ($days > 1 ? ' days': ' day') . ' between these two dates';
        } else if ($mode === '2') {
            //find out the number of weekdays between two datetime
            $days = $firstDateInCarbon->diffInWeekdays($secondDateInCarbon, true);//get number of weekdays between two dates
            $result = 'About ' . $days . ($days > 1 ? ' weekdays': ' weekday') . ' between these two dates';
        } else if ($mode === '3') {
            //find out the number of complete weeks between two datetime
            $weeks = $firstDateInCarbon->diffInWeeks($secondDateInCarbon, true);//get number of weeks between two dates
            $result = 'About ' . $weeks . ($weeks > 1 ? ' complete weeks': ' complete week') . ' between these two dates';
        } else if ($mode === '4') {
            //Allow the specification of a timezone for comparison of input parameters from
            //different timezones.

        }

        if(isset($request->convert) && $mode != '4'){// check whether needs to transfer result
            $convert = $request->convert;
            if($convert == 'seconds'){
                $gaps =  $firstDateInCarbon->diffInSeconds($secondDateInCarbon, true);
                $result = 'About ' . $gaps . ($gaps > 1 ? ' seconds': ' second') . ' between these two dates';
            } else if($convert == 'minutes') {
                $gaps =  $firstDateInCarbon->diffInMinutes($secondDateInCarbon, true);
                $result = 'About ' . $gaps . ($gaps > 1 ? ' minutes': ' minute') . ' between these two dates';
            } else if ($convert == 'hours') {
                $gaps =  $firstDateInCarbon->diffInMonths($secondDateInCarbon, true);
                $result = 'About ' . $gaps . ($gaps > 1 ? ' hours': ' hour') . ' between these two dates';
            } else if ($convert == 'years') {
                $gaps =  $firstDateInCarbon->diffInYears($secondDateInCarbon, true);
                $result = 'About ' . $gaps . ($gaps > 1 ? ' years': ' year') . ' between these two dates';
            } else {
                $result = 'Convert type is not correct. Please choose from "second, minutes, hours, years"';
            }
        }
        return response()->json($result);
    }
}