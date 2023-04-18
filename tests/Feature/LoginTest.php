<?php

use App\Mail\MagicLoginLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

it('ensures the email address exists')
    ->post('/auth/login', ['email' => 'alex@codecourse.com'])
    ->assertSessionHasErrors(['email']);

it('ensures the email address is valid')
    ->post('/auth/login', ['email' => 'nope'])
    ->assertSessionHasErrors(['email']);

it('sends a magic link email', function () {
    Mail::fake();

    $user = User::factory()->create(['email' => 'alex@codecourse.com']);

    $this->post('/auth/login', ['email' => $user->email])
        ->assertSessionHas('success');

    Mail::assertSent(MagicLoginLink::class, function (Mailable $mail) use ($user) {
        return $mail->hasTo($user->email);
    });
});
