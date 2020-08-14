<?php

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

class BasicTest extends TestCase
{

    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_incorrect_parmaters(){//validation test
        $response = $this->get("/api/DateTimeAPI/1");
        $response->seeStatusCode(200);
    }

    public function test_incorrect_inputs(){
        $response = $this->get("/api/DateTimeAPI/1?firstDate=2020-08-13 00:00:22&secondDate=2020-08-104 12:22:33");
        $response->assertEquals('"Second Date is not valid."',$this->response->getContent());
    }

    public function test_correct_days_between_two_datetime1(){
        $response = $this->get("/api/DateTimeAPI/1?firstDate=2020-08-13 00:00:22&secondDate=2020-08-14 12:22:33");
        $response->assertEquals('"About 1.5 days between these two dates."',$this->response->getContent());
    }

    public function test_correct_days_between_two_datetime2(){
        $response = $this->get("/api/DateTimeAPI/1?firstDate=2020-08-13 00:00:22&secondDate=2020-08-24 12:22:33");
        $response->assertEquals('"About 11.5 days between these two dates."',$this->response->getContent());
    }

    public function test_correct_weekdays_between_two_datetime1(){
        $response = $this->get("/api/DateTimeAPI/2?firstDate=2020-08-13 00:00:22&secondDate=2020-09-14 12:22:33");
        $response->assertEquals('"About 23 weekdays between these two dates."',$this->response->getContent());
    }

    public function test_correct_weekdays_between_two_datetime2(){
        $response = $this->get("/api/DateTimeAPI/2?firstDate=2020-08-13 00:00:22&secondDate=2020-10-15 12:22:33");
        $response->assertEquals('"About 46 weekdays between these two dates."',$this->response->getContent());
    }

    public function test_correct_weeks_between_two_datetime1(){
        $response = $this->get("/api/DateTimeAPI/3?firstDate=2020-08-13 00:00:22&secondDate=2020-08-28 12:22:33");
        $response->assertEquals('"About 2 complete weeks between these two dates."',$this->response->getContent());
    }

    public function test_correct_weeks_between_two_datetime2(){
        $response = $this->get("/api/DateTimeAPI/3?firstDate=2020-08-13 00:00:22&secondDate=2020-03-14 12:22:33");
        $response->assertEquals('"About 21 complete weeks between these two dates."',$this->response->getContent());
    }

    public function test_incorrect_convert_input(){
        $response = $this->get("/api/DateTimeAPI/3?firstDate=2020-08-13 00:00:22&secondDate=2020-03-14 12:22:33&convert=second");
        $response->assertEquals('"Convert type is not correct. Please choose from second, minutes, hours, years."',$this->response->getContent());
    }

    public function test_convert_to_seconds(){
        $response = $this->get("/api/DateTimeAPI/3?firstDate=2020-08-13 00:00:22&secondDate=2020-03-14 12:22:33&convert=seconds");
        $response->assertEquals('"About 21 complete weeks between these two dates. In terms of second, it is 12700800 seconds."',$this->response->getContent());
    }

    public function test_convert_to_minutes(){
        $response = $this->get("/api/DateTimeAPI/2?firstDate=2020-08-13 00:00:22&secondDate=2020-09-14 12:22:33&convert=minutes");
        $response->assertEquals('"About 23 weekdays between these two dates. In terms of minute, it is 33120 minutes."',$this->response->getContent());
    }

    public function test_convert_to_hours(){
        $response = $this->get("/api/DateTimeAPI/1?firstDate=2020-08-13 00:00:22&secondDate=2020-10-04 12:42:33&convert=hours");
        $response->assertEquals('"About 52.5 days between these two dates. In terms of hour, it is 1260 hours."',$this->response->getContent());
    }

    public function test_convert_to_years(){
        $response = $this->get("/api/DateTimeAPI/3?firstDate=2020-08-13 00:00:22&secondDate=2025-03-14 12:22:33&convert=years");
        $response->assertEquals('"About 239 complete weeks between these two dates. In terms of year, it is 4.58 years."',$this->response->getContent());
    }

    public function test_days_between_two_datetime_from_different_timezone_AEST_PST(){
        $response = $this->get("/api/DateTimeAPI/4?firstDate=2020-08-03 10:00:00&secondDate=2020-08-04 23:00:00&firstTimeZone=AEST&secondTimeZone=PST");
        $response->assertEquals('"About 55 hours between these two dates in different timezone."',$this->response->getContent());
    }

    public function test_days_between_two_datetime_from_different_timezone_AEST_PDT(){
        $response = $this->get("/api/DateTimeAPI/4?firstDate=2020-08-03 10:00:00&secondDate=2020-08-04 23:00:00&firstTimeZone=AEST&secondTimeZone=PDT");
        $response->assertEquals('"About 54 hours between these two dates in different timezone."',$this->response->getContent());
    }

    public function test_wrong_timezone(){
        $response = $this->get("/api/DateTimeAPI/4?firstDate=2020-08-03 10:00:00&secondDate=2020-08-04 23:00:00&firstTimeZone=AEST&secondTimeZone=PDTT");
        $response->seeStatusCode(500);
    }
}