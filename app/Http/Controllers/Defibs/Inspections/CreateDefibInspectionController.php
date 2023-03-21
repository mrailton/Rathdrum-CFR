<?php

declare(strict_types=1);

namespace App\Http\Controllers\Defibs\Inspections;

use App\Enums\BatteryCondition;
use App\Http\Controllers\Controller;
use App\Models\Defib;
use App\Models\Member;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CreateDefibInspectionController extends Controller
{
    public function __invoke(Request $request, Defib $defib): View
    {
        return view('defibs.inspections.create', [
            'defib' => $defib,
            'members' => Member::all(),
            'batteryConditions' => BatteryCondition::toArray(),
        ]);
    }
}
