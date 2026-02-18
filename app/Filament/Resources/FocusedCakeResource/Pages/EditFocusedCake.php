<?php

namespace App\Filament\Resources\FocusedCakeResource\Pages;

use App\Filament\Resources\FocusedCakeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFocusedCake extends EditRecord
{
    protected static string $resource = FocusedCakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
