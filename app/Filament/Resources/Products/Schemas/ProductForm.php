<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;


class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product')
                    ->tabs([
                        Tab::make('General')
                            ->schema([
                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                Select::make('brand_id')
                                    ->relationship('brand', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) =>
                                    $set('slug', Str::slug($state))
                                    ),

                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                TextInput::make('sku')
                                    ->label('SKU')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                Textarea::make('description')
                                    ->columnSpanFull(),

                                Toggle::make('is_active')
                                    ->default(true),
                            ]),

                        Tab::make('Price & Stock')
                            ->schema([
                                TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('₴'),

                                TextInput::make('old_price')
                                    ->numeric()
                                    ->prefix('₴')
                                    ->default(null),

                                TextInput::make('quantity')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                            ]),

                        Tab::make('Images')
                            ->schema([
                                FileUpload::make('images')
                                    ->image()
                                    ->multiple()
                                    ->directory('products')
                                    ->reorderable(),
                            ]),

                        Tab::make('Attributes')
                            ->schema([
                                Select::make('attributeValues')
                                    ->relationship('attributeValues', 'value')
                                    ->multiple()
                                    ->searchable()
                                    ->preload(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
