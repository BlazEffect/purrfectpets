<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\CatalogProduct;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationGroup = 'Заказы';
    protected static ?string $modelLabel = 'заказ';
    protected static ?string $navigationLabel = 'Заказы';
    protected static ?string $pluralModelLabel = 'Заказы';
    protected static ?string $breadcrumb = 'Заказы';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Основная информация')
                            ->schema([
                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\Section::make()
                                            ->schema(static::getDetailsFormSchema())
                                            ->columns(2),

                                        Forms\Components\Section::make('Товары в заказе')
                                            ->schema([
                                                static::getItemsRepeater(),
                                            ]),
                                    ]),
                            ]),
                        Tabs\Tab::make('Информация заказа')
                            ->schema([
                                Forms\Components\Group::make()
                                    ->relationship('properties')
                                    ->schema([
                                        Forms\Components\TextInput::make('FIO')
                                            ->label('ФИО покупателя'),
                                        Forms\Components\TextInput::make('email')
                                            ->label('Почта покупателя')
                                            ->email(),
                                        Forms\Components\TextInput::make('phone')
                                            ->label('Телефон покупателя'),
                                        Forms\Components\TextInput::make('address')
                                            ->label('Адрес доставки'),
                                        Forms\Components\TextInput::make('comment')
                                            ->label('Комментарий к заказу')
                                    ])
                            ])
                    ])
                    ->columnSpan(['lg' => fn (?Order $record) => $record === null ? 3 : 2]),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Создана')
                            ->content(fn (Order $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Обновлена')
                            ->content(fn (Order $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Order $record) => $record === null),
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
                Tables\Columns\TextColumn::make('price')
                    ->label('Сумма')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата заказа')
                    ->date(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['products', 'user.profile', 'properties']);
    }

    public static function getDetailsFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('id')
                ->label('Идентификатор')
                ->disabled()
                ->dehydrated()
                ->maxLength(32)
                ->unique(Order::class, 'id', ignoreRecord: true),
            Forms\Components\ToggleButtons::make('status')
                ->label('Статус')
                ->inline()
                ->options([
                    0 => 'Новый',
                    1 => 'В процессе',
                    2 => 'Доставлен',
                    3 => 'Отменён',
                ])
                ->required(),
            Forms\Components\Select::make('user_id')
                ->relationship('user.profile', 'first_name')
                ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->surname . ' ' . $record->first_name . ' ' . $record->last_name)
                ->searchable()
                ->required()
                ->preload(),
            Forms\Components\TextInput::make('price')
                ->label('Полная цена')
                ->disabled()
                ->dehydrated()
                ->numeric(),
            Forms\Components\Toggle::make('is_paid')
                ->label('Оплачен')
                ->onColor('success')
                ->offColor('danger')
                ->inline(false)
                ->default(false),
        ];
    }

    public static function getItemsRepeater(): Repeater
    {
        return Repeater::make('products')
            ->relationship()
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Товар')
                    ->options(CatalogProduct::query()->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('price', CatalogProduct::find($state)?->price ?? 0))
                    ->distinct()
                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                    ->columnSpan([
                        'md' => 5,
                    ])
                    ->searchable(),

                Forms\Components\TextInput::make('count')
                    ->label('Количество')
                    ->numeric()
                    ->default(1)
                    ->columnSpan([
                        'md' => 2,
                    ])
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Цена')
                    ->disabled()
                    ->dehydrated()
                    ->numeric()
                    ->required()
                    ->columnSpan([
                        'md' => 3,
                    ]),
            ])
            ->extraItemActions([
                Action::make('openProduct')
                    ->tooltip('Открыть товар')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->url(function (array $arguments, Repeater $component): ?string {
                        $itemData = $component->getRawItemState($arguments['item']);

                        $product = CatalogProduct::find($itemData['product_id']);

                        if (!$product) {
                            return null;
                        }

                        return CatalogProductResource::getUrl('edit', ['record' => $product]);
                    }, shouldOpenInNewTab: true)
                    ->hidden(fn (array $arguments, Repeater $component): bool => blank($component->getRawItemState($arguments['item'])['product_id'])),
            ])
            ->defaultItems(1)
            ->hiddenLabel()
            ->columns([
                'md' => 10,
            ])
            ->required();
    }
}
