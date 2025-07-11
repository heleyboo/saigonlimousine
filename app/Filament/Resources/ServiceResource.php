<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
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

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    
    protected static ?string $navigationGroup = 'Content Management';
    
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Service')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('name.en')
                                    ->label('Name (English)')
                                    ->required()
                                    ->maxLength(255),
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
                                    ->maxLength(255),
                                Textarea::make('description.vi')
                                    ->label('Description (Vietnamese)')
                                    ->rows(3)
                                    ->maxLength(1000),
                            ]),
                    ]),
                
                Select::make('type')
                    ->options([
                        'limousine' => 'Limousine Service',
                        'airport_transfer' => 'Airport Transfer',
                        'city_tour' => 'City Tour',
                        'day_trip' => 'Day Trip',
                        'multi_day_tour' => 'Multi-Day Tour',
                        'wedding_service' => 'Wedding Service',
                        'corporate_service' => 'Corporate Service',
                    ])
                    ->default('limousine')
                    ->required(),
                
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
                    ->formatStateUsing(fn ($state) => $state ? ($state['en'] ?? 'N/A') : 'N/A')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'limousine' => 'success',
                        'airport_transfer' => 'info',
                        'city_tour' => 'warning',
                        'day_trip' => 'danger',
                        'multi_day_tour' => 'primary',
                        'wedding_service' => 'success',
                        'corporate_service' => 'info',
                        default => 'gray',
                    }),
                
                TextColumn::make('posts_count')
                    ->label('Related Posts')
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
                        'limousine' => 'Limousine Service',
                        'airport_transfer' => 'Airport Transfer',
                        'city_tour' => 'City Tour',
                        'day_trip' => 'Day Trip',
                        'multi_day_tour' => 'Multi-Day Tour',
                        'wedding_service' => 'Wedding Service',
                        'corporate_service' => 'Corporate Service',
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
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
