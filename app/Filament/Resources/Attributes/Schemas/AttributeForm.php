<?php

namespace App\Filament\Resources\Attributes\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AttributeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) =>
                    $set('slug', Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Select::make('type')
                    ->options([
                        'text' => 'Text',
                        'number' => 'Number',
                        'color' => 'Color',
                        'select' => 'Select',
                    ])
                    ->default('text')
                    ->required(),

                Toggle::make('is_filterable')
                    ->default(false),

                Repeater::make('values')
                    ->relationship()
                    ->schema([
                        TextInput::make('value')
                            ->required(),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->defaultItems(0)
                    ->addActionLabel('Add value')
                    ->reorderable()
                    ->collapsible(),
            ]);
    }
}
