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
use App\Models\AllTypeDetail;
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
use App\Models\InvoiceDetail;
use App\Models\Memory;
use App\Models\Music;
use App\Models\OperatingSystemCpu;
use App\Models\PaymentType;
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
use Illuminate\Support\Facades\Storage;
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
            ['created_at', '=', Carbon::now('Asia/Ho_Chi_Minh')->month],
        ])->count();
        $countCustomer = Invoice::distinct()->count('name_customer');
        $outOfProduct = Product::where([
            ['status', '=', 'Đang hoạt động'],
            ['amount', '<', '10'],
        ])->count();
        $invoice = Invoice::orderByDesc('status')->take(4)->get();
        $newCustomer = Invoice::take(5)->latest()->get();
        //barChart
        $barChart = Product::all();
        $bar = [];
        foreach ($barChart as $barChart) {
            $bar[] = $barChart->id;
        }
        //lineChart
        $lineChart = Product::all();
        $line = [];
        foreach ($lineChart as $lineChart) {
            $line[] = $lineChart->id;
        }
        return view('admin.src.index', compact('product', 'countInvoiceOnMonth', 'countCustomer', 'outOfProduct', 'invoice', 'newCustomer', 'barChart', 'bar', 'lineChart', 'line'));
    }
    public function demo() {
        $product = Product::count();
        $countInvoiceOnMonth = Invoice::where([
            ['status', '=', 'Đã xử lí'],
            ['created_at', '=', Carbon::now('Asia/Ho_Chi_Minh')->month],
        ])->count();
        $countCustomer = Invoice::distinct()->count('name_customer');
        $outOfProduct = Product::where(function($query){
            return $query->where('status', '=', 'Đang hoạt động')->where('amount', '<', '10');
        }
        )->count();
        $invoice = Invoice::orderByDesc('status')->take(4)->get();
        $newCustomer = Invoice::take(5)->latest()->get();
        //barChart
        $barChart = Product::all();
        $bar = [];
        foreach ($barChart as $barChart) {
            $bar[] = $barChart->id;
        }
        //lineChart
        $lineChart = Product::all();
        $line = [];
        foreach ($lineChart as $lineChart) {
            $line[] = $lineChart->id;
        }
        $view='admin.src.index';
        $pdf = PDF::loadView($view, compact('product', 'countInvoiceOnMonth', 'countCustomer', 'outOfProduct', 'invoice', 'newCustomer', 'barChart', 'bar', 'lineChart', 'line'))->setOptions(['defaultFont' => 'Times New Roman'])->setPaper('a4', 'landscape');

        return $pdf->download('demo.pdf');
    }
    //TRANG SẢN PHẨM ADMIN
    // Đang hoạt động/Hết hàng/Đã hủy
    public function product()
    {
        $product=Product::with('user','productType','allTypeDetail.allType','ImageDetail')->get();
        return view('admin.src.product', compact('product'));
    }
    //add sản phẩm
    public function addProduct()
    {
        $secutity=AllType::security()->get();
        $feature=AllType::feature()->get();
        $record=AllType::record()->get();
        $video=AllType::video()->get();
        $music=AllType::music()->get();
        $cameraFeature=AllType::cameraFeature()->get();
        $wjfj=AllType::wjfj()->get();
        $film=AllType::film()->get();
        $gps=AllType::gps()->get();
        $bluetooth=AllType::bluetooth()->get();
        $productType=ProductType::all();
        return view('admin.src.add_product', compact('secutity','feature','record','video','music','cameraFeature','wjfj','film','gps','bluetooth','productType'));
    }
    public function postAddProduct(Request $request)
    {
       DB::beginTransaction();
       $input=$request->all();
       try{
        $productId = Product::insertGetId([
            'user_id' => Auth::id(),
            'name_product' => $request->name_product,
            'product_type_id' => $request->product_type_id,
            'trademark' => $request->trademark,
            'product_code'=>$request->product_code,
            'amount' => $request->amount,
            'price' => $request->price,
            'tax' => $request->tax,
            'time_warranty' => $request->time_warranty,
            'sale' => $request->sale,
            'screen_technology'=>$request->screen_technology,
            'screen_resolution' =>$request->screen_resolution,
            'screen_width' =>$request->screen_width,
            'screen_maximum_brightness' =>$request->screen_maximum_brightness,
            'touch_screen_glass' =>$request->touch_screen_glass,
            'flash_light'=>$request->flash_light,
            'operating_system'=>$request->operating_system,
            'CPU' => $request->CPU,
            'speed_cpu' => $request->speed_cpu,
            'GPU' => $request->GPU,
            'ram' => $request->ram,
            'rom' => $request->rom,
            'available_memory' => $request->available_memory,
            'memory_stick' => $request->memory_stick,
            'mobile_network' => $request->mobile_network,
            'sim' => $request->sim,
            'phonebook' => $request->phonebook,
            'charging_port' => $request->charging_port,
            'headphone' => $request->headphone,
            'connection_orther' => $request->connection_orther,
            'battery_capacity'=>$request->battery_capacity,
            'pin_type' => $request->pin_type,
            'maximum_battery_charging_support' => $request->maximum_battery_charging_support,
            'charger_included' => $request->charger_included,
            'battery_technology' => $request->battery_technology,
            'water_and_dust_resistant' => $request->water_and_dust_resistant,
            'radio' => $request->radio,
            'design' => $request->design,
            'material' => $request->material,
            'size_volume' => $request->size_volume,
            'date_created' => $request->date_created,
            'status' => $request->status,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        $security = !empty($input['secutity_type']) ? $input['secutity_type'] : [];
        $feature = !empty($input['feature_type']) ? $input['feature_type'] : [];
        $record = !empty($input['record_type']) ? $input['record_type'] : [];
        $video = !empty($input['video_type']) ? $input['video_type'] : [];
        $music = !empty($input['music_type']) ? $input['music_type'] : [];
        $wjfj = !empty($input['wjfj_type']) ? $input['wjfj_type'] : [];
        $film = !empty($input['film_type']) ? $input['film_type'] : [];
        $gps = !empty($input['gps_type']) ? $input['gps_type'] : [];
        $bluetooth = !empty($input['bluetooth_type']) ? $input['bluetooth_type'] : [];
        $image = !empty($input['image']) ? $input['image'] : [];
        foreach ($security as $security) {
            $securityType=AllTypeDetail::insert([
                'product_id' => $productId,
                'all_type_id' =>$security,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }
        foreach ($feature as $feature) {
            $feature=AllTypeDetail::insert([
                'product_id' => $productId,
                'all_type_id' =>$feature,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }
        foreach ($record as $record) {
            $securityType=AllTypeDetail::insert([
                'product_id' => $productId,
                'all_type_id' =>$record,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }
        foreach ($video as $video) {
            $securityType=AllTypeDetail::insert([
                'product_id' => $productId,
                'all_type_id' =>$video,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }
        foreach ($music as $music) {
            $securityType=AllTypeDetail::insert([
                'product_id' => $productId,
                'all_type_id' =>$music,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }
        foreach ($wjfj as $wjfj) {
            $securityType=AllTypeDetail::insert([
                'product_id' => $productId,
                'all_type_id' =>$wjfj,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }
        foreach ($film as $film) {
            $securityType=AllTypeDetail::insert([
                'product_id' => $productId,
                'all_type_id' =>$film,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }
        foreach ($gps as $gps) {
            $securityType=AllTypeDetail::insert([
                'product_id' => $productId,
                'all_type_id' =>$gps,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }
        foreach ($bluetooth as $bluetooth) {
            $securityType=AllTypeDetail::insert([
                'product_id' => $productId,
                'all_type_id' =>$bluetooth,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }
        if ($request->hasFile('image_main')) {
             $request->validate([
                 'image_main' => 'mimes:jpeg,png,jpg,gif,svg',
             ]);
                    $request->image_main->store('images', 'public');
                    $img=ImageDetail::insert([
                        'product_id' => $productId,
                        'image_main' =>$request->image_main->hashName(),
                        'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    ]);
            }
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                    $image->store('images', 'public');
                    $img=ImageDetail::insert([
                        'product_id' => $productId,
                        'image' =>$image->hashName(),
                        'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    ]);
            }
        }
        if ($request->hasFile('slider')) {
            foreach ($request->file('slider') as $slider) {
                    $slider->store('images', 'public');
                    $img=ImageDetail::insert([
                        'product_id' => $productId,
                        'slider' =>$slider->hashName(),
                        'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    ]);
            }
        }
        DB::commit();
        Session()->flash('success', 'Thêm sản phẩm thành công');
        return redirect()->route('product');
       }
       catch(Exception $e){
        DB::rollBack();
        throw $e;
        Session()->flash('success', 'Thêm sản phẩm thất bại');
       }

    }
    //edit sản phẩm
    public function editProduct($id)
    {
        $product=Product::with('user','productType','allTypeDetail.allType','ImageDetail')->where('id', '=', $id)->first();
        $secutity=AllType::security()->get();
        $feature=AllType::feature()->get();
        $record=AllType::record()->get();
        $video=AllType::video()->get();
        $music=AllType::music()->get();
        $cameraFeature=AllType::cameraFeature()->get();
        $wjfj=AllType::wjfj()->get();
        $film=AllType::film()->get();
        $gps=AllType::gps()->get();
        $bluetooth=AllType::bluetooth()->get();
        $productType=ProductType::all();
        return view('admin.src.edit_product', compact('product','secutity','feature','record','video','music','cameraFeature','wjfj','film','gps','bluetooth','productType'));
    }
    public function postEditProduct(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            // $update=Product::where('id',$id)->update([
            // 'name_product' => $request->name_product,
            // 'trademark' => $request->trademark,
            // 'product_code'=>$request->product_code,
            // 'amount' => $request->amount,
            // 'price' => $request->price,
            // 'tax' => $request->tax,
            // 'time_warranty' => $request->time_warranty,
            // 'sale' => $request->sale,
            // 'screen_technology'=>$request->screen_technology,
            // 'screen_resolution' =>$request->screen_resolution,
            // 'screen_width' =>$request->screen_width,
            // 'screen_maximum_brightness' =>$request->screen_maximum_brightness,
            // 'touch_screen_glass' =>$request->touch_screen_glass,
            // 'flash_light'=>$request->flash_light,
            // 'operating_system'=>$request->operating_system,
            // 'CPU' => $request->CPU,
            // 'speed_cpu' => $request->speed_cpu,
            // 'GPU' => $request->GPU,
            // 'ram' => $request->ram,
            // 'rom' => $request->rom,
            // 'available_memory' => $request->available_memory,
            // 'memory_stick' => $request->memory_stick,
            // 'mobile_network' => $request->mobile_network,
            // 'sim' => $request->sim,
            // 'phonebook' => $request->phonebook,
            // 'charging_port' => $request->charging_port,
            // 'headphone' => $request->headphone,
            // 'connection_orther' => $request->connection_orther,
            // 'battery_capacity'=>$request->battery_capacity,
            // 'pin_type' => $request->pin_type,
            // 'maximum_battery_charging_support' => $request->maximum_battery_charging_support,
            // 'charger_included' => $request->charger_included,
            // 'battery_technology' => $request->battery_technology,
            // 'water_and_dust_resistant' => $request->water_and_dust_resistant,
            // 'radio' => $request->radio,
            // 'design' => $request->design,
            // 'material' => $request->material,
            // 'size_volume' => $request->size_volume,
            // 'date_created' => $request->date_created,
            // 'status' => $request->status,
            // 'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            // ]);
            dd($request);
            foreach ($request->file() as $image) {
                    $image->store('images', 'public');
                    $checkImage=ImageDetail::find($image);
                    $img=ImageDetail::where('id',$image)->update([
                        'image' =>$image->hashName(),
                        'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    ]);
            }
            die("ds");
            DB::commit();
            return redirect()->route('product');

        }catch(Exception $e){
            DB::rollBack();
        }
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
        $data=Invoice::with('user','invoiceDetail')->get();
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
        DB::beginTransaction();
        try{
            $sumTotal=0;
            // chuyển thành chuỗi 2 chiều
            $dataInvoiceDetail=$this->multiArrayTotwodimensionArray(array($request->products,$request->amount));
            //Tổng tiền hóa đơn
            $p=0;$a=0;
            for($p,$a;!empty($request->products[$p]);$p++,$a++){
                $product= Product::findOrFail($request->products[$p]);
                $sumTotal+=($request->amount[$a]*$product->price)+($request->amount[$a]*$product->price)*($product->tax/100);
            }
            $data = Invoice::insertGetId([
                'user_id' => Auth::id(),
                'name_customer' => $request->name_customer,
                'email_customer' => $request->email_customer,
                'phone' => $request->phone,
                'address_customer' => $request->address_customer,
                'total' => $sumTotal,
                'message' => $request->message,
                'status' => $request->status,
                'created_at' =>Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            //Carbon::createFromFormat('Y-m-d H:i:s',Carbon::now('Asia/Ho_Chi_Minh'))->format('d-m-Y H:i:s'),
            //tong so luong amount
            $arrAmount=count($request->amount);
            $count=0;
            foreach ($dataInvoiceDetail as $key=>$dataInvoiceDetail) {
                if($count==$arrAmount){break;}
                $product=Product::find($dataInvoiceDetail[0]);
                if(($product->amount - $request->amount[$count])<0){
                    DB::rollBack();
                    return redirect()->back();
                }
                $addInvoiceDetail=InvoiceDetail::insertGetId([
                    'invoice_id' => $data,
                    'product_id' => $product->id,
                    'amount' => $request->amount[$count],
                    'price' => $product->price,
                    'discount' => '0',
                    'promotion' => '0',
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
                //tong amount con lai
                $sumAmountProduct=$product->amount - $request->amount[$count];
                $updateProduct=Product::where('id',$product->id)->update([
                    'amount'=>$sumAmountProduct,
                    'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
            }
            Session()->flash('success', 'Thêm hóa đơn thành công');
            DB::commit();
            return redirect()->route('invoice');
        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
    //edit hóa đơn
    public function editInvoice($id)
    {
        $invoice = Invoice::with('invoiceDetail.product')->where('id', $id)->first();
        $product = Product::all()->where('status', '=', "Đang hoạt động");
        $status=array('Chờ xử lí','Đang xử lí','Đã xử lí');
        return view('admin.src.edit_invoice', compact('invoice','status','product'));
    }
    public function postEditInvoice(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataInvoiceDetail=$this->multiArrayTotwodimensionArray(array($request->products,$request->amount));
            if(!empty($request->productAdd)){
                $dataInvoiceDetailAdd=$this->multiArrayTotwodimensionArray(array($request->productAdd,$request->amountAdd));
            }
            $message = 'Không';
            if (!empty($request->message)) {
                $message = $request->message;
            }
            //id invoice details
            $p=0;
            $sumTotal=0;
            for($p;!empty($request->products[$p]);$p++) {
                $invoiceDetail=InvoiceDetail::find($request->products[$p]);
                $countAmount=$invoiceDetail->amount - $request->amount[$p];
                $updateInvoideDetail=InvoiceDetail::where('id',$request->products[$p])->update([
                    'amount' => $request->amount[$p],
                    'updated_at' =>Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
                //them hoac giam so luong san pham
                if($countAmount>0 || $countAmount<0){
                    //tim sp, cong sp them
                    $invoiceDetail=InvoiceDetail::find($request->products[$p]);
                    $product= Product::find($invoiceDetail->product_id);
                    //amount con lai
                    $amount=$product->amount-$countAmount;
                    $updateProduct=Product::where('id',$invoiceDetail->product_id)->update([
                        'amount' =>$amount,
                        'updated_at' =>Carbon::now('Asia/Ho_Chi_Minh'),
                    ]);
                }
            }
            //thêm chi tiet hoa don
            if(!empty($request->productAdd)){
                $p=0;
                for($p;!empty($request->productAdd[$p]);$p++) {
                    if(!empty($request->amountAdd[$p])){
                        $invoiceDetail=InvoiceDetail::find($request->productAdd[$p]);
                        $product= Product::find($invoiceDetail->product_id);
                        //giam so luong san pham
                        $amount=$product->amount-$request->amountAdd[$p];
                        if($amount>0){
                            $insertInvoideDetail=InvoiceDetail::where('id',$request->productAdd[$p])->insertGetId([
                                'invoice_id' =>$id,
                                'product_id' =>$invoiceDetail->product_id,
                                'amount' => $request->amountAdd[$p],
                                'price'=>$product->price,
                                'created_at' =>Carbon::now('Asia/Ho_Chi_Minh'),
                            ]);
                            $updateProduct=Product::where('id',$product->id)->update([
                                'amount' =>$amount,
                                'updated_at' =>Carbon::now('Asia/Ho_Chi_Minh'),
                            ]);
                        }else{
                            DB::commit();
                            Session()->flash('success', 'Thay đổi dữ liệu đơn hàng thất bại');
                            return redirect()->route('invoice');
                        }
                    }
                }
                for($p=0;!empty($request->productAdd[0][$p]);$p++){
                    $invoiceDetail=InvoiceDetail::find($request->productAdd[0][$p]);
                    $product=Product::find($invoiceDetail->product_id);
                    $sumTotal+=($request->amount[0][$p]*$product->price)+($request->amount[0][$p]*$product->price)*($product->tax/100);
                }
            }
            //tong tien
            for($p=0,$a=0;!empty($request->products[$p]);$p++,$a++){
                $invoiceDetail=InvoiceDetail::find($request->products[$p]);
                $product=Product::find($invoiceDetail->product_id);
                $sumTotal+=($request->amount[$a]*$product->price)+($request->amount[$a]*$product->price)*($product->tax/100);
            }
            $updateInvoice = Invoice::where('id', $id)->update([
                'name_customer' => $request->name_customer,
                'email_customer' => $request->email_customer,
                'phone' => $request->phone,
                'address_customer' => $request->address_customer,
                'message' => $message,
                'total' => $sumTotal,
                'status' => $request->status,
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            DB::commit();
            Session()->flash('success', 'Thay đổi dữ liệu đơn hàng thành công');
            return redirect()->route('invoice');
        }catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }
    public function deleteInvoice($id)
    {
        $delete = DB::table('invoices')->where('id', '=', $id)->update(['status' => 'Đã hủy','updated_at'=>Carbon::now('Asia/Ho_Chi_Minh'),]);
        Session()->flash('success', 'Xóa hóa đơn thành công');
        return redirect()->route('invoice');
    }
    //TRANG NHẬP HÓA ĐƠN
    public function invoiceProvided()
    {
        $invoiceProvides=InvoiceProvided::with('user','provided')->get();
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
        DB::beginTransaction();
        try{
            $sumTotal=0;
            $dataInvoiceProvided=$this->multiArrayTotwodimensionArray(array($request->product_id,$request->amount,$request->import_price,$request->tax));
            //tong tien
            $a=[];$b=[];$c=[];
            $input=$request->all();
            foreach($input['amount'] as $amount){
                $a[]=$amount;
            }
            foreach($input['import_price'] as $import_price){
                $b[]=$import_price;
            }
            foreach($input['tax'] as $tax){
                $c[]=$tax;
            }
            for($i=0,$a,$b,$c;!empty($a[$i]);$i++){
                $sumTotal += ( ($a[$i]*$b[$i]) + ($a[$i]*$b[$i]*($c[$i]/100)) );
            }

            $invoiceProvided = InvoiceProvided::insertGetId([
                'provided_id' => $request->id_provided,
                'user_id' => Auth::id(),
                'total' => $sumTotal,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);

            foreach ($dataInvoiceProvided as $key=>$dataInvoiceProvided){
                $invoiceProvidedDetail = InvoiceProvidedDetail::insertGetId([
                    'invoice_provided_id' => $invoiceProvided,
                    'product_id' => $dataInvoiceProvided[0],
                    'amount' => $dataInvoiceProvided[1],
                    'import_price' => $dataInvoiceProvided[2],
                    'tax' => $dataInvoiceProvided[3],
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
                //tim chi tiet nhap
                $temp = InvoiceProvidedDetail::find($invoiceProvidedDetail);
                //tim san pham
                $searchAmountProduct = Product::where('id', '=', $temp->product_id)->first();
                //tong
                $sumAmountProduct = $searchAmountProduct->amount + $temp->amount;
                $sumPrice = $temp->import_price + $temp->import_price * 0.1;
                    // update table product
                    $product = Product::where('id', '=', $temp->product_id)->update([
                        'amount' => $sumAmountProduct,
                        'price' => $sumPrice,
                        'time_warranty' => $temp->time_warranty,
                        'tax' => $temp->tax,
                        'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    ]);
            }
            DB::commit();
            Session()->flash('success', 'Thêm hóa đơn nhà cung cấp thành công');
            return redirect()->route('invoiceProvided');
        }catch(Exception $e){
            DB::rollBack();
            Session()->flash('success', 'Thêm hóa đơn nhà cung cấp thất bại');
                    return redirect()->route('invoiceProvided');
        }

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
    public function editInvoiceProvided($id)
    {
        $data=InvoiceProvided::with('provided','invoiceProvidedDetail.product')->where('id', '=', $id)->first();
        $provided = Provided::all();
        $product = Product::all();
        return view('admin.src.edit_invoice_provided', compact('data', 'provided','product'));
    }
    public function postEditInvoiceProvided(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $dataInvoiceProvided=$this->multiArrayTotwodimensionArray(array($request->product_id,$request->amount,$request->import_price,$request->tax));
            $dataInvoiceProvidedAdd=$this->multiArrayTotwodimensionArray(array($request->product_id_add,$request->amountAdd,$request->import_priceAdd,$request->taxAdd));
            $sumTotal=0;
            //tong tien
            $input=$request->all();
            $amount=array($request->amount);
            $importPrice=array($request->import_price);
            $tax=array($request->tax);
            for($i=0,$amount,$importPrice,$tax;!empty($amount[0][$i]);$i++){
                $sumTotal += ( ($amount[0][$i]*$importPrice[0][$i]) + ($amount[0][$i]*$importPrice[0][$i]*($tax[0][$i]/100)) );
            }
            $updateInvoideProvided=InvoiceProvided::where('id',$id)->update([
                'total'=>$sumTotal,
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            //cap nhat lai so luong sp
            $invoiceProvidedDetail=InvoiceProvidedDetail::where('invoice_provided_id',$id)->get();
            foreach ($invoiceProvidedDetail as $invoiceProvidedDetail) {
                $product=Product::find($invoiceProvidedDetail->product_id);
                $sumAmount=$invoiceProvidedDetail->amount + $product->amount;
                $product = Product::where('id',$invoiceProvidedDetail->product_id)->update([
                    'amount' => $sumAmount,
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
            }
            //xoa chi tiet hd nhap
            $deleteInvoiceProvidedDetails=InvoiceProvidedDetail::where('invoice_provided_id',$id)->delete();
            //them lai ct hd nhap
            foreach ($dataInvoiceProvided as $key=>$dataInvoiceProvided){
                $invoiceProvidedDetail = InvoiceProvidedDetail::insertGetId([
                    'invoice_provided_id' => $id,
                    'product_id' => $dataInvoiceProvided[0],
                    'amount' => $dataInvoiceProvided[1],
                    'import_price' => $dataInvoiceProvided[2],
                    'tax' => $dataInvoiceProvided[3],
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
                //tim chi tiet nhap
                $temp = InvoiceProvidedDetail::find($invoiceProvidedDetail);
                //tim san pham
                $searchAmountProduct = Product::where('id', '=', $temp->product_id)->first();
                //tong
                $sumAmountProduct = $searchAmountProduct->amount + $temp->amount;
                $sumPrice = $temp->price + $temp->price * 0.1;
                    // update table product
                    $product = Product::where('id', '=', $temp->product_id)->update([
                        'amount' => $sumAmountProduct,
                        'price' => $sumPrice,
                        'time_warranty' => $temp->time_warranty,
                        'tax' => $temp->tax,
                        'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    ]);
            }
            foreach ($dataInvoiceProvidedAdd as $key=>$dataInvoiceProvidedAdd){
                $invoiceProvidedDetail = InvoiceProvidedDetail::insertGetId([
                    'invoice_provided_id' => $id,
                    'product_id' => $dataInvoiceProvidedAdd[0],
                    'amount' => $dataInvoiceProvidedAdd[1],
                    'import_price' => $dataInvoiceProvidedAdd[2],
                    'tax' => $dataInvoiceProvidedAdd[3],
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
                //tim chi tiet nhap
                $temp = InvoiceProvidedDetail::find($invoiceProvidedDetail);
                //tim san pham
                $searchAmountProduct = Product::where('id', '=', $temp->product_id)->first();
                //tong
                $sumAmountProduct = $searchAmountProduct->amount + $temp->amount;
                $sumPrice = $temp->price + $temp->price * 0.1;
                    // update table product
                    $product = Product::where('id', '=', $temp->product_id)->update([
                        'amount' => $sumAmountProduct,
                        'price' => $sumPrice,
                        'time_warranty' => $temp->time_warranty,
                        'tax' => $temp->tax,
                        'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    ]);
            }
            //cap nhat tong tien
            $updateInvoiceProvided=InvoiceProvided::where('id',$id)->with('invoiceProvidedDetail')->first();
            $sum=0;
            foreach($updateInvoiceProvided->invoiceProvidedDetail as $invoiceProvidedDetail){
                $sum+=$invoiceProvidedDetail->amount*$invoiceProvidedDetail->import_price;
            }
            $updateInvoiceProvided=InvoiceProvided::where('id',$id)->update(['total'=>$sum,'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh'),]);
            Session()->flash('success', 'Sửa dữ liệu thành công');
                DB::commit();
                return redirect()->route('invoiceProvided');
        }catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }

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
        return DB::transaction(function() use($request){
                $acc = Account::insertGetId([
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'token' => Str::random(64),
                    'status' => "Đang hoạt động",
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
                if ($request->hasFile('image_url')) {
                    $request->validate([
                        'image_url' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
                    ]);
                    $request->image_url->store('images', 'public');
                    $user = UserDB::insert([
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
                        'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
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
        );
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
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
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
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
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
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        Session()->flash('success', 'Thay đổi dữ liệu nhà cung cấp thành công');
        return redirect()->route('provided');
    }
    public function deleteProvided($id)
    {
        $db = DB::table('provideds')->where('id', '=', $id)->update([
            'status' => ' Dừng hoạt động',
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        Session()->flash('success', 'Xóa dữ liệu thành công');
        return redirect()->route('provided');
    }
    //TRANG BÁO CÁO
    public function report()
    {
        $user = UserDB::all()->count();
        //Nghi viec
        $userReport=UserDB::all()->where('status', '=', 'Dừng hoạt động')->count();
        $product = Product::all()->count();
        $invoice = Invoice::all()->count();
        $total = Invoice::all()->sum('total');
        $outProduct = Product::where('amount', '<', 10)->count();
        $deleteProduct = Product::where('status', 'Đã hủy')->count();
        //san pham ban chay
        $sellingProduct = Product::latest()->take(5)->get();
        //san pham da het
        $endProduct = Product::where('amount', '=', 0)->latest()->get();

        //nv moi
        $newUser = UserDB::latest()->take(5)->get();

        //barChart
        $barChart = Product::all();
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
        return view('admin.src.report', compact('user','userReport', 'product', 'invoice', 'total', 'outProduct', 'deleteProduct','sellingProduct', 'endProduct', 'newUser', 'barChart', 'bar', 'lineChart', 'line')
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
    public function updateBatteryTechnologyType(){
        $data=AllType::batteryTechnology()->get();
        return view('admin.src.add_type_device.add_battery_technology_type',compact('data'));
    }
    public function postUpdateBatteryTechnologyType(Request $request,$id){
        $classify='Công nghệ pin';
        $addData=AllType::updateOrCreate(
            ['id'=>$id],
            ['classify'=>$classify,'name_classify'=>$request->name_classify]
        );
        if($addData){
            Session()->flash('success', 'Thêm, cập nhật loại công nghệ pin thành công');
        }
        else{
            Session()->flash('success', 'Thêm, cập nhật loại công nghệ pin thất bại');
        }
        return redirect()->route('updateBatteryTechnologyType');
    }
    public function updateProductType(){
        $data=ProductType::all();
        return view('admin.src.add_type_device.add_product_type',compact('data'));
    }
    public function postUpdateProductType(Request $request,$id){
        $addData=ProductType::updateOrCreate(
            ['id'=>$id],
            ['name'=>$request->name,]
        );
        if($addData){
            Session()->flash('success', 'Thêm, cập nhật loại sản phẩm thành công');
        }
        else{
            Session()->flash('success', 'Thêm, cập nhật loại sản phẩm thất bại');
        }
        return redirect()->route('updateProductType');
    }
    public function updatePayment(){
        $data=PaymentType::all();
        return view('admin.src.add_type_device.add_payment',compact('data'));
    }
    public function postUpdatePayment(Request $request,$id){
        DB::beginTransaction();
        try{
            if(empty($request->card_code)){
                $addData=PaymentType::updateOrCreate(
                    ['id'=>$id],
                    ['card_type'=>$request->card_type,]
                );
            }
            else{
                $addData=PaymentType::updateOrCreate(
                    ['id'=>$id],
                    ['card_type'=>$request->card_type,'card_code'=>$request->card_code]
                );
            }
            DB::commit();
            Session()->flash('success', 'Thêm, cập nhật phương thức thanh toán thành công');
            return redirect()->route('updatePayment');
        }catch(Exception $e){
            DB::rollBack();
            Session()->flash('success', 'Thêm, cập nhật phương thức thanh toán thất bại');
            return redirect()->route('updatePayment');
        }
    }
    public function deletePayment($id){
        try{
            $data=PaymentType::where('id',$id)->delete();
            Session()->flash('success', 'Xóa phương thức thanh toán thành công');
            return redirect()->route('updatePayment');
        }catch(Exception $e){
            Session()->flash('success', 'Xóa phương thức thanh toán thất bại');
            return redirect()->route('updatePayment');
        }
    }
}
