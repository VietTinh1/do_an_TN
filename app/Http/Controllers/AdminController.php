<?php

namespace App\Http\Controllers;

use App\Exports\exportExcelInvoice;
use App\Exports\exportExcelProduct;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Provided;
use App\Models\UserDB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Str;
use App\Exports\exportExcelProvided;
use App\Exports\exportExcelUser;
use App\Imports\ProvidedImport;
use App\Models\Account;
use App\Models\InvoiceProvided;
use App\Models\InvoiceProvidedDetail;
use Maatwebsite\Excel\Facades\Excel;
use Prophecy\Call\Call;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\ModelNotFoundException;
use App\Http\Requests\AdminRequest;
use App\Models\AllType;
use App\Models\bluetooth;
use App\Models\Configuration;
use App\Models\Connection as ModelsConnection;
use App\Models\FeatureAdvance;
use App\Models\film;
use App\Models\FrontCamera;
use App\Models\FrontcameraFeature;
use App\Models\Gps;
use App\Models\ImageDetail;
use App\Models\Information;
use App\Models\Memory;
use App\Models\Music;
use App\Models\OperatingSystemCpu;
use App\Models\Pin;
use App\Models\RearCamera;
use App\Models\RearCameraFeature;
use App\Models\Record;
use App\Models\Screen;
use App\Models\SecurityAdvance;
use App\Models\Utilitie;
use App\Models\Video;
use App\Models\Wjfj;
use Exception;
use FTP\Connection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Trig\Secant;
use Ramsey\Uuid\FeatureSet;
use Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckAuth');
    }
    //TRANG CHỦ ADMIN
    public function index()
    {
        $product = Product::count();
        $countInvoiceOnMonth = Invoice::where([
            ['status', '=', 'Đã xử lí'],
            ['created_at', '=', Carbon::now()->month],
        ])->count();
        $countCustomer = Invoice::distinct()->count('name_customer');
        $outOfProduct = Product::where([
            ['status', '=', 'Đang hoạt động'],
            ['amount', '<', '10'],
        ])->count();
        $invoice = Invoice::orderByDesc('status')->take(4)->get();
        $newCustomer = Invoice::take(5)->latest()->get();
        //barChart
        $barChart = Account::all();
        $bar = [];
        foreach ($barChart as $barChart) {
            $bar[] = $barChart->id;
        }
        //lineChart
        $lineChart = Provided::all();
        $line = [];
        foreach ($lineChart as $lineChart) {
            $line[] = $lineChart->id;
        }
        return view('admin.src.index', compact('product', 'countInvoiceOnMonth', 'countCustomer', 'outOfProduct', 'invoice', 'newCustomer', 'barChart', 'bar', 'lineChart', 'line'));
    }

    //TRANG SẢN PHẨM ADMIN
    // Đang hoạt động/Hết hàng/Đã hủy
    public function product()
    {
        $product = Product::join('configuration','products.id','configuration.product_id')
                            ->join('image_details','image_details.id','configuration.image_detail_id')
                            ->join('front_cameras','front_cameras.id','configuration.front_id')
                                ->join('front_camera_features','front_cameras.id','front_camera_features.front_camera_id')
                            ->join('rear_cameras','rear_cameras.id','configuration.rear_camera_id')
                                ->join('rear_camera_features','rear_cameras.id','rear_camera_features.rear_camera_id')
                                ->join('films','rear_cameras.id','films.rear_camera_id')
                            ->join('operating_system_cpus','operating_system_cpus.id','configuration.operating_system_cpu_id')
                            ->join('memorys','memorys.id','configuration.memory_id')
                            ->join('informations','informations.id','configuration.information_id')
                            ->join('connections','connections.id','configuration.connection_id')
                                ->join('wjfjs','wjfjs.connection_id','connections.id')
                                ->join('gps','gps.connection_id','connections.id')
                                ->join('bluetooths','bluetooths.connection_id','connections.id')
                            ->join('utilities','utilities.id','configuration.utilities_id')
                                ->join('security_advances','security_advances.utilitie_id','utilities.id')
                                ->join('feature_advances','feature_advances.utilitie_id','utilities.id')
                                ->join('records','records.utilitie_id','utilities.id')
                                ->join('videos','videos.utilitie_id','utilities.id')
                                ->join('musics','musics.utilitie_id','utilities.id')
                            ->get();
        dd($product);
        return view('admin.src.product', compact('product'));
    }
    //add sản phẩm
    public function addProduct()
    {
        return view('admin.src.add_product');
    }
    public function postAddProduct(Request $request)
    {
        $describe = ' ';
        if (!empty($request->describe)) {
            $describe = $request->describe;
        }
        //them image sau
        $db = DB::table('products')->insert([
            'account_id' => Auth::id(),
            'name' => $request->name,
            'product_type_id' => $request->product_type_id,
            'provided_id' => $request->provided_id,
            'amount' => $request->amount,
            'price' => $request->price,
            'tax' => $request->tax,
            'images' => '',
            'describe' => $describe,
            'product_code' => Str::random(10),
        ]);
        Session()->flash('success', 'Thêm sản phẩm thành công');
        return redirect()->route('product');
    }
    //edit sản phẩm
    public function editProduct($id)
    {
        $product = Product::find($id);
        $productType = ProductType::all();
        return view('admin.src.edit_product', compact('product', 'productType'));
    }
    public function postEditProduct(Request $request, $id)
    {
        if ($request->hasFile('images')) {
            $request->validate([
                'images' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
            $request->images->store('images', 'public');

            $db = Product::where('id', $id)->update([
                'name' => $request->name,
                'trademark' => $request->trademark,
                'product_type_id' => $request->product_type_id,
                'images' => $request->images->hashName(),
                'price' => $request->price,
                'tax' => $request->tax,
                'describe' => $request->describe,
                'time_warranty' => $request->time_warranty,
                'sale' => $request->sale,
                'status' => $request->status,
                'updated_at' => Carbon::now(),
            ]);
            if ($db) {
                Session()->flash('success', 'Thay đổi dữ liệu sản phẩm thành công');
            } else {
                Session()->flash('success', 'Thay đổi dữ liệu sản phẩm thất bại');
            }
        } else {
            Session()->flash('success', 'Kiểm tra lại hình ảnh');
        }
        return redirect()->route('product');
    }
    public function deleteProduct($id)
    {
        $delete = DB::table('products')->where('id', '=', $id)->update(['status' => 'Dừng hoạt động']);
        Session()->flash('success', 'Xóa sản phẩm thành công');
        return redirect()->route('product');
    }

    //TRANG HÓA ĐƠN ADMIN
    public function invoice()
    {
        $data = DB::table('invoices')->join('invoice_details', 'invoices.id', '=', 'invoice_details.invoice_id')->latest('invoices.created_at')->get();
        return view('admin.src.invoice', compact('data'));
    }
    //add hóa đơn
    public function addInvoice()
    {
        $product = Product::all()->where('status', '=', "Đang hoạt động");
        return view('admin.src.add_invoice', compact('product'));
    }
    public function postAddInvoice(Request $request)
    {
        $input = $request->all();
        if (empty($request->note)) {
            $note = '';
        } else {
            $note = $request->note;
        }
        $data = DB::table('invoices')->insertGetId([
            'account_id' => Auth::id(),
            'name_customer' => $request->name,
            'email_customer' => $request->email,
            'phone' => $request->phone,
            'address_customer' => $request->address,
            'total' => $request->total,
            'message' => $request->note,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);
        $productDetailds = !empty($input['nameProduct']) ? $input['nameProduct'] : [];
        if ($data) {
            foreach ($productDetailds as $productDetaild) {
                $productId = (int)$productDetaild;
                $product = Product::find($productId);
                $addInvoiceDetail = DB::table('invoice_details')->insert([
                    'invoice_id' => $data,
                    'product_id' => $product->id,
                    'amount' => $product->amount,
                    'price' => $product->amount,
                    'discount' => '0',
                    'promotion' => '0',
                ]);
            }
            if ($addInvoiceDetail) {
                Session()->flash('success', 'Thêm hóa đơn thành công');
            } else {
                Session()->flash('success', 'Thêm chi tiết hóa đơn thất bại');
            }
        } else {
            Session()->flash('success', 'Thêm hóa đơn thất bại');
        }
        return redirect()->route('invoice');
    }
    //edit hóa đơn
    public function editInvoice($id)
    {
        $invoice = Invoice::find($id);
        return view('admin.src.edit_invoice', compact('invoice'));
    }
    public function postEditInvoice(Request $request, $id)
    {
        $name_customer = '';
        $email_customer = '';
        $phone = '';
        $address_customer = '';
        $message = '';
        if (!empty($request->name_customer)) {
            $name_customer = $request->name_customer;
        }
        if (!empty($request->email_customer)) {
            $email_customer = $request->email_customer;
        }
        if (!empty($request->phone)) {
            $phone = $request->phone;
        }
        if (!empty($request->address_customer)) {
            $address_customer = $request->address_customer;
        }
        if (!empty($request->message)) {
            $message = $request->message;
        }
        if (isset($request->status)) {
            $status = $request->status;
        }
        $update = DB::table('invoices')->where('id', $id)->update([
            'name_customer' => $name_customer,
            'email_customer' => $email_customer,
            'phone' => $phone,
            'address_customer' => $address_customer,
            'message' => $message,
            'status' => $status,
            'updated_at' => Carbon::now(),
        ]);
        Session()->flash('success', 'Thay đổi dữ liệu đơn hàng thành công');
        return redirect()->route('invoice');
    }
    public function deleteInvoice($id)
    {
        $delete = DB::table('invoices')->where('id', '=', $id)->update(['status' => 'Đã hủy']);
        Session()->flash('success', 'Xóa hóa đơn thành công');
        return redirect()->route('invoice');
    }
    //TRANG NHẬP HÓA ĐƠN
    public function invoiceProvided()
    {
        $invoiceProvides = DB::table('invoice_provides')->join('invoice_provided_details', 'invoice_provides.id', '=', 'invoice_provided_details.invoice_provided_id')->get();
        return view('admin.src.invoice_provided', compact('invoiceProvides'));
    }
    public function addInvoiceProvided()
    {
        $provided = Provided::all();
        $product = Product::all();
        return view('admin.src.add_invoice_provided', compact('provided', 'product'));
    }
    public function postAddInvoiceProvided(Request $request)
    {
        $total = $request->amount * $request->import_price;
        $invoiceProvided = InvoiceProvided::insertGetId([
            'provided_id' => $request->id_provided,
            'account_id' => Auth::id(),
            'total' => $total,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);
        if (!empty($invoiceProvided)) {
            $invoiceProvidedDetail = InvoiceProvidedDetail::insertGetId([
                'invoice_provided_id' => $invoiceProvided,
                'product_id' => $request->product_id,
                'amount' => $request->amount,
                'import_price' => $request->import_price,
                'time_warranty' => $request->time_warranty,
                'tax' => $request->tax,
                'created_at' => Carbon::now(),
            ]);
            //tim chi tiet nhap
            $temp = InvoiceProvidedDetail::find($invoiceProvidedDetail);
            //tim san pham
            $searchAmountProduct = Product::where('id', '=', $temp->product_id)->first();
            //tong
            $sumAmountProduct = $searchAmountProduct->amount + $temp->amount;
            $sumPrice = $temp->price + $temp->price * 0.1;
            if (!empty($invoiceProvidedDetail)) {
                // update table product
                $product = Product::where('id', '=', $temp->product_id)->update([
                    'amount' => $sumAmountProduct,
                    'price' => $sumPrice,
                    'time_warranty' => $temp->time_warranty,
                    'tax' => $temp->tax,
                    'updated_at' => Carbon::now(),
                ]);
                if (!empty($product)) {
                    Session()->flash('success', 'Thêm hóa đơn nhà cung cấp thành công');
                    return redirect()->route('invoiceProvided');
                }
            }
        }
        Session()->flash('success', 'Thêm hóa đơn nhà cung cấp thất bại');
        return redirect()->route('invoiceProvided');
    }
    public function addInvoiceProvidedNotYet()
    {
        $provided = Provided::all();
        $productType = ProductType::all();
        $security=AllType::security()->get();
        $cameraFeatureType1 =AllType::cameraFeature()->get();
        $cameraFeatureType2 =AllType::cameraFeature()->get();
        $film=AllType::film()->get();
        $record=AllType::record()->get();
        $video=AllType::video()->get();
        $music=AllType::music()->get();
        $wjfj=AllType::wjfj()->get();
        $gps=AllType::gps()->get();
        $feature=AllType::feature()->get();
        $bluetooth=AllType::bluetooth()->get();
        return view('admin.src.add_invoice_provided_not_yet',
             compact('provided', 'productType','security','cameraFeatureType1','cameraFeatureType2','film','record','video','music','wjfj','gps','feature','bluetooth'));
    }
    public function postAddInvoiceProvidedNotYet(AdminRequest $request)
    {
        try {
            $input = $request->all();
            //tong tien hs nhap
            $total = $request->amount * $request->import_price;
            if ($request->hasFile('front') && $request->hasFile('backside')) {
                $request->validate([
                    'front' => 'mimes:jpeg,bmp,png',
                    'backside' => 'mimes:jpeg,bmp,png',
                ]);
                $request->front->store('images', 'public');
                $request->backside->store('images', 'public');
                $invoiceProvided = InvoiceProvided::insertGetId([
                    'provided_id' => $request->provided_id,
                    'account_id' => Auth::id(),
                    'total' => $total,
                    'status' => $request->status,
                    'created_at' => Carbon::now(),
                ]);
                if (!empty($invoiceProvided)) {
                    $invoiceProvidedDetails = InvoiceProvidedDetail::insertGetId([
                        'invoice_provided_id' => $invoiceProvided,
                        'product_type_id' => $request->product_type_id,
                        'image_url_front' => $request->front->hashName(),
                        'image_url_backside' => $request->backside->hashName(),
                        'name' => $request->name,
                        'trademark' => $request->trademark,
                        'product_code' => $request->product_code,
                        'amount' => $request->amount,
                        'import_price' => $request->import_price,
                        'time_warranty' => $request->time_warranty,
                        'tax' => $request->tax,
                        'created_at' => Carbon::now(),
                    ]);
                    //tim ct hd nhap
                    $temp = InvoiceProvidedDetail::find($invoiceProvidedDetails);
                    //gia san pham= gia nhap+gia nhap * 0.1
                    $sumPrice = $temp->import_price + $temp->import_price * 0.1;
                    if (!empty($invoiceProvidedDetails)) {
                        //them bang sp
                        $product = Product::insertGetId([
                            'account_id' => Auth::id(),
                            'product_type_id' => $temp->product_type_id,
                            'name' =>$temp->name,
                            'trademark' => $temp->trademark,
                            'product_code' => $temp->product_code,
                            'amount' => $temp->amount,
                            'price' => $sumPrice,
                            'time_warranty' => $temp->time_warranty,
                            'tax' => $temp->tax,
                            'created_at' => Carbon::now(),
                        ]);
                        //tim id sp=>update id sp trong cthd nhap
                        $productCode = Product::find($product);
                        //them id vao sp
                        $addProductIdToInvoiceProvidedDetail = InvoiceProvidedDetail::where('product_code', '=', $productCode->product_code)->update([
                            'product_id' => $productCode->id,
                            'updated_at' => Carbon::now(),
                        ]);
                        if (!empty($product)) {
                            //id trong setting
                            $imageDetail=ImageDetail::insertGetId([
                                'front' =>$request->front->hashName(),
                                'backside' =>$request->backside->hashName(),
                                'created_at' =>Carbon::now(),
                            ]);
                            if(!empty($imageDetail)) {
                                //id trong setting
                                $screen=Screen::insertGetId([
                                    'screen_technology' =>$request->screen_technology,
                                    'resolution' =>$request->resolution,
                                    'width' =>$request->width,
                                    'maximum_brightness' =>$request->max_brightness,
                                    'touch_glass' =>$request->touch_glass,
                                    'created_at' => Carbon::now(),
                                ]);
                                if(!empty($screen)) {
                                    //id trong setting
                                    $frontCamera=FrontCamera::insertGetId([
                                        'resolution' =>$request->resolution,
                                        'created_at' => Carbon::now(),
                                    ]);
                                    $frontCameraDetail=!empty($input['name_front_camera_feature']) ? $input['name_front_camera_feature'] : [];
                                    if(!empty($frontCamera)) {
                                    foreach($frontCameraDetail as $frontCameraDetail) {
                                        $data=FrontcameraFeature::insert([
                                            'front_camera_id' =>$frontCamera,
                                            'name_front_camera_feature' =>$frontCameraDetail,
                                            'created_at' =>Carbon::now(),
                                        ]);
                                    }
                                    }
                                    else{
                                        Session()->flash('success', 'Thêm chi tiết camera trước thất bại');
                                        return redirect()->route('invoiceProvided');
                                    }
                                    //id trong setting
                                    $rearCamera=RearCamera::insertGetId([
                                        'main_rear_camera' =>$request->main_rear_camera,
                                        'main_secondary_1' =>$request->main_secondary_1,
                                        'main_secondary_2' =>$request->main_secondary_2,
                                        'flash_light' =>$request->flash_light,
                                        'created_at' =>Carbon::now(),
                                    ]);
                                    $rearCameraDetail=!empty($input['name_rear_camera_feature'])?$input['name_rear_camera_feature']:[];
                                    $film=!empty($input['film'])?$input['film']:[];
                                    if(!empty($rearCamera)){
                                        foreach($rearCameraDetail as $rearCameraDetail) {
                                            $data=RearCameraFeature::insertGetId([
                                                'rear_camera_id' =>$rearCamera,
                                                'name_rear_camera_feature' =>$rearCameraDetail,
                                                'created_at' =>Carbon::now(),
                                            ]);
                                        }
                                        foreach($film as $film) {
                                            $data=film::insertGetId([
                                                'rear_camera_id' =>$rearCamera,
                                                'name_film' =>$film,
                                                'created_at' =>Carbon::now(),
                                            ]);
                                        }
                                    }else{
                                        Session()->flash('success', 'Thêm chi tiết camera sau thất bại');
                                        return redirect()->route('invoiceProvided');
                                    }
                                    //id trong setting
                                    $operatingSystemCpu=OperatingSystemCpu::insertGetId([
                                        'operating_system_name' =>$request->operating_system_name,
                                        'chip_cpus' =>$request->chip_cpus,
                                        'speed_cpu' =>$request->speed_cpu,
                                        'gpu' =>$request->gpu,
                                        'created_at' =>Carbon::now(),
                                    ]);
                                    if(empty($operatingSystemCpu)){
                                        Session()->flash('success', 'Thêm chi tiết hệ điều hành, cpu thất bại');
                                        return redirect()->route('invoiceProvided');
                                    }
                                    //id trong setting
                                    $memory=Memory::insertGetId([
                                        'ram' =>$request->ram,
                                        'rom' =>$request->rom,
                                        'memory_available' =>$request->memory_available,
                                        'memory_stick' => $request->memory_stick,
                                        'phone_book' =>$request->phone_book,
                                        'created_at' => Carbon::now(),
                                    ]);
                                    if(empty($memory)){
                                        Session()->flash('success', 'Thêm chi tiết hệ điều hành, cpu thất bại');
                                        return redirect()->route('invoiceProvided');
                                    }
                                    //id trong setting
                                    $connect=ModelsConnection::insertGetId([
                                        'mobile_network' =>$request->mobile_network,
                                        'sim' => $request->sim,
                                        'charging_port' =>$request->charging_port,
                                        'head_phone' =>$request->head_phone,
                                        'connection_orther' =>$request->connection_orther,
                                        'created_at' => Carbon::now(),
                                    ]);
                                    $bluetooth=!empty($input['name_bluetooth'])?$input['name_bluetooth']:[];
                                    $wjfj=!empty($input['name_wjfj'])?$input['name_wjfj']:[];
                                    $gps=!empty($input['name_gps'])?$input['name_gps']:[];
                                    if(!empty($connect)){
                                        foreach($bluetooth as $bluetooth) {
                                            $data=bluetooth::insertGetId([
                                                'connection_id' =>$connect,
                                                'name_bluetooth' =>$bluetooth,
                                                'created_at' =>Carbon::now(),
                                            ]);
                                        }
                                        foreach($wjfj as $wjfj) {
                                            $data=Wjfj::insertGetId([
                                                'connection_id' =>$connect,
                                                'name_wjfj' =>$wjfj,
                                                'created_at' =>Carbon::now(),
                                            ]);
                                        }
                                        foreach($gps as $gps) {
                                            $data=Gps::insertGetId([
                                                'connection_id' =>$connect,
                                                'name_gps' =>$gps,
                                                'created_at' =>Carbon::now(),
                                            ]);
                                        }
                                    }else{
                                        Session()->flash('success', 'Thêm chi tiết kết nối thất bại');
                                        return redirect()->route('invoiceProvided');
                                    }
                                    //id trong setting
                                    $pin=Pin::insertGetId([
                                        'memory_pin' =>$request->memory_pin,
                                        'pin_type' => $request->pin_type,
                                        'support_pin_max' =>$request->support_pin_max,
                                        'charger' => $request->charger,
                                        'technology_pin' => $request->technology_pin,
                                        'created_at' => Carbon::now(),
                                    ]);
                                    if(empty($memory)){
                                        Session()->flash('success', 'Thêm thông tin pin thất bại');
                                        return redirect()->route('invoiceProvided');
                                    }
                                    //id trong setting
                                    $utiliti=Utilitie::insertGetId([
                                        'waterproof_dustproof' =>$request->waterproof_dustproof,
                                        'radio' => $request->radio,
                                        'created_at' => Carbon::now(),
                                    ]);
                                    $securityAdvanceType=!empty($input['security_advance_type'])?$input['security_advance_type']:[];
                                    $featureAdvance=!empty($input['feature_advance'])?$input['feature_advance']:[];
                                    $recordType=!empty($input['record_type'])?$input['record_type']:[];
                                    $videoType=!empty($input['video_type'])?$input['video_type']:[];
                                    $musicType=!empty($input['music_type'])?$input['music_type']:[];
                                    if(!empty($utiliti)){
                                        foreach($securityAdvanceType as $securityAdvanceType) {
                                            $data=SecurityAdvance::insertGetId([
                                                'utilitie_id' =>$utiliti,
                                                'name_security_advance' =>$securityAdvanceType,
                                                'created_at' =>Carbon::now(),
                                            ]);
                                        }
                                        foreach($featureAdvance as $featureAdvance) {
                                            $data=FeatureAdvance::insertGetId([
                                                'utilitie_id' =>$utiliti,
                                                'name_feature_advance' =>$featureAdvance,
                                                'created_at' =>Carbon::now(),
                                            ]);
                                        }
                                        foreach($recordType as $recordType) {
                                            $data=Record::insertGetId([
                                                'utilitie_id' =>$utiliti,
                                                'name_record' =>$recordType,
                                                'created_at' =>Carbon::now(),
                                            ]);
                                        }
                                        foreach($videoType as $videoType) {
                                            $data=Video::insertGetId([
                                                'utilitie_id' =>$utiliti,
                                                'name_video' =>$videoType,
                                                'created_at' =>Carbon::now(),
                                            ]);
                                        }
                                        foreach($musicType as $musicType) {
                                            $data=Music::insertGetId([
                                                'utilitie_id' =>$utiliti,
                                                'name_music' =>$musicType,
                                                'created_at' =>Carbon::now(),
                                            ]);
                                        }
                                    }
                                    //id trong setting
                                    $information=Information::insertGetId([
                                        'design' =>$request->design,
                                        'material' =>$request->design,
                                        'size_mass' =>$request->design,
                                        //ngay ra mat
                                        'describe' =>'123',
                                        'created_at' =>Carbon::now(),
                                    ]);
                                    $configuration=Configuration::insertGetId([
                                        'product_id' =>$product,
                                        'image_detail_id' =>$imageDetail,
                                        'screen_id' =>$screen,
                                        'front_id' =>$frontCamera,
                                        'rear_camera_id' =>$rearCamera,
                                        'operating_system_cpu_id' =>$operatingSystemCpu,
                                        'memory_id' =>$memory,
                                        'connection_id' =>$connect,
                                        'pin_id' =>$pin,
                                        'utilities_id' =>$utiliti,
                                        'information_id' =>$information,
                                        'created_at' =>Carbon::now(),
                                    ]);
                                    if($configuration){
                                        Session()->flash('success', 'Thêm hóa đơn nhà cung cấp thành công');
                                    }
                                }else{
                                    Session()->flash('success', 'Thêm camera trước thất bại');
                                }
                            }
                            else {
                                Session()->flash('success', 'Thêm hình ảnh sản phẩm thất bại');
                            }
                        }
                        else {
                            Session()->flash('success', 'Thêm hóa đơn nhà cung cấp thất bại');
                        }
                    }
                } else {
                    Session()->flash('success', 'Thêm hóa đơn nhà cung cấp thất bại');
                }
            } else {
                Session()->flash('success', 'Kiểm tra lại hình ảnh');
                return redirect()->back();
            }
            return redirect()->route('invoiceProvided');
        }catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function editInvoiceProvided($id)
    {
        $data = DB::table('invoice_provided_details')
            ->join('invoice_provides', 'invoice_provides.id', '=', 'invoice_provided_details.invoice_provided_id')
            ->join('products', 'invoice_provided_details.product_id', '=', 'products.id')
            ->first();
        $provided = Provided::all();
        $productType = ProductType::all();
        return view('admin.src.edit_invoice_provided', compact('data', 'provided', 'productType'));
    }
    public function postEditInvoiceProvided(Request $request, $id)
    {
        //update table invoice provided
        $invoiceProvided = InvoiceProvided::where('id', $id)->update(['provided_id' => $request->provided_id, 'updated_at' => Carbon::now(),]);
        $idInvoiceProvided = InvoiceProvided::where('id', $id)->first();
        $chenhLechSoLuong = $request->amount - $idInvoiceProvided->amount;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);
            $request->image->store('images', 'public');
            $invoiceProvidedDetail = InvoiceProvidedDetail::where('invoice_provided_id', $idInvoiceProvided->id)->update([
                'name' => $request->name,
                'trademark' => $request->trademark,
                'product_type_id' => $request->product_type_id,
                'image_url' => $request->image->hashName(),
                'product_code' => $request->product_code,
                'amount' => $request->amount,
                'import_price' => $request->import_price,
                'time_warranty' => $request->time_warranty,
                'tax' => $request->tax,
                'describe' => $request->describe,
                'updated_at' => Carbon::now(),
            ]);
            //tim id product trong  invoice_provided_details
            $idProduct = InvoiceProvidedDetail::where('invoice_provided_id', $idInvoiceProvided->id)->first();

            $countAmount = $idProduct->amount + $chenhLechSoLuong;
            $sumPrice = $idInvoiceProvided->import_price + $idInvoiceProvided->import_price * 0.1;

            $product = Product::where('id', $idInvoiceProvided->product_id)->update([
                'name' => $request->name,
                'trademark' => $request->trademark,
                'product_type_id' => $request->product_type_id,
                'product_code' => $request->product_code,
                'images' => $request->image->hashName(),
                'amount' => $countAmount,
                'price' => $sumPrice,
                'time_warranty' => $request->time_warranty,
                'tax' => $request->tax,
                'describe' => $request->describe,
                'updated_at' => Carbon::now(),
            ]);
            Session()->flash('success', 'Sửa dữ liệu thành công');
        } else {
            //k co hinh anh
            $invoiceProvidedDetail = InvoiceProvidedDetail::where('invoice_provided_id', $idInvoiceProvided->id)->update([
                'name' => $request->name,
                'trademark' => $request->trademark,
                'product_type_id' => $request->product_type_id,
                'product_code' => $request->product_code,
                'amount' => $request->amount,
                'import_price' => $request->import_price,
                'time_warranty' => $request->time_warranty,
                'tax' => $request->tax,
                'describe' => $request->describe,
                'updated_at' => Carbon::now(),
            ]);
            //tim id product trong  invoice_provided_details
            $idProduct = InvoiceProvidedDetail::where('invoice_provided_id', $idInvoiceProvided->id)->first();

            $countAmount = $idProduct->amount + $chenhLechSoLuong;
            $sumPrice = $idInvoiceProvided->import_price + $idInvoiceProvided->import_price * 0.1;

            $product = Product::where('id', $idInvoiceProvided->product_id)->update([
                'name' => $request->name,
                'trademark' => $request->trademark,
                'product_type_id' => $request->product_type_id,
                'product_code' => $request->product_code,
                'amount' => $countAmount,
                'price' => $sumPrice,
                'time_warranty' => $request->time_warranty,
                'tax' => $request->tax,
                'describe' => $request->describe,
                'updated_at' => Carbon::now(),
            ]);
            Session()->flash('success', 'Sửa dữ liệu thành công');
        }
        return redirect()->route('invoiceProvided');
    }
    public function deleteInvoiceProvided($id)
    {
        $delete = InvoiceProvided::where('id', $id)->update(['status' => 'Đã hủy']);
        Session()->flash('success', 'Xóa hóa đơn thành công');
        return redirect()->route('invoiceProvided');
    }
    //TRANG QUẢN LÍ NHÂN VIÊN ADMIN
    public function staff()
    {
        $user = UserDB::all()->sortByDesc('status');
        return view('admin.src.staff', compact('user'));
    }
    //add nhân viên
    public function addStaff()
    {
        return view('admin.src.add_staff');
    }
    public function postAddStaff(Request $request)
    {
        $acc = Account::insertGetId([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'token' => Str::random(64),
            'status' => "Đang hoạt động",
            'created_at' => Carbon::now(),
        ]);
        if ($request->hasFile('image_url')) {
            $request->validate([
                'image_url' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
            $request->image_url->store('images', 'public');
            $user = UserDB::insert([
                // add_image
                'account_id' => $acc,
                'fullname' => $request->fullname,
                'image_url' => $request->image_url->hashName(),
                'sex' => $request->sex,
                'birthday' => $request->birthday,
                'citizen_ID' => $request->citizen_ID,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'permission' => $request->permission,
                'created_at' => Carbon::now(),
            ]);
            if (!empty($user) && !empty($acc)) {
                Session()->flash('success', 'Thêm nhân viên thành công');
                return redirect()->route('staff');
            } else {
                Session()->flash('success', 'Thêm nhân viên thất bại');
                return redirect()->route('staff');
            }
        }
        Session()->flash('success', 'Kiểm tra lại hình ảnh');
        return redirect()->route('staff');
    }
    //edit nhân viên
    public function editStaff($id)
    {
        $staff = UserDB::find($id);
        return view('admin.src.edit_staff', compact('staff'));
    }
    public function postEditStaff(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);
            $request->image->store('images', 'public');

            $user = UserDB::where('id', '=', $id)->update([
                'fullname' => $request->fullname,
                'image_url' => $request->image->hashName(),
                'address' => $request->address,
                'birthday' => $request->birthday,
                'email' => $request->email,
                'phone' => $request->phone,
                'permission' => $request->permission,
                'status' => $request->status,
                'updated_at' => Carbon::now(),
            ]);
            if (!empty($user)) {
                Session()->flash('success', 'Thay đổi thông tin nhân viên thành công');
            } else {
                Session()->flash('success', 'Thay đổi thông tin nhân viên thất bại');
            }
        } else {
            Session()->flash('success', 'Kiểm tra lại hình ảnh');
        }
        return redirect()->route('staff');
    }
    public function deleteStaff($id)
    {
        $staff = UserDB::where('id', '=', $id)->update(['status' => "Dừng hoạt động"]);
        Session()->flash('success', 'Xóa nhân viên thành công');
        return redirect()->route('staff');
    }
    //TRANG LƯƠNG ADMIN
    public function money()
    {
        return view('admin.src.money');
    }
    //add lương
    public function addMoney()
    {
        return view('admin.src.add_money');
    }
    //edit lương
    public function editMoney()
    {
        return view('admin.src.edit_money');
    }

    //TRANG NHÀ CUNG CẤP
    public function provided()
    {
        $provided = Provided::orderByDesc('status')->get();
        return view('admin.src.provided', compact('provided'));
    }
    public function addProvided()
    {
        return view('admin.src.add_provided');
    }
    public function postAddProvided(Request $request)
    {
        $note = '';
        if (!empty($request->notes)) {
            $note = $request->notes;
        }
        $db = DB::table('provideds')->insert([
            'name' => $request->name,
            'tax_code' => $request->tax_code,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $note,
            'created_at' => Carbon::now(),
        ]);
        Session()->flash('success', 'Thêm nhà cung cấp thành công');
        return redirect()->route('provided');
    }
    public function editProvided($id)
    {
        $provided = Provided::find($id);
        return view('admin.src.edit_provided', compact('provided'));
    }
    public function postEditProvided(Request $request, $id)
    {
        $db = DB::table('provideds')->where('id', $id)->update([
            'tax_code' => $request->tax_code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'notes' => $request->notes,
            'updated_at' => Carbon::now(),
        ]);
        Session()->flash('success', 'Thay đổi dữ liệu nhà cung cấp thành công');
        return redirect()->route('provided');
    }
    public function deleteProvided($id)
    {
        $db = DB::table('provideds')->where('id', '=', $id)->update([
            'status' => ' Dừng hoạt động',
            'updated_at' => Carbon::now(),
        ]);
        Session()->flash('success', 'Xóa dữ liệu thành công');
        return redirect()->route('provided');
    }
    //TRANG BÁO CÁO
    public function report()
    {
        $user = UserDB::all()->count();
        $product = Product::all()->count();
        $invoice = Invoice::all()->count();
        $total = Invoice::all()->sum('total');
        $outProduct = Product::where('amount', '<', 10)->count();
        $deleteProduct = Product::where('status', 'Đã hủy')->count();
        //san pham ban chay
        //san pham da het
        $endProduct = Product::where('amount', '=', 0)->latest()->get();
        //nv moi
        $newUser = UserDB::latest()->take(5)->get();

        //barChart
        $barChart = Account::all();
        $bar = [];
        foreach ($barChart as $barChart) {
            $bar[] = $barChart->id;
        }

        //lineChart
        $lineChart = Provided::all();
        $line = [];
        foreach ($lineChart as $lineChart) {
            $line[] = $lineChart->id;
        }
        return view(
            'admin.src.report',
            compact('user', 'product', 'invoice', 'total', 'outProduct', 'deleteProduct', 'endProduct', 'newUser', 'barChart', 'bar', 'lineChart', 'line')
        );
    }
    public function exportProvided()
    {
        return Excel::download(new exportExcelProvided, 'provided.xlsx');
    }
    public function exportInvoice()
    {
        return Excel::download(new exportExcelInvoice, 'invoice.xlsx');
    }
    public function exportProduct()
    {
        return Excel::download(new exportExcelProduct, 'product.xlsx');
    }
    public function exportStaff()
    {
        return Excel::download(new exportExcelUser, 'user.xlsx');
    }
    public function importProvided()
    {
        return view('admin.src.import.importProvided');
    }
    public function postImportProvided(Request $request)
    {
        try{
            Excel::import(new ProvidedImport, request()->file('file'));
            Session()->flash('success', 'Thêm nhà cung cấp thành công');
            return redirect()->route('provided');
        }catch(Exception $e){
            Session()->flash('success', 'Thêm nhà cung cấp thất bại');
            return redirect()->route('provided');
        //    throw new Exception($e->getMessage());
        }

    }
    public function updateSecurityType(){
        $data=AllType::security()->get();
        return view('admin.src.add_type_device.add_security_type',compact('data'));
    }
    public function postUpdateSecurityType(Request $request,$id){
        $classify='Bảo mật';
        $addSecurityType=AllType::updateOrCreate(
            ['id'=>$id],
            ['classify'=>$classify,'name_classify'=>$request->name_classify]
        );
        if($addSecurityType){
            Session()->flash('success', 'Thêm, cập nhật loại bảo mật thành công');
        }
        else{
            Session()->flash('success', 'Thêm, cập nhật loại bảo mật thất bại');
        }
        return redirect()->route('updateSecurityType');
    }
    public function updateFeatureType(){
        $data = AllType::feature()->get();
        return view('admin.src.add_type_device.add_feature_type',compact('data'));
    }
    public function postUpdateFeatureType(Request $request,$id){
        $classify='Tính năng';
        $addFeatureType=AllType::updateOrCreate(
            ['id'=>$id],
            ['classify'=>$classify,'name_classify'=>$request->name_classify]
        );
        if($addFeatureType){
            Session()->flash('success', 'Thêm, cập nhật loại tính năng thành công');
        }
        else{
            Session()->flash('success', 'Thêm, cập nhật loại tính năng thất bại');
        }
        return redirect()->route('updateFeatureType');
    }
    public function updateRecordType(){
        $data=AllType::record()->get();
        return view('admin.src.add_type_device.add_record_type',compact('data'));
    }
    public function postUpdateRecordType(Request $request,$id){
        $classify='Ghi âm';
        $addRecordType=AllType::updateOrCreate(
            ['id'=>$id],
            ['classify'=>$classify,'name_classify'=>$request->name_classify]
        );
        if($addRecordType){
            Session()->flash('success', 'Thêm, cập nhật loại ghi âm thành công');
        }
        else{
            Session()->flash('success', 'Thêm, cập nhật loại ghi âm thất bại');
        }
        return redirect()->route('updateRecordType');
    }
    public function updateVideoType(){
        $data=AllType::video()->get();
        return view('admin.src.add_type_device.add_video_type',compact('data'));
    }
    public function postUpdateVideoType(Request $request,$id){
        $classify='Xem phim';
        $addVideoType=AllType::updateOrCreate(
            ['id'=>$id],
            ['classify'=>$classify,'name_classify'=>$request->name_classify]
        );
        if($addVideoType){
            Session()->flash('success', 'Thêm, cập nhật loại video thành công');
        }
        else{
            Session()->flash('success', 'Thêm, cập nhật loại video thất bại');
        }
        return redirect()->route('updateVideoType');
    }
    public function updateMusicType(){
        $data=AllType::music()->get();
        return view('admin.src.add_type_device.add_music_type',compact('data'));
    }
    public function postUpdateMusicType(Request $request,$id){
        $classify='Nghe nhạc';
        $addVideoType=AllType::updateOrCreate(
            ['id'=>$id],
            ['classify'=>$classify,'name_classify'=>$request->name_classify]
        );
        if($addVideoType){
            Session()->flash('success', 'Thêm, cập nhật loại nghe nhạc thành công');
        }
        else{
            Session()->flash('success', 'Thêm, cập nhật loại nghe nhạc thất bại');
        }
        return redirect()->route('updateMusicType');
    }
    public function updateCameraFeatureType(){
        $data=AllType::cameraFeature()->get();
        return view('admin.src.add_type_device.add_camera_feature_type',compact('data'));
    }
    public function postUpdateCameraFeatureType(Request $request,$id){
        $classify='Tính năng camera';
        $addData=AllType::updateOrCreate(
            ['id'=>$id],
            ['classify'=>$classify,'name_classify'=>$request->name_classify]
        );
        if($addData){
            Session()->flash('success', 'Thêm, cập nhật loại tính năng camera thành công');
        }
        else{
            Session()->flash('success', 'Thêm, cập nhật loại tính năng camera thất bại');
        }
        return redirect()->route('updateCameraFeatureType');
    }

    public function updateWjfjType(){
        $data=AllType::wjfj()->get();
        return view('admin.src.add_type_device.add_wjfj_type',compact('data'));
    }
    public function postUpdateWjfjType(Request $request,$id){
        $classify='Wjfj';
        $addData=AllType::updateOrCreate(
            ['id'=>$id],
            ['classify'=>$classify,'name_classify'=>$request->name_classify]
        );
        if($addData){
            Session()->flash('success', 'Thêm, cập nhật loại wjfj thành công');
        }
        else{
            Session()->flash('success', 'Thêm, cập nhật loại wifj thất bại');
        }
        return redirect()->route('updateWjfjType');
    }
    public function updateGpsType(){
        $data=AllType::gps()->get();
        return view('admin.src.add_type_device.add_gps_type',compact('data'));
    }
    public function postUpdateGpsType(Request $request,$id){
        $classify='Định vị';
        $addData=AllType::updateOrCreate(
            ['id'=>$id],
            ['classify'=>$classify,'name_classify'=>$request->name_classify]
        );
        if($addData){
            Session()->flash('success', 'Thêm, cập nhật loại gps thành công');
        }
        else{
            Session()->flash('success', 'Thêm, cập nhật loại gps thất bại');
        }
        return redirect()->route('updateGpsType');
    }
    public function updateBluetoothType(){
        $data=AllType::bluetooth()->get();
        return view('admin.src.add_type_device.add_bluetooth_type',compact('data'));
    }
    public function postUpdateBluetoothType(Request $request,$id){
        $classify='bluetooth';
        $addData=AllType::updateOrCreate(
            ['id'=>$id],
            ['classify'=>$classify,'name_classify'=>$request->name_classify]
        );
        if($addData){
            Session()->flash('success', 'Thêm, cập nhật loại bluetooth thành công');
        }
        else{
            Session()->flash('success', 'Thêm, cập nhật loại bluetooth thất bại');
        }
        return redirect()->route('updateBluetoothType');
    }
    public function updateFilmType(){
        $data=AllType::film()->get();
        return view('admin.src.add_type_device.add_film_type',compact('data'));
    }
    public function postUpdateFilmType(Request $request,$id){
        $classify='Quay phim';
        $addData=AllType::updateOrCreate(
            ['id'=>$id],
            ['classify'=>$classify,'name_classify'=>$request->name_classify]
        );
        if($addData){
            Session()->flash('success', 'Thêm, cập nhật loại quay phim thành công');
        }
        else{
            Session()->flash('success', 'Thêm, cập nhật loại quay phim thất bại');
        }
        return redirect()->route('updateFilmType');
    }
}
