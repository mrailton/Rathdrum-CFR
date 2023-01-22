<?php

declare(strict_types=1);

namespace App\Http\Requests\Defibs\Notes;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Http\FormRequest;

class StoreDefibNoteRequest extends FormRequest
{
    public function __construct(private readonly Authenticatable $user)
    {
        parent::__construct();
    }

    public function authorize(): bool
    {
        return $this->user->can('defib.note');
    }

    public function rules(): array
    {
        return [
            'note' => ['required', 'string'],
        ];
    }
}
