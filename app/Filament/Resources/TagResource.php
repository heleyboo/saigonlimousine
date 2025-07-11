<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagResource\Pages;
use App\Filament\Resources\TagResource\RelationManagers;
use App\Models\Tag;
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
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Str;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    
    protected static ?string $navigationGroup = 'Content Management';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tag')
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
                                    ->unique(table: 'tags', column: 'slug->en', ignoreRecord: true),
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
                                    ->unique(table: 'tags', column: 'slug->vi', ignoreRecord: true),
                            ]),
                    ]),
                
                Select::make('type')
                    ->options([
                        'destination' => 'Destination',
                        'activity' => 'Activity',
                        'culture' => 'Culture',
                        'food' => 'Food',
                        'nature' => 'Nature',
                        'beach' => 'Beach',
                        'mountain' => 'Mountain',
                        'historical' => 'Historical',
                        'adventure' => 'Adventure',
                        'relaxation' => 'Relaxation',
                    ])
                    ->placeholder('Select tag type (optional)'),
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
                        'activity' => 'info',
                        'culture' => 'warning',
                        'food' => 'danger',
                        'nature' => 'primary',
                        'beach' => 'success',
                        'mountain' => 'warning',
                        'historical' => 'danger',
                        'adventure' => 'info',
                        'relaxation' => 'primary',
                        default => 'gray',
                    }),
                
                // TextColumn::make('taggables_count')
                //     ->label('Usage Count')
                //     ->counts('taggables'),
                
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'destination' => 'Destination',
                        'activity' => 'Activity',
                        'culture' => 'Culture',
                        'food' => 'Food',
                        'nature' => 'Nature',
                        'beach' => 'Beach',
                        'mountain' => 'Mountain',
                        'historical' => 'Historical',
                        'adventure' => 'Adventure',
                        'relaxation' => 'Relaxation',
                    ]),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTags::route('/'),
            'create' => Pages\CreateTag::route('/create'),
            'edit' => Pages\EditTag::route('/{record}/edit'),
        ];
    }
}
