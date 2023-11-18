<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Staff;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SelectOptionsController;
use App\Http\Controllers\UploadDriverColtroller;

class HrmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Staff::where('business_id', Auth::guard('staff')->user()->business_id)->get();
       // Thêm address
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];
        return view('staff.HRM.index',compact('users','provinces','wards','districts'));
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
         // Upload the image
         $data = $request->all();
         // upload image
         $uploadController = new UploadDriverColtroller();
         $path_image = $uploadController->upload_image($request);
 
         $addressArray = [
             'province' => $data['province'],
             'district' => $data['district'],
             'ward' => $data['ward']
         ];
         
         $addressJson = json_encode($addressArray);
         // Create the user
         $user = new Staff();
         $user->name = $data['name'];
         $user->email = $data['email'];
         $user->password = bcrypt($data['password']);
         $user->phone_number = $data['phone_number'];
         $user->status = $data['status'];
         $user->gender = $data['gender'];
         $user->birthday = $data['birthday'];
         $user->role = $data['role'];
         $user->business_id = Auth::guard('staff')->user()->business_id;
         $user->address = $addressJson;
         $user->image = $path_image;
         $user->save();
 
         // Redirect or return a response
         return redirect()->back()->with('success', 'Thêm nhân viên thành công');
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
        // Thêm address
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];
        $user = Staff::findOrFail($id);


        return view('staff.HRM.edit',compact('id','provinces', 'wards', 'districts','user'));
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
    
        $user = Staff::findOrFail($id);
        
        // Upload the image if it exists
        if ($request->hasFile('image')) {
            $uploadimage = new UploadDriverColtroller();
            $path_image = $uploadimage->upload_image($request);
            

            // Delete old image
            $deleteimage = new UploadDriverColtroller();
            $deleteimage->delete_image($user->image);
            
            $user->image = $path_image;
        }else{
            $user->image = $user->image;
        }
    
        $addressArray = [
            'province' => $data['province'],
            'district' => $data['district'],
            'ward' => $data['ward']
        ];
        
        $addressJson = json_encode($addressArray);
    
        // Update user data
        $user->name = $data['name'];
        $user->email = $data['email'];
        if(!empty($data['password'])){
            $user->password = bcrypt($data['password']);
        }else{
            $user->password = $user->password;
        }
        $user->phone_number = $data['phone_number'];
        $user->status = $data['status'];
        $user->gender = $data['gender'];
        $user->birthday = $data['birthday'];
        $user->role = $data['role'];
        $user->business_id = Auth::user()->business_id;
        $user->address = $addressJson;
    
        $user->save();
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Cập nhật người dùng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Staff::findOrFail($id); 
        // Delete the user's image
        $deleteimage = new UploadDriverColtroller();
        $deleteimage->delete_image($user->image);
        // Delete the user record from the database
        $user->delete();
        // Redirect or return a response
        return redirect()->back()->with('success', 'Xóa người dùng thành công');
    }
}
