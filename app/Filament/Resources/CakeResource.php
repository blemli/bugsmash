<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CakeResource\Pages;
use App\Models\Cake;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CakeResource extends Resource
{
    protected static ?string $model = Cake::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cake';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components(static::getFormSchema());
    }

    /** @return array<int, \Filament\Schemas\Components\Component> */
    public static function getFormSchema(): array
    {
        return [
            Tabs::make('Tabs')
                ->persistTabInQueryString()
                ->columnSpanFull()
                ->tabs([
                    Tab::make(__('Details'))
                        ->columns(2)
                        ->schema([
                            TextInput::make('title')
                                ->autofocus()
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                            TextInput::make('slug')
                                ->autofocus()
                                ->required()
                                ->unique(ignoreRecord: true),
                            Select::make('flavor')
                                ->options([
                                    'chocolate' => 'Chocolate',
                                    'vanilla' => 'Vanilla',
                                    'strawberry' => 'Strawberry',
                                    'red-velvet' => 'Red Velvet',
                                    'lemon' => 'Lemon',
                                    'carrot' => 'Carrot',
                                ]),
                            TextInput::make('layers')
                                ->numeric()
                                ->default(1)
                                ->minValue(1)
                                ->maxValue(10),
                        ]),
                    Tab::make(__('Pricing & Availability'))
                        ->columns(2)
                        ->schema([
                            TextInput::make('price')
                                ->numeric()
                                ->prefix('$'),
                            Toggle::make('is_available')
                                ->default(true),
                        ]),
                    Tab::make(__('Description'))
                        ->schema([
                            Textarea::make('description')
                                ->rows(5)
                                ->columnSpanFull(),
                        ]),
                ]),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('flavor')
                    ->sortable(),
                TextColumn::make('layers')
                    ->sortable(),
                TextColumn::make('price')
                    ->money('usd')
                    ->sortable(),
                IconColumn::make('is_available')
                    ->boolean(),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCakes::route('/'),
            'create' => Pages\CreateCake::route('/create'),
            'edit' => Pages\EditCake::route('/{record}/edit'),
        ];
    }
}
