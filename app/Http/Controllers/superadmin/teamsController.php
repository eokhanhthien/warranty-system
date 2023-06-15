<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\SelectOptionsController;

class teamsController extends Controller
{
    public function index()
    {
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];

        $users = User::paginate(10);
        return view('superadmin.team.index', compact('provinces', 'wards', 'districts', 'users'));
    }

    public function create()
    {
        // Trả về view để hiển thị form tạo doanh nghiệp
        return view('superadmin.taff.create');
    }

    public function store(Request $request)
    {
        // echo "<pre>"; print_r($request->all());die;
         // Upload the image
        $data = $request->all();
        $imagePath = $data['image']->store('user_images', 'public');

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
        $user->business_id = $data['business_id'];
        $user->address = $addressJson;
        $user->image = "123123123123";
        $user->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'User added successfully');
    }

    // Các phương thức khác của controller

}
