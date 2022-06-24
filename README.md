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


<<<<<<< HEAD
Tính:
-> Chart index
=======
-------->fix view
----Ưu tiên: Xem database giải quyết input giới hạn số lượng kí tự(tới giới hạn không nhập thêm được, chứ không phải vẫn nhập rồi mất chữ sau): 
+ ưu tiên: provided(index,add,edit)
+ Kiểm tra view r sửa lại cho ok: nhà cung cấp, hóa đơn nhập
->update 19/6
- Thiếu: Check đồng bôj db



- Thêm view edit hdd nhập
- TÌnh trạng chô hóa đơn nhập
- Thêm dữ liệu trong edit sản phẩm

Đã xong: sp,ncc,hd nhap, sp nhập(trừ những cái mới ghi ở trên)


//công chuyện của bé Triều
-img //
-index,report
-chi tiết hóa đơn
-edit sản phẩm //
-edit,delete hóa đơn nhập

//postAddInvoiceProvided


//bug mới kkkk
-delete rồi edit hóa đơn nhập(tình trạng):ko đổi được tình trạng
-chi tiết hóa đơn bán
>>>>>>> 6f62f1a9e6c45070f14b0820a188e8ed81b17bbe
