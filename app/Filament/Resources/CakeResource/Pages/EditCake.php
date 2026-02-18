<?php

namespace App\Filament\Resources\CakeResource\Pages;

use App\Filament\Resources\CakeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCake extends EditRecord
{
    protected static string $resource = CakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
