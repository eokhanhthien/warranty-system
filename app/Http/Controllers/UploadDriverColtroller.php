<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Storage;
use File;
class UploadDriverColtroller extends Controller
{
    public function upload_image(Request $request){
        $paths = [];
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileData = File::get($file);
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            if(!empty($request->image_width) && !empty($request->image_height)){
                $resizedFileData = $this->resizeImage($fileData, $request->image_width, $request->image_height); // Thay đổi kích thước ảnh
            }else{
                $resizedFileData = $fileData;
            }
    
            $result = Storage::cloud()->put($fileName, $resizedFileData);
    
            if ($result) {
                $metadata = Storage::cloud()->getMetadata($fileName);
                $path = $metadata['path'];
               return $path;
            } else {
                // Xử lý khi không thành công
            }
        }
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileData = File::get($image);
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                if(!empty($request->image_width) && !empty($request->image_height)){
                    $resizedFileData = $this->resizeImage($fileData, $request->image_width, $request->image_height); // Thay đổi kích thước ảnh
                }else{
                    $resizedFileData = $fileData;
                }
                
                $result = Storage::cloud()->put($fileName, $resizedFileData);
    
                if ($result) {
                    $metadata = Storage::cloud()->getMetadata($fileName);
                    $path = $metadata['path'];
                    $paths[] = $path; // Thêm đường dẫn vào mảng paths
                } else {
                    // Xử lý khi không thành công
                }
            }
        }
    
        return $paths;
    }
    

    public function get_file(){
        $dir = '/';
        $recursive = false;
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        return $contents;
    }

    public function delete_image($path){
        $dir = '/';
        $recursive = false;
        $fileinfo = collect(Storage::cloud()->listContents($dir, $recursive))->where('type','file')->where('path' , $path )->first();
        if (!is_null($fileinfo) && isset($fileinfo['path'])) {
            return Storage::cloud()->delete($fileinfo['path']);
        }
        
        return false;
    }

    private function resizeImage($fileData, $width, $height)
    {
        // Tạo một ảnh mới từ dữ liệu ảnh gốc
        $image = imagecreatefromstring($fileData);
    
        // Lấy thông tin về kích thước ảnh gốc
        $originalWidth = imagesx($image);
        $originalHeight = imagesy($image);
    
        // Tính toán tỉ lệ scale cho việc thay đổi kích thước
        $scale = max($width / $originalWidth, $height / $originalHeight);
    
        // Tính toán kích thước mới dựa trên tỉ lệ đã tính toán
        $newWidth = $originalWidth * $scale;
        $newHeight = $originalHeight * $scale;
    
        // Tạo một ảnh mới với kích thước đã tính toán
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    
        // Thực hiện resize ảnh
        imagecopyresampled(
            $resizedImage, // Ảnh mới
            $image, // Ảnh gốc
            0, 0, 0, 0, // Vị trí và kích thước ảnh mới
            $newWidth, $newHeight, // Kích thước ảnh mới
            $originalWidth, $originalHeight // Kích thước ảnh gốc
        );
    
        // Tính toán kích thước cắt ảnh
        $cropWidth = min($newWidth, $width);
        $cropHeight = min($newHeight, $height);
    
        // Tính toán vị trí cắt ảnh để trung tâm
        $cropX = ($newWidth - $cropWidth) / 2;
        $cropY = ($newHeight - $cropHeight) / 2;
    
        // Cắt ảnh theo kích thước và vị trí đã tính toán
        $croppedImage = imagecrop($resizedImage, ['x' => $cropX, 'y' => $cropY, 'width' => $cropWidth, 'height' => $cropHeight]);
    
        // Tạo buffer để lưu dữ liệu ảnh mới
        ob_start();
        imagejpeg($croppedImage, null, 100);
        $resizedFileData = ob_get_clean();
    
        // Giải phóng bộ nhớ và trả về dữ liệu ảnh mới
        imagedestroy($image);
        imagedestroy($resizedImage);
        imagedestroy($croppedImage);
    
        return $resizedFileData;
    }
    
     

}
