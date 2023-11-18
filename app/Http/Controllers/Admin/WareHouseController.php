<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Business;
use App\BusinessService;


use App\ProductCategory;
use App\ProductSubcategory;
use App\ProductType;
use App\Product;
use App\ProductDetail;
use App\Variant;
use App\DiscountCode;
use App\Supplier;
use App\Receipt;
use App\ReceiptItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadDriverColtroller;

class WareHouseController extends Controller
{
    public function index(Request $request){
  
        $products =  Product::where('business_id', auth()->user()->business_id)->get();
        $categories = ProductCategory::where('business_id', Auth::user()->business_id)->get();
        $sub_categories = ProductSubcategory::where('business_id', Auth::user()->business_id)->get();
        $product_types = ProductType::get();
        $suppliers =  Supplier::where('business_id', auth()->user()->business_id)->get();

        return view('admin.warehouse.index',compact('products','categories','sub_categories','product_types','suppliers'));
    }

    public function getListWareHouse(){
        $products =  Product::where('business_id', auth()->user()->business_id)->get();
        $categories = ProductCategory::where('business_id', Auth::user()->business_id)->get();
        $sub_categories = ProductSubcategory::where('business_id', Auth::user()->business_id)->get();
        $product_types = ProductType::get();
        $suppliers =  Supplier::where('business_id', auth()->user()->business_id)->get();
        $receipts =  Receipt::where('business_id', auth()->user()->business_id)->where('type',1)->get();
        return view('admin.warehouse.list_receipt',compact('receipts','products','categories','sub_categories','product_types','suppliers'));
    }

    public function getListExport(){
        $products =  Product::where('business_id', auth()->user()->business_id)->get();
        $categories = ProductCategory::where('business_id', Auth::user()->business_id)->get();
        $sub_categories = ProductSubcategory::where('business_id', Auth::user()->business_id)->get();
        $product_types = ProductType::get();
        $suppliers =  Supplier::where('business_id', auth()->user()->business_id)->get();
        $receipts =  Receipt::where('business_id', auth()->user()->business_id)->where('type',2)->get();
        return view('admin.warehouse.list_export_receipt',compact('receipts','products','categories','sub_categories','product_types','suppliers'));
    }

    public function getDetailReceipt($id){
        $receipt =  Receipt::find($id)->first();
        $receipt_items =  ReceiptItem::where('receipt_id',$id)->get();
        return view('admin.warehouse.detail_receipt',compact('receipt_items','receipt'));
    }

    public function create()
    {
        return view('admin.business.service.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $receipt = new Receipt();
        $receipt->supplier_id = $request->supplier_id;
        $receipt->purchase_date = $request->purchase_date;
        $receipt->status = $request->status;
        $receipt->type = 1;
        $receipt->note = $request->note;
        $receipt->business_id = Auth::user()->business_id;
        $receipt->save();

        // cập nhật số lượng sản phẩm
        $products =  Product::where('business_id', auth()->user()->business_id)->get();

        foreach($products as $index => $product){
            foreach($request->selected_product_ids as $id){
                if($product->id == $id){
                    $product->stock += $request->quantity[$index];
                    $receipt_item = new ReceiptItem();
                    $receipt_item->receipt_id = $receipt->id;
                    $receipt_item->product_id = $product->id;
                    $receipt_item->quantity = $request->quantity[$index];
                    $receipt_item->save();
                }
            }
            $product->save();
        }
        DB::commit();
        return redirect()->back()->with('success', 'Tạo phiếu thành công.');
    }

    public function exportInventory(Request $request)
    {
        DB::beginTransaction();
        $receipt = new Receipt();
        $receipt->supplier_id = $request->supplier_id;
        $receipt->purchase_date = $request->purchase_date;
        $receipt->status = "Đã xuất";
        $receipt->type = 2;
        $receipt->note = $request->note;
        $receipt->business_id = Auth::user()->business_id;
        $receipt->save();

        // cập nhật số lượng sản phẩm
        $products =  Product::where('business_id', auth()->user()->business_id)->get();

        foreach($products as $index => $product){
            foreach($request->selected_product_ids as $id){
                if($product->id == $id){
                    // Kiểm tra số lượng tồn kho trước khi xuất
                    if ($product->stock < $request->quantity[$index]) {
                        return redirect()->back()->with('error', 'Số lượng tồn kho không đủ để xuất.');
                    }

                    // Trừ số lượng tồn kho khi xuất kho
                    $product->stock -= $request->quantity[$index];
                    $receipt_item = new ReceiptItem();
                    $receipt_item->receipt_id = $receipt->id;
                    $receipt_item->product_id = $product->id;
                    $receipt_item->quantity = $request->quantity[$index];
                    $receipt_item->save();
                }
            }
            $product->save();
        }
        DB::commit();
        return redirect()->back()->with('success', 'Xuất kho thành công.');
    }


    public function show(BusinessService $businessService)
    {
        dd(123);
        // return view('admin.business.service.show', compact('businessService'));
    }

    public function edit($id)
    {        
  
        $categories = ProductCategory::where('business_id', Auth::user()->business_id)->get();
        $sub_categories = ProductSubcategory::where('business_id', Auth::user()->business_id)->get();
        $product_types = ProductType::get();
        $product_current = Product::find($id);
        $product_detail = ProductDetail::where('product_id' , $id)->first();

        $product_detail_images = json_decode($product_detail->images, true);
        $product_attribute = json_decode($product_detail->attributes, true);
        $variant = Variant::where('product_id' , $id)->get();

        $image_to_add = $product_current->image;
        array_unshift($product_detail_images, $image_to_add);
        // dd( $variant);
        return view('admin.product_business.edit',compact('categories','sub_categories','product_types','product_current','product_detail_images','variant','product_attribute','product_detail'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();
        $variantData = $request->variant;

        $product =  Product::find($id);
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->price = $request->price;
        $product->import_price = $request->import_price;
        $product->business_id = auth()->user()->business_id;
        $product->attribute_id = $request->attribute_id;

        $product->stock = $request->stock;

        if ($request->hasFile('image')) {
            // upload image
            $uploadController = new UploadDriverColtroller();
            $path_image = $uploadController->upload_singer_image($request);
            // Delete old image
            $deleteimage = new UploadDriverColtroller();
            $deleteimage->delete_image($product->image);
            $product->image = !empty($path_image) ? $path_image : '';
        }
        $product->save();

        $product_detail = ProductDetail::where('product_id' , $id)->first();
        $product_detail->content = $request->content; 
        $product_detail['attributes'] = json_encode($request['attributes'] );

        if ($request->hasFile('images')) {
            // Xóa ảnh cũ
            if(!empty(json_decode($product_detail->images))){
                foreach (json_decode($product_detail->images) as $key => $image) {
                        $deleteImage = new UploadDriverColtroller();
                        $deleteImage->delete_image($image);
                }
            }

            $uploadImages = new UploadDriverColtroller();
            $pathImages = $uploadImages->upload_singer_images($request);

            $product_detail->images = json_encode($pathImages);
        }
        $product_detail->save();

        $variants = [];

        // Kiểm tra nếu tồn tại $variantData và $variantData[1]['values']
        if(!empty($request->variant)){
        $variant_old = Variant::where('product_id', $id)->get();
        if(!empty($variant_old)){
            foreach ($variant_old as $key => $item) {
                $item->delete();
            }
        }

        if (isset($variantData) && isset($variantData[1]['values'])) {
            // Kiểm tra nếu tồn tại $variantData[2]['values']
            if (isset($variantData[2]['values'])) {
                // Lặp qua các giá trị của thuộc tính "Màu"
                foreach ($variantData[1]['values'] as $Index_1 => $value_1) {
                    // Lặp qua các giá trị của thuộc tính "Ram"
                    foreach ($variantData[2]['values'] as $Index_2 => $value_2) {
                        $variantKey = "{$Index_1}_{$Index_2}";
                        $priceKey = "price_{$variantKey}";
                        $stockKey = "stock_{$variantKey}";
        
                        // Kiểm tra nếu tồn tại giá và số lượng tồn kho tương ứng
                        if (isset($data[$priceKey]) && isset($data[$stockKey])) {
                            $variants[] = [
                                'product_id' => $product->id,
                                'title_1' => $variantData[1]['name'],
                                'title_2' => $variantData[2]['name'],
                                'value_1' => $value_1['value'],
                                'value_2' => $value_2['value'],
                                'price' => $data[$priceKey],
                                'stock' => $data[$stockKey],
                            ];
                        }
                    }
                }
            } else {
                // Trường hợp chỉ có $variantData[1] và không có $variantData[2]
                foreach ($variantData[1]['values'] as $Index_1 => $value_1) {
                    $variantKey = "{$Index_1}";
                    $priceKey = "price_{$variantKey}_0";
                    $stockKey = "stock_{$variantKey}_0";
        
                    // Kiểm tra nếu tồn tại giá và số lượng tồn kho tương ứng
                    if (isset($data[$priceKey]) && isset($data[$stockKey])) {
                        $variants[] = [
                            'product_id' => $product->id,
                            'title_1' => $variantData[1]['name'],
                            'title_2' => null,
                            'value_1' => $value_1['value'],
                            'value_2' => null,
                            'price' => $data[$priceKey],
                            'stock' => $data[$stockKey],
                        ];
                    }
                }
            }
        }
        if(!empty($variants)){
            foreach ($variants as $variantData) {
                $variant = new Variant();
                $variant->product_id = $variantData['product_id'];
                $variant->title_1 = $variantData['title_1'];
                $variant->title_2 = $variantData['title_2'];
                $variant->value_1 = $variantData['value_1'];
                $variant->value_2 = $variantData['value_2'];
                $variant->price = $variantData['price'];
                $variant->stock = $variantData['stock'];
                $variant->save();
            }
        }
    }

        return redirect()->back()->with('success', 'Sửa sản phẩm thành công.');
    }
    

    public function destroy($id)
    {  
        $product =  Product::find($id);
        $deleteimage = new UploadDriverColtroller();
        if(!empty($product->image)){
        $deleteimage->delete_image($product->image);
        }
        $product->delete();
        $product_detail = ProductDetail::where('product_id' , $id)->first();
        if(!empty(json_decode($product_detail->images))){
            foreach (json_decode($product_detail->images) as $key => $image) {
                    $deleteImage = new UploadDriverColtroller();
                    $deleteImage->delete_image($image);
            }
        }
        $product_detail -> delete();
        $variant_old = Variant::where('product_id', $id)->get();
        if(!empty($variant_old)){
            foreach ($variant_old as $key => $item) {
                $item->delete();
        }
    }
    return redirect()->back()->with('success', 'Xóa sản phẩm thành công.');
}


    public function getAttributes($id)
    {
        $productType = ProductType::findOrFail($id);
        $attributes = json_decode($productType->attributes, true);
        return response()->json($attributes);
    }

    public function updateQuantity(Request $request)
    {
        $product = Product::find($request->id);

        if ($product) {
            $product->stock = $request->quantity;
            $product->save();
            
            return response()->json(['success' => 1,'message' => 'Cập nhật kho thành công.']);
        }

        return response()->json(['success' => 0,'message' => 'cập nhật thất bại']);
    }

    public function getDiscount(){
        $discount_codes =  DiscountCode::where('business_id', auth()->user()->business_id)->get();
        return view('admin.product_business.discount', compact('discount_codes'));
    }

    public function createDiscount(Request $request){
        // dd($request->all());
        $discount_code = new DiscountCode();
        $discount_code->name = $request->name;
        $discount_code->code = $request->code;
        $discount_code->amount = $request->amount;
        $discount_code->start_at = $request->start_at;
        $discount_code->expires_at = $request->expires_at;
        $discount_code->business_id = auth()->user()->business_id;
        $discount_code->save();
        return redirect()->back()->with('success', 'Tạo mã giảm giá thành công.');

    }

    public function updateDiscount(Request $request,$id){
        $discount_code = DiscountCode::find($id);
        $discount_code->name = $request->name;
        $discount_code->code = $request->code;
        $discount_code->amount = $request->amount;
        $discount_code->start_at = $request->start_at;
        $discount_code->expires_at = $request->expires_at;
        $discount_code->business_id = auth()->user()->business_id;
        $discount_code->save();
        return redirect()->back()->with('success', 'Cập nhật mã giảm giá thành công.');

    }

    public function deleteDiscount(Request $request,$id){
        $discount_code = DiscountCode::find($id);
        $discount_code->delete();
        return redirect()->back()->with('success', 'Xóa mã giảm giá thành công.');
    }
}