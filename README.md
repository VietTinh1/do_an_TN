- composer install
- npm install 
- composer require barryvdh/laravel-dompdf
->docs(https://github.com/barryvdh/laravel-dompdf)
- composer require maatwebsite/excel
->docs(https://docs.laravel-excel.com/3.1/getting-started/installation.html)
- npm i bootstrap@5.2.0-beta1
- thanh toan online:composer require phpviet/laravel-omnipay(https://github.com/phpviet/laravel-omnipay)
-load images:
+ php artisan storage:link
+ src=" {{ asset('/storage/'.$post->image) }}" 
+asset img: <img src="{{ url('storage/images/'.$invoiceProvides->image_url) }}" alt="" title="" width="100px" />


-quy trình chạy:
--fresh migrate
--seed acc,alltype
-- tạo nhà cung cấp
-- hd nhập->tạo mới tất cả "Thêm loại???"-> Tạo mới sp


->chỉnh thêm edit hd nhập, xuất
