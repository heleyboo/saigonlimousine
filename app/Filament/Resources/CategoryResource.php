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
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationGroup = 'Content Management';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Category')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('name.en')
                                    ->label('Name (English)')
                                    ->required()
                                    ->maxLength(255)
                                    ->reactive()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, $set) {
                                        if ($state) {
                                            $set('slug.en', Str::slug($state));
                                        }
                                    }),
                                TextInput::make('slug.en')
                                    ->label('Slug (English)')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(table: 'categories', column: 'slug->en', ignoreRecord: true)
                                    ->reactive(),
                                Textarea::make('description.en')
                                    ->label('Description (English)')
                                    ->rows(3)
                                    ->maxLength(1000),
                            ]),
                        Tab::make('Vietnamese')
                            ->schema([
                                TextInput::make('name.vi')
                                    ->label('Name (Vietnamese)')
                                    ->required()
                                    ->maxLength(255)
                                    ->reactive()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, $set) {
                                        if ($state) {
                                            $set('slug.vi', Str::slug($state));
                                        }
                                    }),
                                TextInput::make('slug.vi')
                                    ->label('Slug (Vietnamese)')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(table: 'categories', column: 'slug->vi', ignoreRecord: true)
                                    ->reactive(),
                                Textarea::make('description.vi')
                                    ->label('Description (Vietnamese)')
                                    ->rows(3)
                                    ->maxLength(1000),
                            ]),
                    ]),
                
                Select::make('type')
                    ->options([
                        'destination' => 'Destination',
                        'post_type' => 'Post Type',
                        'service' => 'Service',
                    ])
                    ->default('destination')
                    ->required(),
                
                Select::make('region')
                    ->options([
                        'north' => 'North Vietnam',
                        'central' => 'Central Vietnam',
                        'south' => 'South Vietnam',
                    ])
                    ->visible(fn ($get) => $get('type') === 'destination'),
                
                Select::make('parent_id')
                    ->label('Parent Category')
                    ->options(fn () => Category::pluck('name', 'id')->toArray())
                    ->searchable()
                    ->placeholder('Select parent category (optional)'),
                
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->formatStateUsing(function ($state) {
                        if (is_array($state)) {
                            return $state['vi'] ?? $state['en'] ?? 'N/A';
                        }
                        return $state ?: 'N/A';
                    })
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'destination' => 'success',
                        'post_type' => 'info',
                        'service' => 'warning',
                    }),
                
                TextColumn::make('region')
                    ->badge()
                    ->visible(fn ($record) => $record && $record->type === 'destination'),
                
                TextColumn::make('parent.name')
                    ->label('Parent')
                    ->formatStateUsing(function ($state) {
                        if (is_array($state)) {
                            return $state['vi'] ?? $state['en'] ?? 'N/A';
                        }
                        return $state ?: 'N/A';
                    }),
                
                TextColumn::make('posts_count')
                    ->label('Posts')
                    ->counts('posts'),
                
                ToggleColumn::make('is_active')
                    ->label('Active'),
                
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'destination' => 'Destination',
                        'post_type' => 'Post Type',
                        'service' => 'Service',
                    ]),
                SelectFilter::make('region')
                    ->options([
                        'north' => 'North Vietnam',
                        'central' => 'Central Vietnam',
                        'south' => 'South Vietnam',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order_column');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PostsRelationManager::class,
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
