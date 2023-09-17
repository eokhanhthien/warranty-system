<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SelectOptionsController;
use App\Http\Controllers\UploadDriverColtroller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = User::find(Auth::user()->id);
        // Thêm address
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];
        return view('admin.profile.index',compact('profile','provinces', 'wards', 'districts'));
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
        //
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
        // dd($request->all());
        $data = $request->all();
    
        $user = User::findOrFail($id);
        
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
        $user->status = 1;
        $user->gender = $data['gender'];
        $user->birthday = $data['birthday'];
        // $user->role = $data['role'];
        // $user->business_id = !empty($data['business_id'])?$data['business_id']:null;
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
        //
    }
}
