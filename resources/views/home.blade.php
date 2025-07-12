@extends('layouts.app')

@php
    $destinations = [
        [ 'name' => 'Phú Quốc', 'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80', 'count' => 734 ],
        [ 'name' => 'Đà Lạt', 'image' => 'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=800&q=80', 'count' => 923 ],
        [ 'name' => 'Quy Nhơn', 'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80', 'count' => 296 ],
        [ 'name' => 'Vũng Tàu', 'image' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=800&q=80', 'count' => 587 ],
        [ 'name' => 'Nha Trang', 'image' => 'https://images.unsplash.com/photo-1502082553048-f009c37129b9?auto=format&fit=crop&w=800&q=80', 'count' => 876 ],
        [ 'name' => 'Đà Nẵng', 'image' => 'https://images.unsplash.com/photo-1509228468518-180dd4864904?auto=format&fit=crop&w=800&q=80', 'count' => 1145 ],
        [ 'name' => 'Phan Thiết', 'image' => 'https://images.unsplash.com/photo-1465156799763-2c087c332922?auto=format&fit=crop&w=800&q=80', 'count' => 312 ],
        [ 'name' => 'Phú Yên', 'image' => 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=800&q=80', 'count' => 15 ],
    ];
@endphp

@section('content')
    <!-- Top Deal / Combo Banner Section -->
    <section class="relative bg-gradient-to-r from-blue-600 to-purple-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
                    {{ __('home.discover_vietnam') }}
                </h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    {{ __('home.hero_subtitle') }}
                </p>
            </div>
            
            <!-- Banner Slider -->
            <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                <div class="flex transition-transform duration-500 ease-in-out" id="bannerSlider">
                    <!-- Banner 1 -->
                    <div class="w-full flex-shrink-0 relative">
                        <div class="relative h-96 md:h-[500px] bg-gradient-to-r from-blue-900/80 to-purple-900/80">
                            <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                                 alt="Victoria Xiengthong" 
                                 class="absolute inset-0 w-full h-full object-cover mix-blend-multiply">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/60 to-purple-900/60"></div>
                            
                            <div class="relative z-10 h-full flex items-center">
                                <div class="max-w-2xl mx-auto text-center text-white px-8">
                                    <div class="inline-block bg-red-500 text-white text-sm font-bold px-4 py-2 rounded-full mb-4">
                                        {{ __('home.save_up_to_36') }}
                                    </div>
                                    <h2 class="text-3xl md:text-5xl font-bold mb-4">Victoria Xiengthong</h2>
                                    <p class="text-xl md:text-2xl mb-6">{{ __('Combo 4N3Đ') }}</p>
                                    <div class="text-3xl md:text-4xl font-bold text-yellow-400 mb-6">
                                        9.399.000đ/{{ __('home.guest') }}
                                    </div>
                                    <button class="bg-white text-blue-600 font-bold py-4 px-8 rounded-full hover:bg-gray-100 transition-colors duration-200">
                                        {{ __('home.book_now') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Banner 2 -->
                    <div class="w-full flex-shrink-0 relative">
                        <div class="relative h-96 md:h-[500px] bg-gradient-to-r from-green-900/80 to-blue-900/80">
                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                                 alt="Phu Quoc Paradise" 
                                 class="absolute inset-0 w-full h-full object-cover mix-blend-multiply">
                            <div class="absolute inset-0 bg-gradient-to-r from-green-900/60 to-blue-900/60"></div>
                            
                            <div class="relative z-10 h-full flex items-center">
                                <div class="max-w-2xl mx-auto text-center text-white px-8">
                                    <div class="inline-block bg-red-500 text-white text-sm font-bold px-4 py-2 rounded-full mb-4">
                                        {{ __('home.save_up_to_42') }}
                                    </div>
                                    <h2 class="text-3xl md:text-5xl font-bold mb-4">{{ __('home.island_paradise') }}</h2>
                                    <p class="text-xl md:text-2xl mb-6">{{ __('Combo 5N4Đ') }}</p>
                                    <div class="text-3xl md:text-4xl font-bold text-yellow-400 mb-6">
                                        12.599.000đ/{{ __('home.guest') }}
                                    </div>
                                    <button class="bg-white text-green-600 font-bold py-4 px-8 rounded-full hover:bg-gray-100 transition-colors duration-200">
                                        {{ __('home.book_now') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Banner 3 -->
                    <div class="w-full flex-shrink-0 relative">
                        <div class="relative h-96 md:h-[500px] bg-gradient-to-r from-orange-900/80 to-red-900/80">
                            <img src="https://images.unsplash.com/photo-1528127269322-539801943592?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                                 alt="Hanoi Heritage" 
                                 class="absolute inset-0 w-full h-full object-cover mix-blend-multiply">
                            <div class="absolute inset-0 bg-gradient-to-r from-orange-900/60 to-red-900/60"></div>
                            
                            <div class="relative z-10 h-full flex items-center">
                                <div class="max-w-2xl mx-auto text-center text-white px-8">
                                    <div class="inline-block bg-red-500 text-white text-sm font-bold px-4 py-2 rounded-full mb-4">
                                        {{ __('home.save_up_to_28') }}
                                    </div>
                                    <h2 class="text-3xl md:text-5xl font-bold mb-4">{{ __('home.capital_city') }}</h2>
                                    <p class="text-xl md:text-2xl mb-6">{{ __('Combo 3N2Đ') }}</p>
                                    <div class="text-3xl md:text-4xl font-bold text-yellow-400 mb-6">
                                        6.899.000đ/{{ __('home.guest') }}
                                    </div>
                                    <button class="bg-white text-orange-600 font-bold py-4 px-8 rounded-full hover:bg-gray-100 transition-colors duration-200">
                                        {{ __('home.book_now') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Slider Navigation -->
                <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-colors duration-200" onclick="changeSlide(-1)">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-colors duration-200" onclick="changeSlide(1)">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                
                <!-- Slider Dots -->
                <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2">
                    <button class="w-3 h-3 bg-white/50 rounded-full hover:bg-white transition-colors duration-200" onclick="goToSlide(0)"></button>
                    <button class="w-3 h-3 bg-white/50 rounded-full hover:bg-white transition-colors duration-200" onclick="goToSlide(1)"></button>
                    <button class="w-3 h-3 bg-white/50 rounded-full hover:bg-white transition-colors duration-200" onclick="goToSlide(2)"></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Services (iVIVU style) -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">{{ __('home.our_premium_services') }}</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    {{ __('home.services_subtitle') }}
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredServices as $index => $service)
                    @php
                        $randomImages = [
                            'https://images.unsplash.com/photo-1559827260-dc66d52bef19?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'https://images.unsplash.com/photo-1528127269322-539801943592?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'https://images.unsplash.com/photo-1513151233558-d860c5398176?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'https://images.unsplash.com/photo-1540555700478-4be289fbecef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        ];
                        $randomImage = $randomImages[$index % count($randomImages)];
                        $destName = $service->getTranslation('name', app()->getLocale());
                    @endphp
                    <div class="relative rounded-xl overflow-hidden group transition-all duration-300 ease-in-out hover:scale-105" style="min-height:320px;">
                        <img src="{{ $randomImage }}" alt="{{ $destName }}" class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-500 group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent z-10 transition-colors duration-300 group-hover:from-black/80"></div>
                        <div class="relative z-20 flex flex-col justify-end h-full p-6">
                            <h3 class="text-white text-2xl font-bold mb-2 drop-shadow-lg">HCM to {{ $destName }}</h3>
                            <p class="text-white text-base mb-2 drop-shadow">{{ $service->getTranslation('short_description', app()->getLocale()) }}</p>
                            <div class="flex items-center space-x-3 mt-2">
                                <span class="text-orange-400 text-lg font-bold">{{ number_format($service->price) }} VND</span>
                                <a href="#" class="text-white underline font-semibold hover:text-orange-400 transition-colors text-sm">{{ __('home.view_details') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @for($i = count($featuredServices); $i < 6; $i++)
                    @php
                        $placeholderImages = [
                            'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80',
                            'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=800&q=80',
                        ];
                        $placeholderTitles = ['HCM to Phú Quốc', 'HCM to Đà Lạt'];
                        $placeholderDescs = [
                            'Khám phá đảo ngọc Phú Quốc với dịch vụ cao cấp.',
                            'Trải nghiệm không khí mát lành của Đà Lạt cùng dịch vụ tiện nghi.'
                        ];
                        $placeholderPrices = [1999000, 1599000];
                        $img = $placeholderImages[$i - count($featuredServices)];
                        $title = $placeholderTitles[$i - count($featuredServices)];
                        $desc = $placeholderDescs[$i - count($featuredServices)];
                        $price = $placeholderPrices[$i - count($featuredServices)];
                    @endphp
                    <div class="relative rounded-xl overflow-hidden group transition-all duration-300 ease-in-out hover:scale-105" style="min-height:320px;">
                        <img src="{{ $img }}" alt="{{ $title }}" class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-500 group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent z-10 transition-colors duration-300 group-hover:from-black/80"></div>
                        <div class="relative z-20 flex flex-col justify-end h-full p-6">
                            <h3 class="text-white text-2xl font-bold mb-2 drop-shadow-lg">{{ $title }}</h3>
                            <p class="text-white text-base mb-2 drop-shadow">{{ $desc }}</p>
                            <div class="flex items-center space-x-3 mt-2">
                                <span class="text-orange-400 text-lg font-bold">{{ number_format($price) }} VND</span>
                                <a href="#" class="text-white underline font-semibold hover:text-orange-400 transition-colors text-sm">{{ __('home.view_details') }}</a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Summer Mood Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    {{ __('home.kickstart_summer') }}
                </h2>
                <p class="text-xl text-gray-600">
                    {{ __('home.grab_bag_go') }}
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Club Experience -->
                <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative h-64">
                        <img src="https://images.unsplash.com/photo-1513151233558-d860c5398176?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Club Experience" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ __('home.club_experience') }}</h3>
                            <p class="text-blue-200 mb-3">{{ __('home.party_entertainment') }}</p>
                            <p class="text-sm text-gray-300">156 {{ __('home.hotels_available') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Wellness Experience -->
                <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative h-64">
                        <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Wellness Experience" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ __('home.wellness_experience') }}</h3>
                            <p class="text-green-200 mb-3">{{ __('home.spa_relaxation') }}</p>
                            <p class="text-sm text-gray-300">89 {{ __('home.spas_available') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Luxury Experience -->
                <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative h-64">
                        <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Luxury Experience" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ __('home.luxury_experience') }}</h3>
                            <p class="text-yellow-200 mb-3">{{ __('home.premium_exclusive') }}</p>
                            <p class="text-sm text-gray-300">234 {{ __('home.luxury_cars_available') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Gift Voucher -->
                <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative h-64">
                        <img src="https://images.unsplash.com/photo-1607082349566-187342175e2f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Gift Voucher" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ __('home.gift_voucher') }}</h3>
                            <p class="text-purple-200 mb-3">{{ __('home.perfect_gift_idea') }}</p>
                            <p class="text-sm text-gray-300">{{ __('home.flexible_packages') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Favorite Destinations in Vietnam (Simple 4x3 grid) -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    {{ __('home.top_favorite_destinations') }}
                </h2>
                <p class="text-xl text-gray-600">
                    {{ __('home.explore_beaches_mountains') }}
                </p>
            </div>
            @php
                $allDestinations = $destinations;
                // If less than 12, repeat or add placeholders
                while (count($allDestinations) < 12) {
                    $allDestinations[] = [
                        'name' => 'Coming Soon',
                        'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80',
                        'count' => rand(10, 100),
                    ];
                }
                $allDestinations = array_slice($allDestinations, 0, 12);
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($allDestinations as $destination)
                    <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                        <img src="{{ $destination['image'] }}" alt="{{ $destination['name'] }}" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <div class="text-white text-lg font-bold mb-1">{{ $destination['name'] }}</div>
                            <div class="text-white text-xs">{{ $destination['count'] }} khách sạn</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">{{ __('home.why_choose_us') }}</h2>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    {{ __('home.why_choose_subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Luxury -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-white/30 transition-colors duration-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">{{ __('home.luxury_vehicles') }}</h3>
                    <p class="text-blue-100">{{ __('home.luxury_vehicles_desc') }}</p>
                </div>

                <!-- Safety -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-white/30 transition-colors duration-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">{{ __('home.safety_first') }}</h3>
                    <p class="text-blue-100">{{ __('home.safety_first_desc') }}</p>
                </div>

                <!-- English Speaking -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-white/30 transition-colors duration-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">{{ __('home.english_speaking') }}</h3>
                    <p class="text-blue-100">{{ __('home.english_speaking_desc') }}</p>
                </div>

                <!-- 24/7 Support -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-white/30 transition-colors duration-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">{{ __('home.support_24_7') }}</h3>
                    <p class="text-blue-100">{{ __('home.support_24_7_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Feedback Grid -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('What Our Customers Say') }}</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">{{ __('home.testimonials_subtitle') }}</p>
            </div>
            
            @if($testimonials->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($testimonials as $testimonial)
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 p-8 flex flex-col items-center text-center h-full border border-gray-200">
                            <!-- Quote Icon -->
                            <div class="mb-6">
                                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Customer Avatar (if available) -->
                            @if($testimonial->cover_image_url)
                                <div class="mb-4">
                                    <img src="{{ $testimonial->cover_image_url }}" 
                                         alt="{{ $testimonial->getTranslation('title', app()->getLocale()) }}" 
                                         class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg">
                                </div>
                            @endif
                            
                            <!-- Testimonial Text -->
                            <blockquote class="text-lg text-gray-700 italic mb-6 flex-grow">
                                "{{ Str::limit($testimonial->getTranslation('short_description', app()->getLocale()), 200) }}"
                            </blockquote>
                            
                            <!-- Customer Name -->
                            <div class="font-semibold text-blue-700 mb-2 text-lg">
                                {{ $testimonial->getTranslation('title', app()->getLocale()) ?? 'Happy Customer' }}
                            </div>
                            
                            <!-- Star Rating -->
                            <div class="flex justify-center text-yellow-400 mb-3">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            
                            <!-- Service/Destination (if related) -->
                            @if($testimonial->relatedService)
                                <div class="text-sm text-gray-500">
                                    {{ __('Service') }}: {{ $testimonial->relatedService->getTranslation('name', app()->getLocale()) }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback when no testimonials -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">{{ __('No testimonials yet') }}</h3>
                    <p class="text-gray-500">{{ __('Be the first to share your experience!') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Recent Blog Posts -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">{{ __('home.latest_from_blog') }}</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    {{ __('home.blog_subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($recentPosts as $post)
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                        <div class="flex">
                            <!-- Thumbnail -->
                            <div class="w-24 h-24 flex-shrink-0">
                                @if($post->cover_image_url)
                                    <img src="{{ $post->cover_image_url }}" 
                                         alt="{{ $post->getTranslation('title', app()->getLocale()) }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1 p-4">
                                <div class="text-xs text-gray-500 mb-1">
                                    {{ $post->type }} • {{ $post->published_at->format('M d, Y') }}
                                </div>
                                <h3 class="text-sm font-semibold text-gray-900 mb-2 line-clamp-2">
                                    {{ $post->getTranslation('title', app()->getLocale()) }}
                                </h3>
                                <p class="text-xs text-gray-600 mb-3 line-clamp-2">
                                    {{ Str::limit($post->getTranslation('short_description', app()->getLocale()), 80) }}
                                </p>
                                <a href="#" class="text-xs text-blue-600 hover:text-blue-700 font-semibold">
                                    {{ __('home.read_more') }} →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Banner Slider JavaScript -->
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('#bannerSlider > div');
        const totalSlides = slides.length;

        function showSlide(index) {
            if (index >= totalSlides) currentSlide = 0;
            if (index < 0) currentSlide = totalSlides - 1;
            
            const offset = -currentSlide * 100;
            document.getElementById('bannerSlider').style.transform = `translateX(${offset}%)`;
        }

        function changeSlide(direction) {
            currentSlide += direction;
            showSlide(currentSlide);
        }

        function goToSlide(index) {
            currentSlide = index;
            showSlide(currentSlide);
        }

        // Auto-slide every 5 seconds
        setInterval(() => {
            changeSlide(1);
        }, 5000);

        // Initialize first slide
        showSlide(0);
    </script>
@endsection 