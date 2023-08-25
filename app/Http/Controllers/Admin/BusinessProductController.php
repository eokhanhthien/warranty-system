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

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadDriverColtroller;

class BusinessProductController extends Controller
{
    public function index(Request $request){
  
        $products =  Product::where('business_id', auth()->user()->business_id)->get();
        $categories = ProductCategory::where('business_id', Auth::user()->business_id)->get();
        $sub_categories = ProductSubcategory::where('business_id', Auth::user()->business_id)->get();
        $product_types = ProductType::get();
        // dd($product_types[0]);
        return view('admin.product_business.index',compact('products','categories','sub_categories','product_types'));
    }

    public function create()
    {
        return view('admin.business.service.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $variantData = $request->variant;

        // upload image
        $uploadController = new UploadDriverColtroller();
        $path_image = $uploadController->upload_singer_image($request);

        $product = new Product;
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->price = $request->price;
        $product->import_price = $request->import_price;
        $product->unit = $request->unit;
        $product->business_id = auth()->user()->business_id;
        $product->attribute_id = $request->attribute_id;
        $product->image = !empty($path_image) ? $path_image : '';
        $product->stock = $request->stock;
        $product->save();

        $product_detail = new ProductDetail;
        $product_detail->product_id = $product->id;
        $uploadImages = new UploadDriverColtroller();
        $pathImages = $uploadImages->upload_singer_images($request);
        $product_detail->images = json_encode($pathImages);
        $product_detail->content = $request->content; 
        $product_detail['attributes'] = json_encode($request['attributes'] );
        $product_detail->save();

        $variants = [];

        // Kiểm tra nếu tồn tại $variantData và $variantData[1]['values']
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
        
        return redirect()->back()->with('success', 'Tạo sản phẩm thành công.');
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
        $product->unit = $request->unit;
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
}