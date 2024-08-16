<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Enums\StockStatus;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->default(null),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),
                Forms\Components\CheckboxList::make('category_id')
                    ->relationship('category', 'name')
                    ->default(null),
                Forms\Components\Select::make('brand_id')
                    // ->multiple()
                    ->preload()
                    ->relationship('brand', 'name')
                    ->default(null),
                Forms\Components\CheckboxList::make('product_label_id')
                    ->relationship('productLabel', 'name')
                    ->default(null),
                Forms\Components\Select::make('product_tag_id')
                    ->relationship('productTag', 'name')
                    ->default(null),
                Forms\Components\CheckboxList::make('product_collection_id')
                    ->relationship('productCollection', 'name')
                    ->default(null),
                Forms\Components\FileUpload::make('image_path')
                    ->image(),
                Forms\Components\TextInput::make('qty')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('alert_stock')
                    ->numeric()
                    ->default(0),
                Forms\Components\Radio::make('stock_status')
                    ->options(StockStatus::class)
                    ->default('In Stock'),
                Forms\Components\TextInput::make('is_featured')
                    ->maxLength(255)
                    ->default(0),
                Forms\Components\TextInput::make('min_order_qty')
                    ->maxLength(255)
                    ->default(0),
                Forms\Components\TextInput::make('max_order_qty')
                    ->maxLength(255)
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_label_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_tag_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_path'),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alert_stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('is_featured')
                    ->searchable(),
                Tables\Columns\TextColumn::make('min_order_qty')
                    ->searchable(),
                Tables\Columns\TextColumn::make('max_order_qty')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
