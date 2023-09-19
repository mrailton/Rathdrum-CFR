<?php

declare(strict_types=1);

namespace App\Filament\Resources\CalloutResource\Pages;

use App\Filament\Resources\CalloutResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCallout extends EditRecord
{
    protected static string $resource = CalloutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->getRecord()]);
    }
}
