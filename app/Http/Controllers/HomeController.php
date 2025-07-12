<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Post;
use App\Models\Category;
use App\Models\NavigationMenu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Handle language switching
        if ($request->has('lang')) {
            $lang = $request->get('lang');
            if (in_array($lang, ['en', 'vi'])) {
                app()->setLocale($lang);
                session(['locale' => $lang]);
            }
        }

        $data = [
            'featuredServices' => Service::active()
                ->inRandomOrder()
                ->limit(8)
                ->get(),
            
            'featuredDestinations' => Post::published()
                ->byType('destination')
                ->featured()
                ->with('category')
                ->limit(6)
                ->get(),
            
            'recentPosts' => Post::published()
                ->whereIn('type', ['destination', 'travel_tips', 'itinerary', 'promotion'])
                ->with('category')
                ->latest('published_at')
                ->limit(4)
                ->get(),
            
            'testimonials' => Post::published()
                ->byType('review')
                ->with('category')
                ->latest('published_at')
                ->limit(6)
                ->get(),
            
            'headerMenu' => NavigationMenu::active()
                ->byLocation('header')
                ->with('items')
                ->first(),
            
            'footerMenu' => NavigationMenu::active()
                ->byLocation('footer')
                ->with('items')
                ->first(),
        ];

        return view('home', $data);
    }
}
