<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TransferGateway;
use Illuminate\Support\Facades\Auth;

class GatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transfergateway =  TransferGateway::where('business_id', Auth::user()->business_id)->first();
        return view('admin.gateway.index',compact('transfergateway'));
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
 
        $isGateway = TransferGateway::where('business_id', Auth::user()->business_id)->first();
    
        if (!empty($isGateway)) {
            
            $isGateway->update([
                'bank_id' => $request->bank_id,
                'account_no' => $request->account_no,
                'account_name' => $request->account_name,
                'template' => $request->template,
            ]);

            $output = 'Cập nhật thông tin thành công';
        } else {
          
            $transfergateway = new TransferGateway();
            $transfergateway->business_id = Auth::user()->business_id;
            $transfergateway->bank_id = $request->bank_id;
            $transfergateway->account_no = $request->account_no;
            $transfergateway->account_name = $request->account_name;
            $transfergateway->template = $request->template;
            $transfergateway->save();

            $output = 'Cập nhật thông tin thành công';
        }
    
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
