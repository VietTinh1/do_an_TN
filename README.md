- composer install
- npm install 
- composer require barryvdh/laravel-dompdf
->docs(https://github.com/barryvdh/laravel-dompdf)
- composer require maatwebsite/excel
->docs(https://docs.laravel-excel.com/3.1/getting-started/installation.html)
- npm i bootstrap@5.2.0-beta1
-load images:
+ php artisan storage:link
+ src=" {{ asset('/storage/'.$post->image) }}" 
+asset img: <img src="{{ url('storage/images/'.$invoiceProvides->image_url) }}" alt="" title="" width="100px" />


-quy trình chạy:
--fresh migrate
--seed acc
-- tạo nhà cung cấp
-- hd nhập->tạo mới tất cả "Thêm loại???"-> Tạo mới sp

_type trong model=>bang rieng

------Nghiên cứu join r làm tiếp sp,invoice
