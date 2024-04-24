<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\CatalogSectionResource\Pages;
use App\Models\CatalogSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CatalogSectionResource extends Resource
{
    protected static ?string $model = CatalogSection::class;
    protected static ?string $navigationGroup = 'Каталог';
    protected static ?string $modelLabel = 'раздел';
    protected static ?string $navigationLabel = 'Разделы';
    protected static ?string $pluralModelLabel = 'Разделы';
    protected static ?string $breadcrumb = 'Разделы';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

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
                                    ->disk('sections'),

                                Forms\Components\Select::make('parent_id')
                                    ->label('Родительский раздел')
                                    ->relationship('parentSection', 'name', ignoreRecord: true)
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
                                    ->label('Порядок'),
                            ]),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Создана')
                                    ->content(fn(CatalogSection $record): ?string => $record->created_at?->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Обновлена')
                                    ->content(fn(CatalogSection $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->hidden(fn(?CatalogSection $record) => $record === null),
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
            'index' => Pages\ListCatalogSections::route('/'),
            'create' => Pages\CreateCatalogSection::route('/create'),
            'edit' => Pages\EditCatalogSection::route('/{record}/edit'),
        ];
    }
}
