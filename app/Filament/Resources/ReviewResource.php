<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\ReviewResource\Pages;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;
    protected static ?string $navigationGroup = 'Отзывы';
    protected static ?string $modelLabel = 'отзыв';
    protected static ?string $navigationLabel = 'Отзывы';
    protected static ?string $pluralModelLabel = 'Отзывы';
    protected static ?string $breadcrumb = 'Отзывы';
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
                                Forms\Components\ToggleButtons::make('status')
                                    ->label('Статус')
                                    ->inline()
                                    ->options([
                                        0 => 'На модерации',
                                        1 => 'Опубликован',
                                    ])
                                    ->required(),
                                Forms\Components\Select::make('user_id')
                                    ->label('Пользователь')
                                    ->relationship('user.profile', 'first_name')
                                    ->getOptionLabelFromRecordUsing(fn(Model $record) => $record->surname . ' ' . $record->first_name . ' ' . $record->last_name)
                                    ->searchable()
                                    ->required()
                                    ->preload(),
                                Forms\Components\TextInput::make('rating_value')
                                    ->label('Оценка')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(5),
                                Forms\Components\TextInput::make('name')
                                    ->label('Отзыв'),
                                TinyEditor::make('text')
                                    ->label('Содержание')
                                    ->profile('full')
                                    ->columnSpan('full'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Создана')
                                    ->content(fn(Review $record): ?string => $record->created_at?->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Обновлена')
                                    ->content(fn(Review $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->hidden(fn(?Review $record) => $record === null),
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
                    ->label('Идентификатор')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.user_name_and_surname')
                    ->label('Пользователь')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Отзыв')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Статус')
                    ->boolean(),
                Tables\Columns\TextColumn::make('rating_value')
                    ->label('Оценка')
                    ->sortable()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
