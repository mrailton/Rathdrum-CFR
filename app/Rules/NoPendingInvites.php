<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\Invite;
use Closure;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class NoPendingInvites implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     */
    public function __invoke(string $attribute, mixed $value, Closure $fail): void
    {
        $existing = Invite::query()->where('email', '=', $value)->where('expires_at', '>', now())->first();

        if ($existing) {
            $fail('This email address is used in a pending invite');
        }
    }
}
