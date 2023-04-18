<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateUser
{
    use AsAction;

    public function rules()
    {
        return [
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'name' => ['required', 'max:255']
        ];
    }

    public function handle(string $email, string $name)
    {
        return User::create([
            'email' => $email,
            'name' => $name
        ]);
    }

    public function asController(ActionRequest $request, SendMagicLink $sendMagicLink)
    {
        $user = $this->handle($request->email, $request->name);

        $sendMagicLink->handle($user->email);

        return back()->with('success', 'Registered. Check your email address for a login link.');
    }
}
