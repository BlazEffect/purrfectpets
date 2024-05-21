<?php

namespace App\Filament\Resources\CatalogProductResource\RelationManagers;

use App\Models\CatalogProduct;
use App\Models\CatalogProductProperty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PropertyValuesRelationManager extends RelationManager
{
    protected static string $relationship = 'properties';

    protected static ?string $recordTitleAttribute = 'product_id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('property_id')
                    ->label('Свойство')
                    ->options(CatalogProductProperty::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('product_id')
                    ->label('Товар')
                    ->options(CatalogProduct::all()->pluck('name', 'id'))
                    ->default($this->getOwnerRecord()->id)
                    ->visible(false),
                Forms\Components\Textarea::make('value')
                    ->label('Значение свойства')
                    ->required()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('property.name'),
                Tables\Columns\TextColumn::make('value'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
