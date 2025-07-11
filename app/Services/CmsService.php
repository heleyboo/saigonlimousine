<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Service;
use App\Models\NavigationMenu;
use Illuminate\Support\Facades\App;

class CmsService
{
    /**
     * Get posts with filtering options
     */
    public function getPosts(array $filters = []): \Illuminate\Database\Eloquent\Builder
    {
        $query = Post::with(['category', 'tags', 'relatedService'])
            ->published()
            ->orderBy('published_at', 'desc');

        if (isset($filters['type'])) {
            $query->byType($filters['type']);
        }

        if (isset($filters['category_id'])) {
            $query->byCategory($filters['category_id']);
        }

        if (isset($filters['featured'])) {
            $query->featured();
        }

        if (isset($filters['search'])) {
            $query->search($filters['search']);
        }

        if (isset($filters['limit'])) {
            $query->limit($filters['limit']);
        }

        return $query;
    }

    /**
     * Get featured posts
     */
    public function getFeaturedPosts(int $limit = 6): \Illuminate\Database\Eloquent\Collection
    {
        return $this->getPosts(['featured' => true, 'limit' => $limit])->get();
    }

    /**
     * Get posts by type
     */
    public function getPostsByType(string $type, int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return $this->getPosts(['type' => $type, 'limit' => $limit])->get();
    }

    /**
     * Get posts by category
     */
    public function getPostsByCategory(int $categoryId, int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return $this->getPosts(['category_id' => $categoryId, 'limit' => $limit])->get();
    }

    /**
     * Get destination categories grouped by region
     */
    public function getDestinationCategories(): array
    {
        $categories = Category::active()
            ->byType('destination')
            ->with('children')
            ->orderBy('order_column')
            ->get();

        return [
            'north' => $categories->where('region', 'north'),
            'central' => $categories->where('region', 'central'),
            'south' => $categories->where('region', 'south'),
        ];
    }

    /**
     * Get post type categories
     */
    public function getPostTypeCategories(): \Illuminate\Database\Eloquent\Collection
    {
        return Category::active()
            ->byType('post_type')
            ->orderBy('order_column')
            ->get();
    }

    /**
     * Get tags by type
     */
    public function getTagsByType(string $type = null): \Illuminate\Database\Eloquent\Collection
    {
        $query = Tag::active();
        
        if ($type) {
            $query->byType($type);
        }

        return $query->orderBy('order_column')->get();
    }

    /**
     * Get services
     */
    public function getServices(): \Illuminate\Database\Eloquent\Collection
    {
        return Service::active()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get navigation menu by location
     */
    public function getNavigationMenu(string $location): ?NavigationMenu
    {
        return NavigationMenu::active()
            ->byLocation($location)
            ->with(['rootItems.children'])
            ->first();
    }

    /**
     * Get related posts
     */
    public function getRelatedPosts(Post $post, int $limit = 4): \Illuminate\Database\Eloquent\Collection
    {
        return $post->relatedPosts()
            ->published()
            ->where('id', '!=', $post->id)
            ->limit($limit)
            ->get();
    }

    /**
     * Get posts by tags
     */
    public function getPostsByTags(array $tagIds, int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return Post::with(['category', 'tags'])
            ->published()
            ->whereHas('tags', function ($query) use ($tagIds) {
                $query->whereIn('tags.id', $tagIds);
            })
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Search posts
     */
    public function searchPosts(string $query, int $limit = 20): \Illuminate\Database\Eloquent\Collection
    {
        return Post::with(['category', 'tags'])
            ->published()
            ->search($query)
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get localized content
     */
    public function getLocalizedContent($model, string $field, string $locale = null): string
    {
        $locale = $locale ?: App::getLocale();
        
        if (method_exists($model, 'getTranslation')) {
            return $model->getTranslation($field, $locale) ?: $model->getTranslation($field, 'en');
        }

        if (is_array($model->$field)) {
            return $model->$field[$locale] ?? $model->$field['en'] ?? '';
        }

        return $model->$field ?? '';
    }

    /**
     * Increment post view count
     */
    public function incrementPostViews(Post $post): void
    {
        $post->incrementViewCount();
    }

    /**
     * Get popular posts
     */
    public function getPopularPosts(int $limit = 5): \Illuminate\Database\Eloquent\Collection
    {
        return Post::published()
            ->orderBy('view_count', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get recent posts
     */
    public function getRecentPosts(int $limit = 5): \Illuminate\Database\Eloquent\Collection
    {
        return Post::published()
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }
} 