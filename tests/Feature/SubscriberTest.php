<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriberTest extends TestCase
{
    //test the application can receive messages

    public function test_authenticated_user_can_publish_messages()
    {

        $response = $this->post('/api/v1/subscriber/receive', [
            'created_at' => "2022-01-01",
            'message' => 'test message',
        ]);

        $response->assertStatus(200);
        $this->assertEquals(true, $response['success']);
        $this->assertEquals("Message received successfully", $response['message']);
    }
}
