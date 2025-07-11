<?php

namespace App\Filament\Resources\NavigationMenuResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'label';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Menu Item')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('label.en')
                                    ->label('Label (English)')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Tab::make('Vietnamese')
                            ->schema([
                                TextInput::make('label.vi')
                                    ->label('Label (Vietnamese)')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                    ]),
                
                TextInput::make('url')
                    ->label('URL')
                    ->required()
                    ->placeholder('e.g., /destinations, /about, https://example.com'),
                
                Select::make('target')
                    ->options([
                        '_self' => 'Same Window',
                        '_blank' => 'New Window',
                        '_parent' => 'Parent Frame',
                        '_top' => 'Top Frame',
                    ])
                    ->default('_self')
                    ->required(),
                
                Select::make('parent_id')
                    ->label('Parent Item')
                    ->options(fn () => $this->getOwnerRecord()->items()->pluck('label', 'id'))
                    ->searchable()
                    ->placeholder('Select parent item (optional)'),
                
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('label')
            ->columns([
                TextColumn::make('label')
                    ->label('Label')
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
                
                TextColumn::make('url')
                    ->label('URL')
                    ->limit(50)
                    ->copyable(),
                
                TextColumn::make('target')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '_self' => 'success',
                        '_blank' => 'warning',
                        '_parent' => 'info',
                        '_top' => 'danger',
                        default => 'gray',
                    }),
                
                TextColumn::make('parent.label')
                    ->label('Parent')
                    ->formatStateUsing(function ($state) {
                        if (is_array($state) && isset($state['en'])) {
                            return $state['en'];
                        }
                        if (is_string($state)) {
                            return $state;
                        }
                        return 'N/A';
                    }),
                
                TextColumn::make('children_count')
                    ->label('Children')
                    ->counts('children'),
                
                TextColumn::make('order_column')
                    ->label('Order')
                    ->sortable(),
                
                TextColumn::make('is_active')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Active' : 'Inactive'),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
} 