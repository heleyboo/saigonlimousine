<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Service;
use App\Models\Tag;
use App\Models\Post;
use App\Models\NavigationMenu;
use App\Models\NavigationItem;
use Illuminate\Support\Str;

class VietnamDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create Categories
        $this->createCategories();
        
        // Create Services
        $this->createServices();
        
        // Create Tags
        $this->createTags();
        
        // Create Posts
        $this->createPosts();
        
        // Create Navigation Menus
        $this->createNavigationMenus();
    }

    private function createCategories(): void
    {
        $categories = [
            // North Vietnam
            [
                'name' => ['en' => 'Hanoi', 'vi' => 'Hà Nội'],
                'slug' => ['en' => 'hanoi', 'vi' => 'ha-noi'],
                'description' => [
                    'en' => 'The capital city of Vietnam with rich history and culture',
                    'vi' => 'Thủ đô Việt Nam với lịch sử và văn hóa phong phú'
                ],
                'type' => 'destination',
                'region' => 'north',
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Ha Long Bay', 'vi' => 'Vịnh Hạ Long'],
                'slug' => ['en' => 'ha-long-bay', 'vi' => 'vinh-ha-long'],
                'description' => [
                    'en' => 'UNESCO World Heritage site with stunning limestone islands',
                    'vi' => 'Di sản thế giới UNESCO với những hòn đảo đá vôi tuyệt đẹp'
                ],
                'type' => 'destination',
                'region' => 'north',
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Sapa', 'vi' => 'Sa Pa'],
                'slug' => ['en' => 'sapa', 'vi' => 'sa-pa'],
                'description' => [
                    'en' => 'Mountainous region famous for trekking and ethnic culture',
                    'vi' => 'Vùng núi nổi tiếng với trekking và văn hóa dân tộc'
                ],
                'type' => 'destination',
                'region' => 'north',
                'is_active' => true,
            ],
            
            // Central Vietnam
            [
                'name' => ['en' => 'Hue', 'vi' => 'Huế'],
                'slug' => ['en' => 'hue', 'vi' => 'hue'],
                'description' => [
                    'en' => 'Former imperial capital with ancient citadel',
                    'vi' => 'Cố đô với kinh thành cổ kính'
                ],
                'type' => 'destination',
                'region' => 'central',
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Hoi An', 'vi' => 'Hội An'],
                'slug' => ['en' => 'hoi-an', 'vi' => 'hoi-an'],
                'description' => [
                    'en' => 'Ancient trading port with lantern-lit streets',
                    'vi' => 'Cảng thương mại cổ với phố đèn lồng'
                ],
                'type' => 'destination',
                'region' => 'central',
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Da Nang', 'vi' => 'Đà Nẵng'],
                'slug' => ['en' => 'da-nang', 'vi' => 'da-nang'],
                'description' => [
                    'en' => 'Coastal city with beautiful beaches and bridges',
                    'vi' => 'Thành phố biển với bãi biển và cầu đẹp'
                ],
                'type' => 'destination',
                'region' => 'central',
                'is_active' => true,
            ],
            
            // South Vietnam
            [
                'name' => ['en' => 'Ho Chi Minh City', 'vi' => 'Thành phố Hồ Chí Minh'],
                'slug' => ['en' => 'ho-chi-minh-city', 'vi' => 'thanh-pho-ho-chi-minh'],
                'description' => [
                    'en' => 'Modern metropolis with vibrant culture and cuisine',
                    'vi' => 'Đô thị hiện đại với văn hóa và ẩm thực sôi động'
                ],
                'type' => 'destination',
                'region' => 'south',
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Mekong Delta', 'vi' => 'Đồng bằng sông Cửu Long'],
                'slug' => ['en' => 'mekong-delta', 'vi' => 'dong-bang-song-cuu-long'],
                'description' => [
                    'en' => 'River delta with floating markets and rice fields',
                    'vi' => 'Đồng bằng sông với chợ nổi và ruộng lúa'
                ],
                'type' => 'destination',
                'region' => 'south',
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Phu Quoc', 'vi' => 'Phú Quốc'],
                'slug' => ['en' => 'phu-quoc', 'vi' => 'phu-quoc'],
                'description' => [
                    'en' => 'Tropical island paradise with pristine beaches',
                    'vi' => 'Thiên đường đảo nhiệt đới với bãi biển hoang sơ'
                ],
                'type' => 'destination',
                'region' => 'south',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }

    private function createServices(): void
    {
        $services = [
            [
                'name' => ['en' => 'Hanoi City Tour', 'vi' => 'Tour Hà Nội'],
                'slug' => ['en' => 'hanoi-city-tour', 'vi' => 'tour-ha-noi'],
                'description' => [
                    'en' => 'Explore the historic Old Quarter, Hoan Kiem Lake, and Temple of Literature',
                    'vi' => 'Khám phá Phố cổ, Hồ Hoàn Kiếm và Văn Miếu'
                ],
                'short_description' => [
                    'en' => 'Discover the heart of Vietnam\'s capital',
                    'vi' => 'Khám phá trái tim thủ đô Việt Nam'
                ],
                'price' => 850000,
                'duration' => '8 hours',
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Ha Long Bay Cruise', 'vi' => 'Du thuyền Vịnh Hạ Long'],
                'slug' => ['en' => 'ha-long-bay-cruise', 'vi' => 'du-thuyen-vinh-ha-long'],
                'description' => [
                    'en' => 'Luxury cruise through the stunning limestone karsts and emerald waters',
                    'vi' => 'Du thuyền sang trọng qua các đảo đá vôi và vùng biển xanh ngọc'
                ],
                'short_description' => [
                    'en' => 'Experience the wonder of Ha Long Bay',
                    'vi' => 'Trải nghiệm kỳ quan Vịnh Hạ Long'
                ],
                'price' => 2500000,
                'duration' => '2 days 1 night',
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Sapa Trekking Adventure', 'vi' => 'Trekking Sa Pa'],
                'slug' => ['en' => 'sapa-trekking-adventure', 'vi' => 'trekking-sa-pa'],
                'description' => [
                    'en' => 'Trek through terraced rice fields and visit ethnic minority villages',
                    'vi' => 'Trek qua ruộng bậc thang và thăm làng dân tộc thiểu số'
                ],
                'short_description' => [
                    'en' => 'Adventure in the misty mountains',
                    'vi' => 'Phiêu lưu trên núi sương mù'
                ],
                'price' => 1800000,
                'duration' => '3 days 2 nights',
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Hoi An Cultural Experience', 'vi' => 'Trải nghiệm văn hóa Hội An'],
                'slug' => ['en' => 'hoi-an-cultural-experience', 'vi' => 'trai-nghiem-van-hoa-hoi-an'],
                'description' => [
                    'en' => 'Immerse yourself in the ancient culture, lantern making, and cooking classes',
                    'vi' => 'Đắm chìm trong văn hóa cổ, làm đèn lồng và lớp học nấu ăn'
                ],
                'short_description' => [
                    'en' => 'Cultural immersion in ancient town',
                    'vi' => 'Đắm chìm văn hóa phố cổ'
                ],
                'price' => 1200000,
                'duration' => '1 day',
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Mekong Delta Discovery', 'vi' => 'Khám phá Đồng bằng sông Cửu Long'],
                'slug' => ['en' => 'mekong-delta-discovery', 'vi' => 'kham-pha-dong-bang-song-cuu-long'],
                'description' => [
                    'en' => 'Explore floating markets, coconut groves, and traditional villages',
                    'vi' => 'Khám phá chợ nổi, rừng dừa và làng truyền thống'
                ],
                'short_description' => [
                    'en' => 'Discover the rice bowl of Vietnam',
                    'vi' => 'Khám phá vựa lúa Việt Nam'
                ],
                'price' => 950000,
                'duration' => '1 day',
                'is_active' => true,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }
    }

    private function createTags(): void
    {
        $tags = [
            ['name' => ['en' => 'Beach', 'vi' => 'Biển'], 'type' => 'nature'],
            ['name' => ['en' => 'Mountain', 'vi' => 'Núi'], 'type' => 'nature'],
            ['name' => ['en' => 'Culture', 'vi' => 'Văn hóa'], 'type' => 'culture'],
            ['name' => ['en' => 'History', 'vi' => 'Lịch sử'], 'type' => 'historical'],
            ['name' => ['en' => 'Food', 'vi' => 'Ẩm thực'], 'type' => 'food'],
            ['name' => ['en' => 'Adventure', 'vi' => 'Phiêu lưu'], 'type' => 'adventure'],
            ['name' => ['en' => 'Relaxation', 'vi' => 'Thư giãn'], 'type' => 'relaxation'],
            ['name' => ['en' => 'Photography', 'vi' => 'Nhiếp ảnh'], 'type' => 'activity'],
            ['name' => ['en' => 'UNESCO', 'vi' => 'UNESCO'], 'type' => 'historical'],
            ['name' => ['en' => 'Local Experience', 'vi' => 'Trải nghiệm địa phương'], 'type' => 'culture'],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }
    }

    private function createPosts(): void
    {
        $posts = [
            [
                'title' => [
                    'en' => 'Discover the Magic of Ha Long Bay',
                    'vi' => 'Khám phá vẻ đẹp kỳ diệu của Vịnh Hạ Long'
                ],
                'slug' => [
                    'en' => 'discover-magic-ha-long-bay',
                    'vi' => 'kham-pha-ve-dep-ky-dieu-vinh-ha-long'
                ],
                'short_description' => [
                    'en' => 'Explore the stunning limestone karsts and emerald waters of this UNESCO World Heritage site',
                    'vi' => 'Khám phá những đảo đá vôi tuyệt đẹp và vùng biển xanh ngọc của di sản thế giới UNESCO'
                ],
                'content' => [
                    'en' => '<p>Ha Long Bay, a UNESCO World Heritage site, is one of Vietnam\'s most iconic destinations. With its thousands of limestone karsts and isles in various shapes and sizes, the bay offers a breathtaking landscape that has inspired poets and artists for centuries.</p><p>Our luxury cruise experience takes you through the most beautiful parts of the bay, where you can kayak through hidden caves, swim in crystal-clear waters, and watch spectacular sunsets from the deck of your boat.</p><p>Don\'t miss the opportunity to visit floating fishing villages and learn about the traditional way of life of the local people.</p>',
                    'vi' => '<p>Vịnh Hạ Long, di sản thế giới UNESCO, là một trong những điểm đến biểu tượng nhất của Việt Nam. Với hàng nghìn đảo đá vôi với nhiều hình dạng và kích thước khác nhau, vịnh mang đến cảnh quan ngoạn mục đã truyền cảm hứng cho các nhà thơ và nghệ sĩ trong nhiều thế kỷ.</p><p>Trải nghiệm du thuyền sang trọng của chúng tôi đưa bạn qua những phần đẹp nhất của vịnh, nơi bạn có thể chèo thuyền kayak qua các hang động ẩn, bơi trong vùng nước trong vắt và ngắm hoàng hôn ngoạn mục từ boong tàu.</p><p>Đừng bỏ lỡ cơ hội thăm các làng chài nổi và tìm hiểu về cách sống truyền thống của người dân địa phương.</p>'
                ],
                'meta_title' => [
                    'en' => 'Discover the Magic of Ha Long Bay',
                    'vi' => 'Khám phá vẻ đẹp kỳ diệu của Vịnh Hạ Long'
                ],
                'meta_description' => [
                    'en' => 'Explore the stunning limestone karsts and emerald waters of this UNESCO World Heritage site',
                    'vi' => 'Khám phá những đảo đá vôi tuyệt đẹp và vùng biển xanh ngọc của di sản thế giới UNESCO'
                ],
                'type' => 'destination',
                'category_id' => Category::where('slug->en', 'ha-long-bay')->first()->id,
                'related_service_id' => Service::where('slug->en', 'ha-long-bay-cruise')->first()->id,
                'status' => 'published',
                'published_at' => now(),
                'is_featured' => true,
                'seo_keywords' => ['ha long bay', 'vietnam', 'cruise', 'unesco', 'limestone'],
            ],
            [
                'title' => [
                    'en' => 'The Ancient Charm of Hoi An',
                    'vi' => 'Vẻ đẹp cổ kính của Hội An'
                ],
                'slug' => [
                    'en' => 'ancient-charm-hoi-an',
                    'vi' => 've-dep-co-kinh-hoi-an'
                ],
                'short_description' => [
                    'en' => 'Step back in time in this beautifully preserved ancient trading port',
                    'vi' => 'Quay ngược thời gian tại cảng thương mại cổ được bảo tồn đẹp mắt này'
                ],
                'content' => [
                    'en' => '<p>Hoi An, once a major trading port, is now a beautifully preserved ancient town that offers visitors a glimpse into Vietnam\'s rich cultural heritage. The town\'s architecture reflects a unique blend of Vietnamese, Chinese, and Japanese influences.</p><p>As evening falls, the town transforms into a magical place with thousands of colorful lanterns lighting up the streets. This is the perfect time to take a boat ride on the Thu Bon River or enjoy a traditional Vietnamese meal at one of the many excellent restaurants.</p><p>Don\'t forget to visit the Japanese Covered Bridge, the symbol of Hoi An, and explore the many tailor shops where you can have custom-made clothing created in just 24 hours.</p>',
                    'vi' => '<p>Hội An, từng là cảng thương mại lớn, giờ đây là phố cổ được bảo tồn đẹp mắt mang đến cho du khách cái nhìn về di sản văn hóa phong phú của Việt Nam. Kiến trúc của thị trấn phản ánh sự kết hợp độc đáo giữa ảnh hưởng Việt Nam, Trung Quốc và Nhật Bản.</p><p>Khi màn đêm buông xuống, thị trấn biến thành nơi kỳ diệu với hàng nghìn chiếc đèn lồng đầy màu sắc thắp sáng các con phố. Đây là thời điểm hoàn hảo để đi thuyền trên sông Thu Bồn hoặc thưởng thức bữa ăn truyền thống Việt Nam tại một trong nhiều nhà hàng tuyệt vời.</p><p>Đừng quên thăm Cầu Nhật Bản, biểu tượng của Hội An, và khám phá nhiều tiệm may nơi bạn có thể may quần áo theo yêu cầu chỉ trong 24 giờ.</p>'
                ],
                'meta_title' => [
                    'en' => 'The Ancient Charm of Hoi An',
                    'vi' => 'Vẻ đẹp cổ kính của Hội An'
                ],
                'meta_description' => [
                    'en' => 'Step back in time in this beautifully preserved ancient trading port',
                    'vi' => 'Quay ngược thời gian tại cảng thương mại cổ được bảo tồn đẹp mắt này'
                ],
                'type' => 'destination',
                'category_id' => Category::where('slug->en', 'hoi-an')->first()->id,
                'related_service_id' => Service::where('slug->en', 'hoi-an-cultural-experience')->first()->id,
                'status' => 'published',
                'published_at' => now(),
                'is_featured' => true,
                'seo_keywords' => ['hoi an', 'ancient town', 'lanterns', 'culture', 'vietnam'],
            ],
            [
                'title' => [
                    'en' => 'Sapa: Trekking in the Misty Mountains',
                    'vi' => 'Sa Pa: Trekking trên núi sương mù'
                ],
                'slug' => [
                    'en' => 'sapa-trekking-misty-mountains',
                    'vi' => 'sa-pa-trekking-nui-suong-mu'
                ],
                'short_description' => [
                    'en' => 'Experience the breathtaking beauty of Vietnam\'s northern mountains',
                    'vi' => 'Trải nghiệm vẻ đẹp ngoạn mục của núi rừng miền Bắc Việt Nam'
                ],
                'content' => [
                    'en' => '<p>Sapa, located in the Hoang Lien Son mountain range, is famous for its stunning terraced rice fields, ethnic minority villages, and challenging trekking routes. The region is home to several ethnic groups including the Hmong, Dao, and Tay people.</p><p>Our trekking adventure takes you through picturesque villages where you can learn about local customs, taste traditional food, and even stay overnight in a homestay. The views of the terraced rice fields, especially during the harvest season, are absolutely spectacular.</p><p>For the more adventurous, we offer challenging treks to Fansipan, the highest peak in Indochina, standing at 3,143 meters above sea level.</p>',
                    'vi' => '<p>Sa Pa, nằm trong dãy núi Hoàng Liên Sơn, nổi tiếng với ruộng bậc thang tuyệt đẹp, làng dân tộc thiểu số và các tuyến trekking thử thách. Khu vực này là nơi sinh sống của nhiều dân tộc bao gồm người H\'Mông, Dao và Tày.</p><p>Cuộc phiêu lưu trekking của chúng tôi đưa bạn qua các làng đẹp như tranh nơi bạn có thể tìm hiểu về phong tục địa phương, nếm thử món ăn truyền thống và thậm chí nghỉ qua đêm tại homestay. Cảnh quan ruộng bậc thang, đặc biệt trong mùa thu hoạch, thực sự ngoạn mục.</p><p>Đối với những người thích phiêu lưu hơn, chúng tôi cung cấp các chuyến trek thử thách đến Fansipan, đỉnh cao nhất Đông Dương, cao 3.143 mét so với mực nước biển.</p>'
                ],
                'meta_title' => [
                    'en' => 'Sapa: Trekking in the Misty Mountains',
                    'vi' => 'Sa Pa: Trekking trên núi sương mù'
                ],
                'meta_description' => [
                    'en' => 'Experience the breathtaking beauty of Vietnam\'s northern mountains',
                    'vi' => 'Trải nghiệm vẻ đẹp ngoạn mục của núi rừng miền Bắc Việt Nam'
                ],
                'type' => 'destination',
                'category_id' => Category::where('slug->en', 'sapa')->first()->id,
                'related_service_id' => Service::where('slug->en', 'sapa-trekking-adventure')->first()->id,
                'status' => 'published',
                'published_at' => now(),
                'is_featured' => false,
                'seo_keywords' => ['sapa', 'trekking', 'mountains', 'ethnic', 'vietnam'],
            ],
        ];

        foreach ($posts as $postData) {
            $post = Post::create($postData);
            
            // Attach relevant tags
            $tags = Tag::inRandomOrder()->limit(3)->get();
            foreach ($tags as $tag) {
                $post->attachTag($tag);
            }
        }
    }

    private function createNavigationMenus(): void
    {
        // Create Header Menu
        $headerMenu = NavigationMenu::updateOrCreate(
            ['location' => 'header'],
            [
                'name' => ['en' => 'Main Navigation', 'vi' => 'Menu chính'],
                'is_active' => true,
            ]
        );

        // Create Header Menu Items
        $headerItems = [
            [
                'label' => ['en' => 'Home', 'vi' => 'Trang chủ'],
                'url' => '/',
                'order_column' => 1,
            ],
            [
                'label' => ['en' => 'Destinations', 'vi' => 'Điểm đến'],
                'url' => '/destinations',
                'order_column' => 2,
            ],
            [
                'label' => ['en' => 'Services', 'vi' => 'Dịch vụ'],
                'url' => '/services',
                'order_column' => 3,
            ],
            [
                'label' => ['en' => 'About', 'vi' => 'Giới thiệu'],
                'url' => '/about',
                'order_column' => 4,
            ],
            [
                'label' => ['en' => 'Contact', 'vi' => 'Liên hệ'],
                'url' => '/contact',
                'order_column' => 5,
            ],
        ];

        foreach ($headerItems as $itemData) {
            NavigationItem::updateOrCreate(
                [
                    'navigation_menu_id' => $headerMenu->id,
                    'url' => $itemData['url'],
                ],
                array_merge($itemData, [
                    'navigation_menu_id' => $headerMenu->id,
                ])
            );
        }

        // Create Footer Menu
        $footerMenu = NavigationMenu::updateOrCreate(
            ['location' => 'footer'],
            [
                'name' => ['en' => 'Footer Links', 'vi' => 'Liên kết chân trang'],
                'is_active' => true,
            ]
        );

        // Create Footer Menu Items
        $footerItems = [
            [
                'label' => ['en' => 'Privacy Policy', 'vi' => 'Chính sách bảo mật'],
                'url' => '/privacy',
                'order_column' => 1,
            ],
            [
                'label' => ['en' => 'Terms of Service', 'vi' => 'Điều khoản dịch vụ'],
                'url' => '/terms',
                'order_column' => 2,
            ],
            [
                'label' => ['en' => 'FAQ', 'vi' => 'Câu hỏi thường gặp'],
                'url' => '/faq',
                'order_column' => 3,
            ],
        ];

        foreach ($footerItems as $itemData) {
            NavigationItem::updateOrCreate(
                [
                    'navigation_menu_id' => $footerMenu->id,
                    'url' => $itemData['url'],
                ],
                array_merge($itemData, [
                    'navigation_menu_id' => $footerMenu->id,
                ])
            );
        }
    }
}
