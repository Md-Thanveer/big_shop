<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Enums\CategoryStatus;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Product Category';

    protected static ?string $navigationGroup = 'E-commerce';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Select::make('status')
                    ->options(CategoryStatus::class)
                    ->default(CategoryStatus::PUBLISHED),
                Forms\Components\FileUpload::make('image_path')
                    ->image()
                    ->directory('Category'),
                Forms\Components\TextInput::make('buying_price')
                    // ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('selling_price')
                    // ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('expected_profit')
                    // ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('earned_profit')
                    // ->required()
                    ->numeric(),
                Forms\Components\Select::make('company_id')
                    // ->required()
                    ->relationship('company', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_sub_category_count')
                    ->label('Total Sub Category')
                    ->badge()
                    // ->getStateUsing(fn($record) => $record->subcategories()->count())
                    ->getStateUsing(fn($record) => $record->getSubCategoryCountAttribute()),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state):string =>match($state){
                        CategoryStatus::PUBLISHED->value=>'success',
                        CategoryStatus::DRAFT->value=>'danger',
                        CategoryStatus::PENDING->value=>'warning',
                    }),
                Tables\Columns\ImageColumn::make('image_path')
                    ->getStateUsing(fn (Category $record): string=> $record->getImagePath()),
                Tables\Columns\TextColumn::make('buying_price')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('selling_price')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('expected_profit')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('earned_profit')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('company.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
