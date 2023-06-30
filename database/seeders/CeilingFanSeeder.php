<?php

namespace Database\Seeders;

use App\Models\Fans;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CeilingFanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Fans::create([
                'name' => 'Quạt trần Panasonic',
                'product_code' => 'F‑80ZBR',
                'slug' => 'Quạt trần Panasonichhhhhhh',
                'price' => 14390000,
                'description' => 'Panasonic F‑70ZBP sở hữu màu đen sang trọng, trang bị tới 6 cánh với đường kính 180mm, phù hợp sử dụng cho không gian phòng rộng rãi, giúp tản gió mát hiệu quả.<br/>
    Quạt trần Panasonic F‑70ZBP có chiều dài ti quạt là 40cm, lưu lượng gió đạt 310 m3/phút kết hợp với hướng gió thổi từ trên xuống mang lại cảm giác mát mẻ, dễ chịu.<br/>
Quạt trần 6 cánh có trọng lượng nặng 11.9kg, lắp đặt đơn giản. Quạt trang bị động cơ DC vận hành rất êm ái, tiết kiệm điện tối đa với công suất hoạt động là 51W. <br/>
Sản phẩm có 9 cấp độ gió để lựa chọn, phù hợp với mọi nhiệt độ thời tiết khác nhau. Với chức năng tạo gió tự nhiên giúp không gian phòng thoáng đãng hơn và dễ vào giấc ngủ hơn. <br/>
Khi vận hành quạt hoạt động vô cùng êm ái, không rung lắc tạo sự an toàn tối đa. Ngoài ra quạt trần còn tích hợp 3 cấp độ an toàn: Khóa cánh an toàn, dây an toàn, công tắc an toàn giúp người dùng yên tâm lựa chọn sản phẩm. <br/>
Cánh quạt 3D cho luồng gió mạnh mẽ và êm ái hơn. 6 cánh quạt được làm bằng chất liệu PPG (sợi thủy tinh) cho độ bền cao. Quạt trần quay với tốc độ từ 80 - 185 vòng/phút, tốc độ gió đạt 185 m/phút. <br/>
Không chỉ tích hợp những ưu điểm nổi bật trên, quạt trần Panasonic F‑70ZBP còn có 8 chế độ hẹn giờ tắt (1 - 8 giờ) và 8 chế độ hẹn giờ mở (1 - 8 giờ). Quạt còn trang bị cảm biến theo mức độ chuyển động của con người nhằm điều chỉnh lưu lượng gió phù hợp, giúp tiết kiệm điện năng tiêu thụ. Quạt đi kèm điều khiển từ xa.',
                'type_id' => 1,
                'brand_id' => 5,
                'technical_id' => 1
            ]);
        }
    }
}
