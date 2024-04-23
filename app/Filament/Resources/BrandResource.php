<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;
    protected static ?string $navigationGroup = 'Каталог';
    protected static ?string $modelLabel = 'бренд';
    protected static ?string $navigationLabel = 'Бренды';
    protected static ?string $pluralModelLabel = 'Бренды';
    protected static ?string $breadcrumb = 'Бренды';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
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
                                    ->content(fn(Brand $record): ?string => $record->created_at?->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Обновлена')
                                    ->content(fn(Brand $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->hidden(fn(?Brand $record) => $record === null),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
