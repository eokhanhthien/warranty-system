<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\SelectOptionsController;
use Google\Cloud\Storage\StorageClient;

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


        $jsonContent = '{
            "type": "service_account",
            "project_id": "warraty-system",
            "private_key_id": "a6721d7ac1674aa451b58c768845cf7d708a6a1c",
            "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDvw0ticI8jqy40\nCnK+2rcTejTcaJEWaNkBTJP5iO27QXaSFoz7RT71LNume3nEtnIXX9px18rp6u0k\nYMq5wi1ofqDwDJeQBGwt77lESFeSIz+8VVpX7FAsXGIIIo6cIV3H4gkdodvgcwAi\n4rQ3hvD/98iBe6ZaMGToU0z1Pl4BoeeOUlEmMyPScgJjRyCR2xUsNEwUti5+BDDW\n5YAX9MetD5+s/P7YTKHVNCaIWXH7rli6TonSVJ/Sm80FmyzPb8FBGbCe3GTCYzoN\nY3xpSD07xteJLJttxdH63Z1zOcBsEduOotQStxBtMkstRnbeH8UE7sGmzrAy0r24\n/LH3YX/ZAgMBAAECggEAAIGpVKl1/NZpvJLZ9zPqMG0Cxj4zMgp6qRlgF4m+vCcz\nBuxr8EPyvPz2mrZRZYjDWrcQdKA4vbxtiLUHMX6ZEmc3aSbaGjlWY9UeefY6fnaJ\nfQrOcymLFHsh7IyylVCEut1d0ckYMSXbRDeZfsAW5HcXF1fSal0GeYucZHPKYwxF\nBML3wbEJ4PpTWqKMz+vAPhF/O9SmavKtkqYloGblUrD7oL7T0CQlOzs5sI5N1/XH\n62BBkwLHE4m2qypj+wva7PWxGQADXUmld1lXPt1lulPe/S7RVzGZeu9h1drbyCVK\nP9P4IWbyWLkk02L+jTLRKriV9qs63JpGpmc0Hoi5AQKBgQD5oY3jHv9CAvOxscI5\nchGJHKoWEilc7YcKGj9Bkeovk5D2j89MjLGCxSMbJ8Txz6/VaNjtuVuL1I58h9dR\nzjrva1e0FuwJhacCRgrZl2mntKB2ULxGqeSeXTshOo39G1zrNGBCwkMboWxMGuMU\n67taktmsupTmLidoVtUt0gIAMQKBgQD14UluCqnJiUKHn53CF8Krn9eFU7cYKcnZ\n6FBDrBzFpxsKLmq2QdIchFUyaGYmg81tC0d5St1ityWWXWYaGBw3d7/TZJnNHuyL\naJOHuubwcA79EB2XT+gsdqWUpLD0aW8svoetmNY3+YFiw9NEAR602oBMIX4MEwCK\nx4KYWuD4KQKBgGFbuNLTzAoazKCJC48MBfrLyypAexFbMkemZPVVy1gy3V7MR7U7\nSiAOctqscAs/TPyWn8RXfnTSuZ+n+zpUjHfEDbiXGAe+sJwaZTDn9LULpWl/o26L\n5DY/dkhHZglJGrxA+SoQScwE8Q/djKMkLTXuACd1vYzog0YWV54/QbiBAoGAStFg\nrLFl9MNlkStKr9LXE64xwIo2vo2ItFvygIUQxDwTCEgThJ4Gt1K1Mf9+hd25VqMF\n/qx/LRiZwWVuOiZ3/5DauBJ2kmoEhG8v5S9EMomGpg6PUomoFk+MFuz+Q4EJqU3Y\nr0RAewvbCRiZYqoMk++g9omCd14Y3iHTZVTR+/ECgYEA1SisOTtD8M7hcY+WnYqI\n/daE5gZ3GZISgAnZ0ZkhV9UegMQsh1jb105avB/eIrBTHRfV8g/t9RUQbzocTg49\nozrzufQ/RABSfTGeDO0UTEs5LsSJTH0HiS3MsyGS6rPLaCIw7hwLrUHRKwHfusCY\nfmv1nKutaoyOyWZVLg68er8=\n-----END PRIVATE KEY-----\n",
            "client_email": "warranty-system@warraty-system.iam.gserviceaccount.com",
            "client_id": "101986774277713641043",
            "auth_uri": "https://accounts.google.com/o/oauth2/auth",
            "token_uri": "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/warranty-system%40warraty-system.iam.gserviceaccount.com",
            "universe_domain": "googleapis.com"
          }
          ';
        
        $storage = new StorageClient([
            'keyFile' => json_decode($jsonContent, true),
        ]);
    
        $bucketName = 'artisansweb-bucket';
        $fileName = 'https://res.cloudinary.com/practicaldev/image/fetch/s--0WRXb_W5--/c_limit%2Cf_auto%2Cfl_progressive%2Cq_auto%2Cw_880/https://thepracticaldev.s3.amazonaws.com/i/pnf9xcns8qghw8valfux.png';
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->upload(
            fopen($fileName, 'r')
        );

        
        // $addressArray = [
        //     'province' => $data['province'],
        //     'district' => $data['district'],
        //     'ward' => $data['ward']
        // ];
        // $addressJson = json_encode($addressArray);
        // // Create the user
        // $user = new User();
        // $user->name = $data['name'];
        // $user->email = $data['email'];
        // $user->password = bcrypt($data['password']);
        // $user->phone_number = $data['phone_number'];
        // $user->status = $data['status'];
        // $user->gender = $data['gender'];
        // $user->birthday = $data['birthday'];
        // $user->role = $data['role'];
        // $user->business_id = $data['business_id'];
        // $user->address = $addressJson;
        // $user->image = "123123123123";
        // $user->save();

        // // Redirect or return a response
        // return redirect()->back()->with('success', 'User added successfully');
    }

    // Các phương thức khác của controller

}
