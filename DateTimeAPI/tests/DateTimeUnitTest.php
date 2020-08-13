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

    public function test_correct_days_between_two_datetime(){
        $response = $this->get("/api/DateTimeAPI/1?firstDate=2020-08-13 00:00:22&secondDate=2020-08-14 12:22:33&mode=1");
        $response->assertEquals('"About 2 days between these two dates"',$this->response->getContent());
    }
}
