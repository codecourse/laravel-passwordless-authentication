<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class SendMagicLink
{
    use AsAction;

    public function rules()
    {
        return [
            'email' => ['required', 'email', Rule::exists(User::class, 'email')]
        ];
    }

    public function handle(string $email)
    {
        dd('send email', $email);
    }

    public function asController(ActionRequest $request)
    {
        $this->handle($request->email);
    }
}
