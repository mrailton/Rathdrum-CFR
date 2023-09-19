<?php

declare(strict_types=1);

namespace App\Filament\Resources\DefibResource\Pages;

use App\Filament\Resources\DefibResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDefib extends CreateRecord
{
    protected static string $resource = DefibResource::class;
    protected static bool $canCreateAnother = false;
}
