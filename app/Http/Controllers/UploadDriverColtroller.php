<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Storage;
use File;
class UploadDriverColtroller extends Controller
{
    public function upload_image(Request $request){
        $file = $request->file('image');
        $fileData = File::get($file);
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        
        $result = Storage::cloud()->put($fileName, $fileData);
        
        if ($result) {
            $metadata = Storage::cloud()->getMetadata($fileName);
            $path = $metadata['path'];
            return $path;
        } else {
            // Xử lý khi không thành công
        }
    }

    public function get_file(){
        $dir = '/';
        $recursive = false;
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        return $contents;
    }

    public function resizeImage($file, $width, $height)
{
    // Lấy thông tin kích thước ảnh gốc
    list($srcWidth, $srcHeight) = getimagesize($file);
    // Tạo ảnh mới với kích thước thu nhỏ
    $dstImage = imagecreatetruecolor($width, $height);
    // Tạo ảnh từ file gốc
    $srcImage = imagecreatefromjpeg($file);
    // Thực hiện thu nhỏ ảnh
    imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);
    // Lưu ảnh thu nhỏ vào buffer
    ob_start();
    imagejpeg($dstImage, null);
    // Lấy ảnh thu nhỏ dưới dạng chuỗi byte
    $thumbnail = ob_get_clean();
    // Giải phóng bộ nhớ
    imagedestroy($srcImage);
    imagedestroy($dstImage);
    return $thumbnail;
}

}
