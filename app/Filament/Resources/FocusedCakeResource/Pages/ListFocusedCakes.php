<?php

namespace App\Filament\Resources\FocusedCakeResource\Pages;

use App\Filament\Resources\FocusedCakeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFocusedCakes extends ListRecords
{
    protected static string $resource = FocusedCakeResource::class;

    protected static ?string $title = 'Focused Cakes';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
