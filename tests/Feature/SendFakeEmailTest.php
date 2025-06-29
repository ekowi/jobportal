<?php

namespace Tests\Feature;

use App\Mail\TestMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendFakeEmailTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_send_test_email()
    {
        Mail::fake();

        Mail::to('tester_fake@fake.com')->send(new TestMail());

        Mail::assertSent(TestMail::class, function ($mail) {
            return $mail->hasTo('tester_fake@fake.com');
        });
    }
}
