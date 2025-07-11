<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NavigationMenuResource\Pages;
use App\Filament\Resources\NavigationMenuResource\RelationManagers;
use App\Models\NavigationMenu;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class NavigationMenuResource extends Resource
{
    protected static ?string $model = NavigationMenu::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    
    protected static ?string $navigationGroup = 'Content Management';
    
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Menu')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('name.en')
                                    ->label('Name (English)')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Tab::make('Vietnamese')
                            ->schema([
                                TextInput::make('name.vi')
                                    ->label('Name (Vietnamese)')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                    ]),
                
                Select::make('location')
                    ->options([
                        'header' => 'Header Menu',
                        'footer' => 'Footer Menu',
                        'sidebar' => 'Sidebar Menu',
                        'mobile' => 'Mobile Menu',
                    ])
                    ->required()
                    ->unique(ignoreRecord: true),
                
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
                        if (is_array($state) && isset($state['en'])) {
                            return $state['en'];
                        }
                        if (is_string($state)) {
                            return $state;
                        }
                        return 'N/A';
                    })
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('location')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'header' => 'success',
                        'footer' => 'info',
                        'sidebar' => 'warning',
                        'mobile' => 'danger',
                        default => 'gray',
                    }),
                
                TextColumn::make('items_count')
                    ->label('Menu Items')
                    ->counts('items'),
                
                ToggleColumn::make('is_active')
                    ->label('Active'),
                
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('location')
                    ->options([
                        'header' => 'Header Menu',
                        'footer' => 'Footer Menu',
                        'sidebar' => 'Sidebar Menu',
                        'mobile' => 'Mobile Menu',
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
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNavigationMenus::route('/'),
            'create' => Pages\CreateNavigationMenu::route('/create'),
            'edit' => Pages\EditNavigationMenu::route('/{record}/edit'),
        ];
    }
}
