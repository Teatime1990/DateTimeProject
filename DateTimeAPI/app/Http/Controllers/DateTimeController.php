<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DateTimeController extends Controller
{
    public function handleData(Request $request, $mode) { //main function to deal with data from client side
        if((!isset($request->firstDate) || !isset($request->secondDate)) && !isset($request->timezone)){
            return response()->json('Lack of parameter.');
        } //validation

        if(isset($request->firstDate)){
            $firstDate =  urldecode($request->firstDate);//get correct format of input
            if (date('Y-m-d H:i:s', strtotime($firstDate)) == $firstDate) {
                $firstDateInCarbon = Carbon::createFromDate($firstDate);
            } else {
                return response()->json('First Date is not valid.');
            }
        }

        if(isset($request->secondDate)){
            $secondDate =  urldecode($request->secondDate);//get correct format of input
            if (date('Y-m-d H:i:s', strtotime($secondDate)) == $secondDate) {
                $secondDateInCarbon = Carbon::createFromDate($secondDate);
            } else {
                return response()->json('Second Date is not valid.');
            }
        }

        if($mode === '1'){
            // find out the number of days between two datetime
            $days = $firstDateInCarbon->diffInDays($secondDateInCarbon, true);//get number of days between two dates
            $result = 'About ' . $days . ($days > 1 ? ' days': ' day') . ' between these two dates.';

            //if the result needs to be transfered, third parameter accepted
            if(isset($request->convert)){
                $convert = $request->convert;
                if($convert == 'seconds'){
                    $second = $days * 24 * 60 * 60;
                    $result .= " In terms of second, it is " . $second . ($second > 1 ? ' seconds.': ' second.');
                } else if($convert == 'minutes') {
                    $minute = $days * 24 * 60;
                    $result .= " In terms of minute, it is " . $minute . ($minute > 1 ? ' minutes.': ' minute.');
                } else if ($convert == 'hours') {
                    $hour = $days * 24;
                    $result .= " In terms of hour, it is " . $hour . ($hour > 1 ? ' hours.': ' hour.');
                } else if ($convert == 'years') {
                    $year = $days / 365;
                    $result .= " In terms of year, it is " . $year . ($year > 1 ? ' years.': ' year.');
                } else {
                    $result = 'Convert type is not correct. Please choose from second, minutes, hours, years.';
                }
            }
        } else if ($mode === '2') {
            //find out the number of weekdays between two datetime
            $days = $firstDateInCarbon->diffInWeekdays($secondDateInCarbon, true);//get number of weekdays between two dates
            $result = 'About ' . $days . ($days > 1 ? ' weekdays': ' weekday') . ' between these two dates.';

            //if the result needs to be transfered, third parameter accepted
            if(isset($request->convert)){
                $convert = $request->convert;
                if($convert == 'seconds'){
                    $second = $days * 24 * 60 * 60;
                    $result .= " In terms of second, it is " . $second . ($second > 1 ? ' seconds.': ' second.');
                } else if($convert == 'minutes') {
                    $minute = $days * 24 * 60;
                    $result .= " In terms of minute, it is " . $minute . ($minute > 1 ? ' minutes.': ' minute.');
                } else if ($convert == 'hours') {
                    $hour = $days * 24;
                    $result .= " In terms of hour, it is " . $hour . ($hour > 1 ? ' hours.': ' hour.');
                } else if ($convert == 'years') {
                    $year = $days / 365;
                    $result .= " In terms of year, it is " . $year . ($year > 1 ? ' years.': ' year.');
                } else {
                    $result = 'Convert type is not correct. Please choose from second, minutes, hours, years.';
                }
            }
        } else if ($mode === '3') {
            //find out the number of complete weeks between two datetime
            $weeks = $firstDateInCarbon->diffInWeeks($secondDateInCarbon, true);//get number of weeks between two dates
            $result = 'About ' . $weeks . ($weeks > 1 ? ' complete weeks': ' complete week') . ' between these two dates.';

            //if the result needs to be transfered, third parameter accepted
            if(isset($request->convert)){
                $convert = $request->convert;
                if($convert == 'seconds'){
                    $second = $weeks * 7 * 24 * 60 * 60;
                    $result .= " In terms of second, it is " . $second . ($second > 1 ? ' seconds.': ' second.');
                } else if($convert == 'minutes') {
                    $minute = $weeks * 7 * 24 * 60;
                    $result .= " In terms of minute, it is " . $minute . ($minute > 1 ? ' minutes.': ' minute.');
                } else if ($convert == 'hours') {
                    $hour = $weeks * 7 * 24;
                    $result .= " In terms of hour, it is " . $hour . ($hour > 1 ? ' hours.': ' hour.');
                } else if ($convert == 'years') {
                    $year = round($weeks * 7 / 365, 2);
                    $result .= " In terms of year, it is " . $year . ($year > 1 ? ' years.': ' year.');
                } else {
                    $result = 'Convert type is not correct. Please choose from second, minutes, hours, years.';
                }
            }
        } else if ($mode === '4') {
            //Allow the specification of a timezone for comparison of input parameters from
            //different timezones.

        }

        return response()->json($result);
    }
}