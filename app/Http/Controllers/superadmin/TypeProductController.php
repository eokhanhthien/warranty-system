<?php

namespace App\Http\Controllers\superadmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TransferGateway;
use App\ProductType;
use Illuminate\Support\Facades\Auth;

class TypeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_types =  ProductType::get();
        return view('superadmin.product_type.index',compact('product_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $data = $request->all();

            // Chuyển đổi mảng attributes thành chuỗi JSON
            $attributes = json_encode($data['attributes']);
            // Tạo mới một instance của ProductType
            $Product_type = new ProductType();
            $Product_type->name = $data['name'];
            $Product_type->attributes = $attributes;
            $Product_type->save();

            $output = 'Thêm loại sản phẩm thành công';
      
        return redirect()->back()->with('success', $output);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_types =  ProductType::find($id);
        return view('superadmin.product_type.edit',compact('product_types'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $attributes = json_encode($data['attributes']);
       $Product_type = ProductType::find($id);
       $Product_type->name = $data['name'];
       $Product_type->attributes = $attributes;
       $Product_type->save();

       $output = 'Sửa loại sản phẩm thành công';
 
        return redirect()->back()->with('success', $output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_types =  ProductType::findOrFail($id);
        $product_types->delete();
        // Redirect or return a response
        return redirect()->back()->with('success', 'Xóa loại sản phẩm thành công thành công');

    }
}
