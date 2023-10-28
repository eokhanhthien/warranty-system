<?php

namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model implements Authenticatable
{
    protected $table = 'staffs';

    public function getAuthIdentifierName() {
        return 'id'; // Tên cột để xác định định danh người dùng
    }

    public function getAuthIdentifier() {
        return $this->getKey(); // Giá trị định danh của người dùng
    }

    public function getAuthPassword() {
        return $this->password; // Cột chứa mật khẩu đã được băm
    }

    public function getRememberToken() {
        return $this->remember_token; // Cột chứa token ghi nhớ
    }

    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    public function getRememberTokenName() {
        return 'remember_token'; // Tên cột để lưu trữ token ghi nhớ
    }
}
