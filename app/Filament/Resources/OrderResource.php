<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\orderItems;

use Filament\Forms\Get;
use Filament\Forms\Set;

use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->required(),
                Forms\Components\TextInput::make('order_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('order_date')
                    ->required(),

                Forms\Components\TextInput::make('order_status')
                    ->required()
                    ->maxLength(255)
                    ->default('APOINTMENT'),
                Forms\Components\TextInput::make('payment_method')
                    ->required()
                    ->maxLength(255)
                    ->default('CASH'),

                Forms\Components\TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\Repeater::make('orderItems')
                    ->relationship()
                    ->columnSpanFull()
                    ->columns(5)
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('qty')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('unit_price')
                            ->required()
                            ->numeric()
                            ->live(debounce: 500)
                            ->afterStateUpdated(function (Set $set, Get $get) {
                                $qty = (int) $get('qty');
                                $unit_price = (int) $get('unit_price');
                                $amount = $qty * $unit_price;
                                $set('amount', $amount);
                            }),
                        Forms\Components\TextInput::make('discount')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->live(debounce: 500)
                            ->afterStateUpdated(function (Set $set, Get $get) {
                                $qty = (int) $get('qty');
                                $unit_price = (int) $get('unit_price');
                                $discount = (int) $get('discount');
                                $amount = $qty * $unit_price;
                                if ($discount > 0) {
                                    $amount -= ($amount * $discount / 100);
                                }
                                $set('amount', $amount);
                            }),

                            Forms\Components\TextInput::make('amount')
                            ->numeric(),
                        
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\Action::make('View invoice')
                //     ->url(fn (Order $record): string => route('invoice.stream-pdf', $record->id))
                //     ->openUrlInNewTab(),
                // Tables\Actions\Action::make('Download invoice')
                //     ->url(fn (Order $record): string => route('invoice.download-pdf', $record->id))
                //     ->openUrlInNewTab(),
                // Tables\Actions\Action::make('Email invoice')
                //     ->url(fn (Order $record): string => route('invoice.send-email', $record->id))
                //     ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // ...
                TextEntry::make('customer.email'),
                TextEntry::make('order_date'),
                TextEntry::make('total_amount'),
                TextEntry::make('order_status'),
                TextEntry::make('payment_method'),
                RepeatableEntry::make('orderItems')
                    ->schema([
                        TextEntry::make('product.name'),
                        TextEntry::make('qty'),
                        TextEntry::make('unit_price'),
                        TextEntry::make('amount'),
                        TextEntry::make('discount')
                            ->columnSpan(5),
                    ])
                    ->columns(2)
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
