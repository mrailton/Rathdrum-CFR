<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Defib;
use Illuminate\View\Component;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;

class DefibMap extends Component
{
    public string $googleMapsAPIKey;

    public Collection $locations;

    public function __construct()
    {
        $this->googleMapsAPIKey = config('services.google.maps.api_key');
        $this->locations = Defib::public()->get()->map(
            function ($defib) {
                $coordinates = explode(',', $defib->coordinates);

                return [
                    'lat' => $coordinates[0],
                    'lng' => $coordinates[1],
                    'name' => $defib->name,
                    'location' => $defib->location,
                ];
            }
        );
    }

    public function render(): View
    {
        return view('components.defib-map');
    }
}
