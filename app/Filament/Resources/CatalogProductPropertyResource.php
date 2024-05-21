<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatalogProductPropertyResource\Pages;
use App\Models\CatalogProductProperty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CatalogProductPropertyResource extends Resource
{
    protected static ?string $model = CatalogProductProperty::class;
    protected static ?string $navigationGroup = 'Каталог';
    protected static ?string $modelLabel = 'свойства товара';
    protected static ?string $navigationLabel = 'Свойства товаров';
    protected static ?string $pluralModelLabel = 'Свойства товаров';
    protected static ?string $breadcrumb = 'Свойства товаров';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название свойства')
                    ->required()
                    ->maxLength(255)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Название свойства')
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCatalogProductProperties::route('/'),
            'create' => Pages\CreateCatalogProductProperty::route('/create'),
            'edit' => Pages\EditCatalogProductProperty::route('/{record}/edit'),
        ];
    }
}
