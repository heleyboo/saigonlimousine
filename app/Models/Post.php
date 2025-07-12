<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model implements Sortable, HasMedia
{
    use HasTranslations, HasSlug, HasTags, InteractsWithMedia, SortableTrait, HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content',
        'meta_title',
        'meta_description',
        'type',
        'status',
        'published_at',
        'is_featured',
        'order_column',
        'category_id',
        'author_id',
        'related_service_id',
        'view_count',
        'seo_keywords',
    ];

    public $translatable = [
        'title',
        'slug',
        'short_description',
        'content',
        'meta_title',
        'meta_description',
        'seo_keywords',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'view_count' => 'integer',
        'seo_keywords' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->singleFile()
            ->useDisk('public');
        
        $this->addMediaCollection('gallery')
            ->useDisk('public');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function relatedService(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'related_service_id');
    }

    public function relatedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'related_posts', 'post_id', 'related_post_id')
            ->withPivot('order_column')
            ->withTimestamps();
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    public function scopeByType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }

    public function scopeByCategory(Builder $query, int $categoryId): void
    {
        $query->where('category_id', $categoryId);
    }

    public function scopeSearch(Builder $query, string $search): void
    {
        $query->where(function ($q) use ($search) {
            $q->whereRaw("JSON_EXTRACT(title, '$.en') LIKE ?", ["%{$search}%"])
              ->orWhereRaw("JSON_EXTRACT(title, '$.vi') LIKE ?", ["%{$search}%"])
              ->orWhereRaw("JSON_EXTRACT(content, '$.en') LIKE ?", ["%{$search}%"])
              ->orWhereRaw("JSON_EXTRACT(content, '$.vi') LIKE ?", ["%{$search}%"]);
        });
    }

    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('cover');
    }

    public function getGalleryUrlsAttribute(): array
    {
        return $this->getMedia('gallery')->map(fn($media) => $media->getUrl())->toArray();
    }
}
