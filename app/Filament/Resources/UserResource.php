<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Пользователи и роли';
    protected static ?string $modelLabel = 'пользователя';
    protected static ?string $navigationLabel = 'Пользователи';
    protected static ?string $pluralModelLabel = 'Пользователи';
    protected static ?string $breadcrumb = 'Пользователи';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

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
                                                Forms\Components\TextInput::make('password')
                                                    ->label('Пароль')
                                                    ->revealable()
                                                    ->visible(fn(?User $record) => $record === null),
                                                Forms\Components\Select::make('roles')
                                                    ->label('Роли')
                                                    ->relationship('roles', 'name')
                                                    ->multiple()
                                                    ->preload()
                                                    ->searchable()
                                            ])
                                    ]),

                                Tabs\Tab::make('Профиль пользователя')
                                    ->schema([
                                        Forms\Components\Section::make()
                                            ->schema([
                                                Forms\Components\TextInput::make('first_name')
                                                    ->label('Имя')
                                                    ->required(),
                                                Forms\Components\TextInput::make('surname')
                                                    ->label('Фамилия')
                                                    ->required(),
                                                Forms\Components\TextInput::make('last_name')
                                                    ->label('Отчество'),
                                                Forms\Components\TextInput::make('email')
                                                    ->label('Email')
                                                    ->email()
                                                    ->required(),
                                                Forms\Components\TextInput::make('phone')
                                                    ->label('Телефон')
                                                    ->tel(),
                                            ])
                                    ]),
                            ])
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Статус')
                            ->schema([
                                Forms\Components\Toggle::make('active')
                                    ->label('Активен')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->inline(false)
                                    ->required(),
                            ]),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Создана')
                                    ->content(fn(User $record): ?string => $record->created_at?->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Обновлена')
                                    ->content(fn(User $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->hidden(fn(?User $record) => $record === null),
                    ])
                    ->columnSpan(['lg' => 1])
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_name_and_surname')
                    ->label('Имя пользователя')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email успешно скопирован')
                    ->copyMessageDuration(1500),
                Tables\Columns\IconColumn::make('active')
                    ->label('Активен')
                    ->sortable()
                    ->boolean(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
