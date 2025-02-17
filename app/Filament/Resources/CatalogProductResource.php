<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\CatalogProductResource\Pages;
use App\Filament\Resources\CatalogProductResource\RelationManagers;
use App\Models\CatalogProduct;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CatalogProductResource extends Resource
{
    protected static ?string $model = CatalogProduct::class;
    protected static ?string $navigationGroup = 'Каталог';
    protected static ?string $modelLabel = 'продукт';
    protected static ?string $navigationLabel = 'Продукты';
    protected static ?string $pluralModelLabel = 'Продукты';
    protected static ?string $breadcrumb = 'Продукты';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Tabs::make('Tabs')
                            ->tabs([
                                Tabs\Tab::make('Основная информация')
                                    ->schema([
                                        Forms\Components\Section::make()
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Название товара')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                        if ($operation !== 'create') {
                                                            return;
                                                        }

                                                        $set('slug', Str::slug($state));
                                                    }),

                                                Forms\Components\TextInput::make('slug')
                                                    ->label('Символьный код')
                                                    ->disabled()
                                                    ->dehydrated()
                                                    ->required()
                                                    ->maxLength(255),

                                                Forms\Components\FileUpload::make('image')
                                                    ->label('Картинки')
                                                    ->multiple()
                                                    ->image()
                                                    ->imageEditor()
                                                    ->imageEditorAspectRatios([
                                                        null,
                                                        '16:9',
                                                        '4:3',
                                                        '1:1',
                                                    ])
                                                    ->previewable()
                                                    ->disk('products'),

                                                Forms\Components\Select::make('brand_id')
                                                    ->label('Бренд')
                                                    ->relationship('brand', 'name')
                                                    ->searchable()
                                                    ->preload(),

                                                Forms\Components\Select::make('sections')
                                                    ->label('Разделы')
                                                    ->multiple()
                                                    ->relationship('sections', 'name')
                                                    ->searchable()
                                                    ->preload(),
                                            ]),

                                        Forms\Components\Section::make()
                                            ->schema([
                                                TinyEditor::make('description')
                                                    ->label('Содержание')
                                                    ->fileAttachmentsDisk('public')
                                                    ->fileAttachmentsVisibility('public')
                                                    ->fileAttachmentsDirectory('upload')
                                                    ->profile('full')
                                                    ->columnSpan('full')
                                            ])
                                    ]),

                                Tabs\Tab::make('Каталог')
                                    ->schema([
                                        Forms\Components\TextInput::make('price')
                                            ->label('Цена')
                                            ->required(),
                                        Forms\Components\TextInput::make('quantity')
                                            ->label('Количество товара')
                                            ->default(0),
                                    ])
                            ])
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Статус')
                            ->schema([
                                Forms\Components\Toggle::make('active')
                                    ->label('Активность')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->inline(false)
                                    ->required(),

                                Forms\Components\TextInput::make('order')
                                    ->label('Порядок')
                                    ->default(0),
                            ]),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Создана')
                                    ->content(fn(CatalogProduct $record): ?string => $record->created_at?->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Обновлена')
                                    ->content(fn(CatalogProduct $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->hidden(fn(?CatalogProduct $record) => $record === null),
                    ])
                    ->columnSpan(['lg' => 1])
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->label('Активность')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Порядок')
                    ->sortable()
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

    public static function getRelations(): array
    {
        return [
            RelationManagers\PropertyValuesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCatalogProducts::route('/'),
            'create' => Pages\CreateCatalogProduct::route('/create'),
            'edit' => Pages\EditCatalogProduct::route('/{record}/edit'),
        ];
    }
}
