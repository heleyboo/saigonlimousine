# Multilingual CMS for Saigon Limousine

A comprehensive multilingual (English/Vietnamese) CMS backend built with Laravel and FilamentPHP for a limousine rental service targeting international tourists.

## Features

### 🎯 Core CMS Features
- **Multilingual Content Management**: Full English/Vietnamese support for all content
- **Post Types**: Destinations, Travel Tips, Itineraries, Promotions, Reviews
- **Media Management**: Cover images and galleries with Spatie MediaLibrary
- **Tag System**: Categorized tags for content organization
- **Related Posts**: Many-to-many relationships between posts
- **Navigation Builder**: Hierarchical menu management
- **SEO Optimization**: Meta titles, descriptions, and keywords
- **Content Preview**: Draft/Published status management
- **Featured Posts**: Highlight important content
- **Search Functionality**: Full-text search across multilingual content

### 🏗️ Database Structure

#### Core Tables
- `posts` - Main content with multilingual fields
- `categories` - Hierarchical categories with region grouping
- `tags` - Tag system with categorization
- `services` - Limousine services linked to posts
- `navigation_menus` - Menu management
- `navigation_items` - Hierarchical menu items
- `media` - File management
- `taggables` - Many-to-many tag relationships
- `related_posts` - Many-to-many post relationships

#### Multilingual Fields
All translatable content uses JSON fields with the following structure:
```json
{
  "en": "English content",
  "vi": "Vietnamese content"
}
```

### 🎨 Filament Admin Panel

#### Resources
1. **CategoryResource** - Manage destination and post type categories
2. **PostResource** - Comprehensive post management with rich editor
3. **TagResource** - Tag management with categorization
4. **ServiceResource** - Limousine service management
5. **NavigationMenuResource** - Menu builder with hierarchical items

#### Features
- Tabbed forms for English/Vietnamese content
- Rich text editors for content
- File uploads with image editing
- Advanced filtering and search
- Relationship management
- Bulk actions
- Sortable content

## Installation & Setup

### 1. Install Dependencies
```bash
composer require spatie/laravel-translatable spatie/laravel-sluggable spatie/laravel-tags spatie/laravel-medialibrary
```

### 2. Run Migrations
```bash
php artisan migrate
```

### 3. Seed Database
```bash
php artisan db:seed
```

### 4. Create Storage Link
```bash
php artisan storage:link
```

### 5. Access Admin Panel
- URL: `/admin`
- Email: `admin@saigonlimousine.com`
- Password: `password`

## Frontend Implementation

### 1. Service Provider Registration

Register the CMS service in `app/Providers/AppServiceProvider.php`:

```php
use App\Services\CmsService;

public function register(): void
{
    $this->app->singleton(CmsService::class, function ($app) {
        return new CmsService();
    });
}
```

### 2. Controller Example

```php
<?php

namespace App\Http\Controllers;

use App\Services\CmsService;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $cmsService;

    public function __construct(CmsService $cmsService)
    {
        $this->cmsService = $cmsService;
    }

    public function index(Request $request)
    {
        $posts = $this->cmsService->getPosts([
            'type' => $request->get('type'),
            'category_id' => $request->get('category'),
            'search' => $request->get('search'),
            'limit' => 12
        ])->paginate(12);

        $categories = $this->cmsService->getPostTypeCategories();
        $tags = $this->cmsService->getTagsByType();

        return view('blog.index', compact('posts', 'categories', 'tags'));
    }

    public function show($slug)
    {
        $post = Post::where('slug->' . app()->getLocale(), $slug)
            ->with(['category', 'tags', 'relatedService'])
            ->published()
            ->firstOrFail();

        $this->cmsService->incrementPostViews($post);
        
        $relatedPosts = $this->cmsService->getRelatedPosts($post);
        $popularPosts = $this->cmsService->getPopularPosts();

        return view('blog.show', compact('post', 'relatedPosts', 'popularPosts'));
    }
}
```

### 3. Blade Views Example

#### Layout with Navigation
```blade
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->getTranslation('meta_title', app()->getLocale()) }}</title>
    <meta name="description" content="{{ $post->getTranslation('meta_description', app()->getLocale()) }}">
</head>
<body>
    @php
        $headerMenu = app(App\Services\CmsService::class)->getNavigationMenu('header');
    @endphp
    
    <nav>
        @foreach($headerMenu->rootItems as $item)
            <a href="{{ $item->full_url }}" target="{{ $item->target }}">
                {{ $item->getTranslation('label', app()->getLocale()) }}
            </a>
        @endforeach
    </nav>

    @yield('content')
</body>
</html>
```

#### Post Display
```blade
@extends('layouts.app')

@section('content')
<article>
    <h1>{{ $post->getTranslation('title', app()->getLocale()) }}</h1>
    
    @if($post->cover_image_url)
        <img src="{{ $post->cover_image_url }}" alt="{{ $post->getTranslation('title', app()->getLocale()) }}">
    @endif
    
    <div class="meta">
        <span>{{ $post->published_at->format('M d, Y') }}</span>
        @if($post->category)
            <span>{{ $post->category->getTranslation('name', app()->getLocale()) }}</span>
        @endif
        <span>{{ $post->view_count }} views</span>
    </div>
    
    <div class="content">
        {!! $post->getTranslation('content', app()->getLocale()) !!}
    </div>
    
    @if($post->tags->count() > 0)
        <div class="tags">
            @foreach($post->tags as $tag)
                <span class="tag">{{ $tag->getTranslation('name', app()->getLocale()) }}</span>
            @endforeach
        </div>
    @endif
</article>
@endsection
```

### 4. Language Switching

Add language switcher to your layout:

```blade
<div class="language-switcher">
    <a href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['locale' => 'en'])) }}" 
       class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">English</a>
    <a href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['locale' => 'vi'])) }}" 
       class="{{ app()->getLocale() === 'vi' ? 'active' : '' }}">Tiếng Việt</a>
</div>
```

### 5. Routes

```php
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|vi']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations');
    Route::get('/destinations/{slug}', [DestinationController::class, 'show'])->name('destinations.show');
    Route::get('/travel-tips', [BlogController::class, 'index'])->name('travel-tips');
    Route::get('/travel-tips/{slug}', [BlogController::class, 'show'])->name('travel-tips.show');
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
});
```

## Content Management Workflow

### 1. Creating Categories
1. Go to Categories in admin panel
2. Create destination categories with region grouping
3. Create post type categories for content organization

### 2. Creating Posts
1. Navigate to Posts in admin panel
2. Fill in English and Vietnamese content in tabs
3. Select post type and category
4. Add cover image and gallery
5. Set publish date and status
6. Add tags and related posts
7. Configure SEO metadata

### 3. Managing Navigation
1. Go to Navigation Menus
2. Create menus for different locations (header, footer, etc.)
3. Add menu items with hierarchical structure
4. Set URLs and target windows

### 4. Tag Management
1. Create tags with appropriate types
2. Assign tags to posts for better organization
3. Use tags for filtering and related content

## SEO Optimization

### Meta Tags
- Each post has translatable meta title and description
- SEO keywords field for additional optimization
- Automatic slug generation from titles

### Content Structure
- Hierarchical categories for better organization
- Related posts for internal linking
- Tag system for content discovery
- Featured posts for homepage highlighting

### Performance
- Eager loading of relationships
- Database indexing on frequently queried fields
- Media optimization with Spatie MediaLibrary

## Customization

### Adding New Post Types
1. Add new type to the enum in Post model
2. Update PostResource form options
3. Add corresponding category if needed

### Adding New Languages
1. Update `config/translatable.php` locales array
2. Add new language tabs to Filament forms
3. Update frontend language switcher

### Custom Fields
1. Add new translatable fields to models
2. Update migrations and forms
3. Add to `$translatable` arrays in models

## Best Practices

### Content Management
- Always provide content in both languages
- Use descriptive slugs for better SEO
- Add relevant tags for content discovery
- Set appropriate publish dates
- Use featured posts sparingly

### Performance
- Use eager loading for relationships
- Implement caching for frequently accessed content
- Optimize images before upload
- Use database indexes on search fields

### SEO
- Write unique meta descriptions for each post
- Use relevant keywords naturally in content
- Create internal links between related posts
- Optimize image alt texts

## Support

For questions or issues:
1. Check the Laravel and FilamentPHP documentation
2. Review the Spatie package documentation
3. Check the database migrations for field structures
4. Use the CMS service class for frontend integration

## License

This CMS is built for Saigon Limousine and follows Laravel's MIT license. 