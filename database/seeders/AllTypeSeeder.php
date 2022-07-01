<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AllTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp=[
            [
                'classify'=>'Bảo mật',
                'name_classify'=>'Mở khóa khuôn mặt'
            ],
            [
                'classify'=>'Bảo mật',
                'name_classify'=>'Mở khóa vân tay cạnh viền'
            ],
            [
                'classify'=>'Bảo mật',
                'name_classify'=>'Mở khóa vân tay'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'AI camera'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'HDR'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Nhận diện khuôn mặt'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Quay video Full HD'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Quay video HD'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Tự động lấy nét (AF)'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Xóa phông'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Góc rộng (Wide)'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Góc siêu rộng (Ultrawide)'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Siêu cận (Macro)'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Chạm lấy nét'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Làm đẹp'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Nhận diện khuôn mặt'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Toàn cảnh (Panorama)'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Ban đêm (Night Mode)'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Bộ lọc màu'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Chuyên nghiệp (Pro)'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Chống rung quang học (OIS)'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Chụp bằng cử chỉ'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Chụp bằng giọng nói'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Live Photo'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Quay chậm (Slow Motion)'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Quay Siêu chậm (Super Slow Motion)'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Quay video hiển thị kép'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Toàn cảnh (Panorama)'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Trôi nhanh thời gian (Time Lapse)'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Zoom kỹ thuật số'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Zoom quang học'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'PixelMaster'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Quay video 4K'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Quay video Full HD'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Quay video HD'
            ],
            [
                'classify'=>'Tính năng camera',
                'name_classify'=>'Chụp đêm'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Chạm 2 lần sáng màn hình'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Chặn cuộc gọi'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Chặn tin nhắn'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Không gian thứ hai (Thư mục bảo mật)'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Màn hình luôn hiển thị AOD'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Samsung DeX (Kết nối màn hình sử dụng giao diện tương tự PC)'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Samsung Pay'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Thu nhỏ màn hình sử dụng một tay'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Tối ưu game (Game Booster)'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Âm thanh AKG'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Âm thanh Dolby Atmos'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Đa cửa sổ (chia đôi màn hình)'
            ],
            [
                'classify'=>'Ghi âm',
                'name_classify'=>'Ghi âm cuộc gọi'
            ],
            [
                'classify'=>'Ghi âm',
                'name_classify'=>'Ghi âm mặc định'
            ],
            [
                'classify'=>'Ghi âm',
                'name_classify'=>'Ghi âm có microphone chuyên dụng chống ồn'
            ],
            [
                'classify'=>'Xem phim',
                'name_classify'=>'3GP'
            ],
            [
                'classify'=>'Xem phim',
                'name_classify'=>'AVI'
            ],
            [
                'classify'=>'Xem phim',
                'name_classify'=>'FLV'
            ],
            [
                'classify'=>'Xem phim',
                'name_classify'=>'MKV'
            ],
            [
                'classify'=>'Xem phim',
                'name_classify'=>'MP4'
            ],
            [
                'classify'=>'Xem phim',
                'name_classify'=>'H.264(MPEG4-AVC)'
            ],
            [
                'classify'=>'Xem phim',
                'name_classify'=>'Có'
            ],
            [
                'classify'=>'Nghe nhạc',
                'name_classify'=>'AAC'
            ],
            [
                'classify'=>'Nghe nhạc',
                'name_classify'=>'FLAC'
            ],
            [
                'classify'=>'Nghe nhạc',
                'name_classify'=>'Lossless'
            ],
            [
                'classify'=>'Nghe nhạc',
                'name_classify'=>'AMR'
            ],
            [
                'classify'=>'Nghe nhạc',
                'name_classify'=>'M4A'
            ],
            [
                'classify'=>'Nghe nhạc',
                'name_classify'=>'MP3'
            ],
            [
                'classify'=>'Nghe nhạc',
                'name_classify'=>'OGG'
            ],
            [
                'classify'=>'Nghe nhạc',
                'name_classify'=>'AAC'
            ],
            [
                'classify'=>'Nghe nhạc',
                'name_classify'=>'WAV'
            ],
            [
                'classify'=>'Nghe nhạc',
                'name_classify'=>'Có'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Loa kép'
            ],
            [
                'classify'=>'Tính năng',
                'name_classify'=>'Chạm 2 lần sáng màn hình'
            ],
            [
                'classify'=>'Wjfj',
                'name_classify'=>'Dual-band (2.4 GHz/5 GHz)'
            ],
            [
                'classify'=>'Wjfj',
                'name_classify'=>'Wi-Fi 802.11 a/b/g/n/ac/ax'
            ],
            [
                'classify'=>'Wjfj',
                'name_classify'=>'Wi-Fi hotspot'
            ],
            [
                'classify'=>'Wjfj',
                'name_classify'=>'Wi-Fi MIMO'
            ],
            [
                'classify'=>'Wjfj',
                'name_classify'=>'Wi-Fi Direct'
            ],
            [
                'classify'=>'Quay phim',
                'name_classify'=>'4K 2160p@30fps'
            ],
            [
                'classify'=>'Quay phim',
                'name_classify'=>'4K 2160p@60fps'
            ],
            [
                'classify'=>'Quay phim',
                'name_classify'=>'8K 4320p@24fps'
            ],
            [
                'classify'=>'Quay phim',
                'name_classify'=>'FullHD 1080p@240fps'
            ],
            [
                'classify'=>'Quay phim',
                'name_classify'=>'FullHD 1080p@30fps'
            ],
            [
                'classify'=>'Quay phim',
                'name_classify'=>'FullHD 1080p@60fps'
            ],
            [
                'classify'=>'Quay phim',
                'name_classify'=>'HD 720p@30fps'
            ],
            [
                'classify'=>'Quay phim',
                'name_classify'=>'HD 720p@960fps'
            ],
            [
                'classify'=>'Quay phim',
                'name_classify'=>'FullHD 1080p@120fps'
            ],
            [
                'classify'=>'Quay phim',
                'name_classify'=>'4K 2160p@24fps'
            ],
            [
                'classify'=>'Định vị',
                'name_classify'=>'GALILEO'
            ],
            [
                'classify'=>'Định vị',
                'name_classify'=>'GLONASS'
            ],
            [
                'classify'=>'Định vị',
                'name_classify'=>'GPS'
            ],
            [
                'classify'=>'Định vị',
                'name_classify'=>'BEIDOU'
            ],
            [
                'classify'=>'Định vị',
                'name_classify'=>'QZSS'
            ],
            [
                'classify'=>'Định vị',
                'name_classify'=>'iBeacon'
            ],
            [
                'classify'=>'bluetooth',
                'name_classify'=>'A2DP'
            ],
            [
                'classify'=>'bluetooth',
                'name_classify'=>'LE'
            ],
            [
                'classify'=>'bluetooth',
                'name_classify'=>'v5.0'
            ],
            [
                'classify'=>'bluetooth',
                'name_classify'=>'v5.2'
            ],
            [
                'classify'=>'bluetooth',
                'name_classify'=>'v5.1'
            ],
        ];
        DB::table('all_types')->insert($temp);
    }
}
