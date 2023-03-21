<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Defibs\Notes\StoreDefibNoteRequest;
use App\Models\Defib;
use App\Models\DefibNote;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DefibNoteController extends Controller
{
    public function create(Request $request, Defib $defib): View
    {
        return view('defibs.notes.create', ['defib' => $defib]);
    }

    public function store(StoreDefibNoteRequest $request, Defib $defib): RedirectResponse
    {
        $note = new DefibNote($request->validated());
        $note->defib_id = $defib->id;
        $note->user_id = auth()->user()->id;
        $note->save();

        return redirect()->route('defibs.view', ['defib' => $defib->id])->with('success', 'Defib note successfully added');
    }
}
