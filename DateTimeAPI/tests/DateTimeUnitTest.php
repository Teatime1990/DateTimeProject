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
        $response->assertEquals('"Second Date is not valid"',$this->response->getContent());
    }

    public function test_correct_days_between_two_datetime1(){
        $response = $this->get("/api/DateTimeAPI/1?firstDate=2020-08-13 00:00:22&secondDate=2020-08-14 12:22:33");
        $response->assertEquals('"About 1 day between these two dates"',$this->response->getContent());
    }

    public function test_correct_days_between_two_datetime2(){
        $response = $this->get("/api/DateTimeAPI/1?firstDate=2020-08-13 00:00:22&secondDate=2020-08-24 12:22:33");
        $response->assertEquals('"About 11 days between these two dates"',$this->response->getContent());
    }

    public function test_correct_weekdays_between_two_datetime1(){
        $response = $this->get("/api/DateTimeAPI/2?firstDate=2020-08-13 00:00:22&secondDate=2020-09-14 12:22:33");
        $response->assertEquals('"About 23 weekdays between these two dates"',$this->response->getContent());
    }

    public function test_correct_weekdays_between_two_datetime2(){
        $response = $this->get("/api/DateTimeAPI/2?firstDate=2020-08-13 00:00:22&secondDate=2020-10-15 12:22:33");
        $response->assertEquals('"About 46 weekdays between these two dates"',$this->response->getContent());
    }

    public function test_correct_weeks_between_two_datetime1(){
        $response = $this->get("/api/DateTimeAPI/3?firstDate=2020-08-13 00:00:22&secondDate=2020-08-28 12:22:33");
        $response->assertEquals('"About 2 complete weeks between these two dates"',$this->response->getContent());
    }

    public function test_correct_weeks_between_two_datetime2(){
        $response = $this->get("/api/DateTimeAPI/3?firstDate=2020-08-13 00:00:22&secondDate=2020-03-14 12:22:33");
        $response->assertEquals('"About 21 complete weeks between these two dates"',$this->response->getContent());
    }

    public function test_incorrect_convert_input(){
        $response = $this->get("/api/DateTimeAPI/3?firstDate=2020-08-13 00:00:22&secondDate=2020-03-14 12:22:33&convert=second");
        $response->assertEquals('"Convert type is not correct. Please choose from second, minutes, hours, years"',$this->response->getContent());
    }

    public function test_convert_to_seconds(){
        $response = $this->get("/api/DateTimeAPI/3?firstDate=2020-08-13 00:00:22&secondDate=2020-03-14 12:22:33&convert=seconds");
        $response->assertEquals('"About 13088269 seconds between these two dates"',$this->response->getContent());
    }

    public function test_convert_to_minutes(){
        $response = $this->get("/api/DateTimeAPI/3?firstDate=2020-08-13 00:00:22&secondDate=2020-09-14 12:22:33&convert=minutes");
        $response->assertEquals('"About 46822 minutes between these two dates"',$this->response->getContent());
    }

    public function test_convert_to_hours(){
        $response = $this->get("/api/DateTimeAPI/3?firstDate=2020-08-13 00:00:22&secondDate=2020-10-04 12:42:33&convert=hours");
        $response->assertEquals('"About 1260 hours between these two dates"',$this->response->getContent());
    }

    public function test_convert_to_years(){
        $response = $this->get("/api/DateTimeAPI/3?firstDate=2020-08-13 00:00:22&secondDate=2025-03-14 12:22:33&convert=years");
        $response->assertEquals('"About 4 years between these two dates"',$this->response->getContent());
    }
}