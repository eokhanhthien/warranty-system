<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\EmailVerificationCode;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MailController extends Controller {
   public function verify_email($email) {
      // Tạo chuỗi xác thực
      $codeLength = 6;
      $verificationCode = '';
      for ($i = 0; $i < $codeLength; $i++) {
         $verificationCode .= random_int(0, 9);
      }

      // Tạo thời gian hết hạn
      $currentDateTime = Carbon::now();
      $currentDateTime->setTimezone('Asia/Ho_Chi_Minh');
      $expiresAt = $currentDateTime->addMinutes(20);

      $email_verify = new EmailVerificationCode();
      $email_verify->email = Auth::user()->email;
      $email_verify->code = $verificationCode;
      $email_verify->expires_at = $expiresAt;
      $email_verify->save();

      // Tạo nội dung email với mã xác thực
      $emailContent = "Mã xác thực của bạn là: $verificationCode (Có hiệu lực trong 20 phút)";
  
      // Gửi email
      Mail::send([], [], function ($message) use ($email, $emailContent) { 
          $message->to($email, 'Tutorials Point')
             ->subject('Long Tỵ - Giải pháp chuyển đổi số cho doanh nghiệp')
             ->from('twoeo64@gmail.com','Long Tỵ Digital')
             ->setBody($emailContent, 'text/html'); 
      });
      $output = 'Thành công, vui lòng kiểm tra email';
      return $output;
  }

  public function confirm_verify_email(Request $request) {
      $is_code = EmailVerificationCode::where('email', Auth::user()->email)
      ->where('code',$request->verify_code)
      ->where('expires_at', '>', now()) 
      ->latest() 
      ->first(); 

      if ($is_code) {
         Auth::user()->verify_email_at = now();
         Auth::user()->save();
         return redirect()->back()->with('success', 'Xác thực thành công');
      } else {
         return redirect()->back()->with('error', 'Sai mã xác thực, vui lòng kiểm tra lại');
      }
  }
   public function html_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('path/to/attachment.txt');
         $message->attach('path/to/image.png');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}
