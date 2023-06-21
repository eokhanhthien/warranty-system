<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\User;
use App\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\SelectOptionsController;
use App\Http\Controllers\UploadDriverColtroller;

class teamsController extends Controller
{
    public function index()
    {
        // Thêm address
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];
        $businesses = Business::all();
        $users = User::paginate(10);
        return view('superadmin.team.index', compact('provinces', 'wards', 'districts', 'users','businesses'));
    }

    public function create()
    {
        // Trả về view để hiển thị form tạo doanh nghiệp
        // return view('superadmin.taff.create');
    }
    public function show($id)
    {
 
    }
    public function store(Request $request)
    {
        // echo "<pre>"; print_r($request->all());die;
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
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->phone_number = $data['phone_number'];
        $user->status = $data['status'];
        $user->gender = $data['gender'];
        $user->birthday = $data['birthday'];
        $user->role = $data['role'];
        $user->business_id = !empty($data['business_id'])?$data['business_id']:null;
        $user->address = $addressJson;
        $user->image = $path_image;
        $user->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'User added successfully');
    }

    public function edit(Request $request, $id)
    {   
        // Thêm address
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];
        $user = User::findOrFail($id);
        $businesses = Business::all();

        return view('superadmin.team.edit',compact('id','provinces', 'wards', 'districts','user','businesses'));
    }

    public function update(Request $request, $id)
    {
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
        $user->status = $data['status'];
        $user->gender = $data['gender'];
        $user->birthday = $data['birthday'];
        $user->role = $data['role'];
        $user->business_id = !empty($data['business_id'])?$data['business_id']:null;
        $user->address = $addressJson;
    
        $user->save();
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'User updated successfully');
    }
    

    public function destroy($id)
    {
        $user = User::findOrFail($id); 
        // Delete the user's image
        $deleteimage = new UploadDriverColtroller();
        $deleteimage->delete_image($user->image);
        // Delete the user record from the database
        $user->delete();
        // Redirect or return a response
        return redirect()->back()->with('success', 'User deleted successfully');
    }
    

}
