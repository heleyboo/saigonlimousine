<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\Category;
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
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationGroup = 'Content Management';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Post Content')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('title.en')
                                    ->label('Title (English)')
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
                                    ->unique(table: 'posts', column: 'slug->en', ignoreRecord: true)
                                    ->reactive(),
                                Textarea::make('short_description.en')
                                    ->label('Short Description (English)')
                                    ->rows(3)
                                    ->maxLength(500),
                                RichEditor::make('content.en')
                                    ->label('Content (English)')
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('meta_title.en')
                                    ->label('Meta Title (English)')
                                    ->maxLength(60),
                                Textarea::make('meta_description.en')
                                    ->label('Meta Description (English)')
                                    ->rows(2)
                                    ->maxLength(160),
                            ]),
                        Tab::make('Vietnamese')
                            ->schema([
                                TextInput::make('title.vi')
                                    ->label('Title (Vietnamese)')
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
                                    ->unique(table: 'posts', column: 'slug->vi', ignoreRecord: true)
                                    ->reactive(),
                                Textarea::make('short_description.vi')
                                    ->label('Short Description (Vietnamese)')
                                    ->rows(3)
                                    ->maxLength(500),
                                RichEditor::make('content.vi')
                                    ->label('Content (Vietnamese)')
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('meta_title.vi')
                                    ->label('Meta Title (Vietnamese)')
                                    ->maxLength(60),
                                Textarea::make('meta_description.vi')
                                    ->label('Meta Description (Vietnamese)')
                                    ->rows(2)
                                    ->maxLength(160),
                            ]),
                    ])
                    ->columnSpanFull(),
                
                Section::make('Post Settings')
                    ->schema([
                        Select::make('type')
                            ->options([
                                'destination' => 'Travel Destination',
                                'travel_tips' => 'Travel Tips',
                                'itinerary' => 'Suggested Itinerary',
                                'promotion' => 'Promotion / Company News',
                                'review' => 'Customer Review',
                            ])
                            ->required(),
                        
                        Select::make('category_id')
                            ->label('Category')
                            ->options(fn () => Category::active()->pluck('name', 'id')->toArray())
                            ->searchable()
                            ->placeholder('Select category'),
                        
                        Select::make('related_service_id')
                            ->label('Related Service')
                            ->options(fn () => Service::active()->pluck('name', 'id')->toArray())
                            ->searchable()
                            ->placeholder('Select related service (optional)'),
                        
                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                            ])
                            ->default('draft')
                            ->required(),
                        
                        DateTimePicker::make('published_at')
                            ->label('Publish Date')
                            ->visible(fn ($get) => $get('status') === 'published'),
                        
                        Toggle::make('is_featured')
                            ->label('Featured Post')
                            ->default(false),
                        
                        TagsInput::make('seo_keywords')
                            ->label('SEO Keywords')
                            ->separator(','),
                    ])
                    ->columns(2),
                
                Section::make('Media')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('cover')
                            ->label('Cover Image')
                            ->collection('cover')
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull(),
                        
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->label('Gallery Images')
                            ->collection('gallery')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')
                    ->label('Cover')
                    ->circular()
                    ->getStateUsing(fn ($record) => $record->getFirstMediaUrl('cover')),
                
                TextColumn::make('title')
                    ->label('Title')
                    ->formatStateUsing(function ($state) {
                        if (is_array($state)) {
                            return $state['vi'] ?? $state['en'] ?? 'N/A';
                        }
                        return $state ?: 'N/A';
                    })
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'destination' => 'success',
                        'travel_tips' => 'info',
                        'itinerary' => 'warning',
                        'promotion' => 'danger',
                        'review' => 'primary',
                    }),
                
                TextColumn::make('category.name')
                    ->label('Category')
                    ->formatStateUsing(function ($state) {
                        if (is_array($state)) {
                            return $state['vi'] ?? $state['en'] ?? 'N/A';
                        }
                        return $state ?: 'N/A';
                    }),
                
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                    }),
                
                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                
                TextColumn::make('view_count')
                    ->label('Views')
                    ->sortable(),
                
                ToggleColumn::make('is_featured')
                    ->label('Featured'),
                
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'destination' => 'Travel Destination',
                        'travel_tips' => 'Travel Tips',
                        'itinerary' => 'Suggested Itinerary',
                        'promotion' => 'Promotion / Company News',
                        'review' => 'Customer Review',
                    ]),
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->options(fn () => Category::active()->pluck('name', 'id')->toArray()),
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),
                TernaryFilter::make('is_featured')
                    ->label('Featured'),
                Filter::make('published_at')
                    ->form([
                        DateTimePicker::make('published_from'),
                        DateTimePicker::make('published_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    })
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
            RelationManagers\TagsRelationManager::class,
            RelationManagers\RelatedPostsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
