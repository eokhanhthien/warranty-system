<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   public function basic_email($content) {
   
      Mail::send([], [], function ($message) { 
        $message->to('thienpark.fx@gmail.com', 'Tutorials Point')
           ->subject('Long Tỵ - Giải pháp chuyển đổi số cho doanh nghiệp')
           ->from('twoeo64@gmail.com','Long Tỵ Digital')
           ->setBody('some body', 'text/html'); 
        });
        // return redirect()->back()->with('success', 'thêm danh mục thành công');
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
