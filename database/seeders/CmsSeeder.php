<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Service;
use App\Models\NavigationMenu;
use App\Models\NavigationItem;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create destination categories
        $this->createDestinationCategories();
        
        // Create post type categories
        $this->createPostTypeCategories();
        
        // Create tags
        $this->createTags();
        
        // Create services
        $this->createServices();
        
        // Create navigation menus
        $this->createNavigationMenus();
    }

    private function createDestinationCategories(): void
    {
        $categories = [
            [
                'name' => ['en' => 'Ho Chi Minh City', 'vi' => 'Thành phố Hồ Chí Minh'],
                'slug' => ['en' => 'ho-chi-minh-city', 'vi' => 'thanh-pho-ho-chi-minh'],
                'description' => [
                    'en' => 'The largest city in Vietnam, known for its vibrant culture and modern lifestyle',
                    'vi' => 'Thành phố lớn nhất Việt Nam, nổi tiếng với văn hóa sôi động và lối sống hiện đại'
                ],
                'type' => 'destination',
                'region' => 'south',
                'order_column' => 1,
            ],
            [
                'name' => ['en' => 'Hanoi', 'vi' => 'Hà Nội'],
                'slug' => ['en' => 'hanoi', 'vi' => 'ha-noi'],
                'description' => [
                    'en' => 'The capital city of Vietnam with rich history and traditional culture',
                    'vi' => 'Thủ đô Việt Nam với lịch sử phong phú và văn hóa truyền thống'
                ],
                'type' => 'destination',
                'region' => 'north',
                'order_column' => 2,
            ],
            [
                'name' => ['en' => 'Da Nang', 'vi' => 'Đà Nẵng'],
                'slug' => ['en' => 'da-nang', 'vi' => 'da-nang'],
                'description' => [
                    'en' => 'A coastal city known for its beautiful beaches and modern infrastructure',
                    'vi' => 'Thành phố biển nổi tiếng với những bãi biển đẹp và cơ sở hạ tầng hiện đại'
                ],
                'type' => 'destination',
                'region' => 'central',
                'order_column' => 3,
            ],
            [
                'name' => ['en' => 'Hoi An', 'vi' => 'Hội An'],
                'slug' => ['en' => 'hoi-an', 'vi' => 'hoi-an'],
                'description' => [
                    'en' => 'Ancient town with well-preserved architecture and lantern-lit streets',
                    'vi' => 'Phố cổ với kiến trúc được bảo tồn tốt và những con phố thắp đèn lồng'
                ],
                'type' => 'destination',
                'region' => 'central',
                'order_column' => 4,
            ],
            [
                'name' => ['en' => 'Ha Long Bay', 'vi' => 'Vịnh Hạ Long'],
                'slug' => ['en' => 'ha-long-bay', 'vi' => 'vinh-ha-long'],
                'description' => [
                    'en' => 'UNESCO World Heritage site with thousands of limestone islands',
                    'vi' => 'Di sản thế giới UNESCO với hàng nghìn hòn đảo đá vôi'
                ],
                'type' => 'destination',
                'region' => 'north',
                'order_column' => 5,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }

    private function createPostTypeCategories(): void
    {
        $categories = [
            [
                'name' => ['en' => 'Travel Destinations', 'vi' => 'Điểm đến du lịch'],
                'slug' => ['en' => 'travel-destinations', 'vi' => 'diem-den-du-lich'],
                'type' => 'post_type',
                'order_column' => 1,
            ],
            [
                'name' => ['en' => 'Travel Tips', 'vi' => 'Mẹo du lịch'],
                'slug' => ['en' => 'travel-tips', 'vi' => 'meo-du-lich'],
                'type' => 'post_type',
                'order_column' => 2,
            ],
            [
                'name' => ['en' => 'Suggested Itineraries', 'vi' => 'Lộ trình gợi ý'],
                'slug' => ['en' => 'suggested-itineraries', 'vi' => 'lo-trinh-goi-y'],
                'type' => 'post_type',
                'order_column' => 3,
            ],
            [
                'name' => ['en' => 'Promotions & News', 'vi' => 'Khuyến mãi & Tin tức'],
                'slug' => ['en' => 'promotions-news', 'vi' => 'khuyen-mai-tin-tuc'],
                'type' => 'post_type',
                'order_column' => 4,
            ],
            [
                'name' => ['en' => 'Customer Reviews', 'vi' => 'Đánh giá khách hàng'],
                'slug' => ['en' => 'customer-reviews', 'vi' => 'danh-gia-khach-hang'],
                'type' => 'post_type',
                'order_column' => 5,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }

    private function createTags(): void
    {
        $tags = [
            ['name' => ['en' => 'Beach', 'vi' => 'Biển'], 'type' => 'nature'],
            ['name' => ['en' => 'Mountain', 'vi' => 'Núi'], 'type' => 'nature'],
            ['name' => ['en' => 'Historical', 'vi' => 'Lịch sử'], 'type' => 'culture'],
            ['name' => ['en' => 'Food', 'vi' => 'Ẩm thực'], 'type' => 'food'],
            ['name' => ['en' => 'Culture', 'vi' => 'Văn hóa'], 'type' => 'culture'],
            ['name' => ['en' => 'Adventure', 'vi' => 'Phiêu lưu'], 'type' => 'activity'],
            ['name' => ['en' => 'Relaxation', 'vi' => 'Thư giãn'], 'type' => 'activity'],
            ['name' => ['en' => 'Shopping', 'vi' => 'Mua sắm'], 'type' => 'activity'],
            ['name' => ['en' => 'Nightlife', 'vi' => 'Cuộc sống về đêm'], 'type' => 'activity'],
            ['name' => ['en' => 'Photography', 'vi' => 'Nhiếp ảnh'], 'type' => 'activity'],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }
    }

    private function createServices(): void
    {
        $services = [
            [
                'name' => ['en' => 'Luxury Limousine Service', 'vi' => 'Dịch vụ Limousine cao cấp'],
                'description' => [
                    'en' => 'Premium limousine service for airport transfers and city tours',
                    'vi' => 'Dịch vụ limousine cao cấp cho đưa đón sân bay và tham quan thành phố'
                ],
                'type' => 'limousine',
            ],
            [
                'name' => ['en' => 'Airport Transfer Service', 'vi' => 'Dịch vụ đưa đón sân bay'],
                'description' => [
                    'en' => 'Reliable airport transfer service to and from major airports',
                    'vi' => 'Dịch vụ đưa đón sân bay đáng tin cậy đến và đi từ các sân bay lớn'
                ],
                'type' => 'airport_transfer',
            ],
            [
                'name' => ['en' => 'City Tour Service', 'vi' => 'Dịch vụ tham quan thành phố'],
                'description' => [
                    'en' => 'Guided city tours with professional drivers and comfortable vehicles',
                    'vi' => 'Tham quan thành phố có hướng dẫn với tài xế chuyên nghiệp và xe thoải mái'
                ],
                'type' => 'city_tour',
            ],
            [
                'name' => ['en' => 'Day Trip Service', 'vi' => 'Dịch vụ du lịch trong ngày'],
                'description' => [
                    'en' => 'Full-day excursion services to nearby attractions and destinations',
                    'vi' => 'Dịch vụ tham quan trọn ngày đến các điểm tham quan và điểm đến gần đó'
                ],
                'type' => 'day_trip',
            ],
            [
                'name' => ['en' => 'Wedding Limousine Service', 'vi' => 'Dịch vụ Limousine cưới hỏi'],
                'description' => [
                    'en' => 'Elegant limousine service for special wedding occasions',
                    'vi' => 'Dịch vụ limousine thanh lịch cho các dịp cưới hỏi đặc biệt'
                ],
                'type' => 'wedding_service',
            ],
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }
    }

    private function createNavigationMenus(): void
    {
        // Create header menu
        $headerMenu = NavigationMenu::create([
            'name' => ['en' => 'Header Menu', 'vi' => 'Menu đầu trang'],
            'location' => 'header',
            'is_active' => true,
        ]);

        // Create header menu items
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
                'label' => ['en' => 'Travel Tips', 'vi' => 'Mẹo du lịch'],
                'url' => '/travel-tips',
                'order_column' => 4,
            ],
            [
                'label' => ['en' => 'About', 'vi' => 'Giới thiệu'],
                'url' => '/about',
                'order_column' => 5,
            ],
            [
                'label' => ['en' => 'Contact', 'vi' => 'Liên hệ'],
                'url' => '/contact',
                'order_column' => 6,
            ],
        ];

        foreach ($headerItems as $itemData) {
            $headerMenu->items()->create($itemData);
        }

        // Create footer menu
        $footerMenu = NavigationMenu::create([
            'name' => ['en' => 'Footer Menu', 'vi' => 'Menu chân trang'],
            'location' => 'footer',
            'is_active' => true,
        ]);

        // Create footer menu items
        $footerItems = [
            [
                'label' => ['en' => 'Privacy Policy', 'vi' => 'Chính sách bảo mật'],
                'url' => '/privacy-policy',
                'order_column' => 1,
            ],
            [
                'label' => ['en' => 'Terms of Service', 'vi' => 'Điều khoản dịch vụ'],
                'url' => '/terms-of-service',
                'order_column' => 2,
            ],
            [
                'label' => ['en' => 'FAQ', 'vi' => 'Câu hỏi thường gặp'],
                'url' => '/faq',
                'order_column' => 3,
            ],
        ];

        foreach ($footerItems as $itemData) {
            $footerMenu->items()->create($itemData);
        }
    }
}
