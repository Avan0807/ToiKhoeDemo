<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu nó khác với mặc định
    protected $table = 'appointment';

    // Các cột được phép gán giá trị
    protected $fillable = [
        'userID',
        'doctorID',
        'date',
        'time',
        'consultation_type',
        'note',
        'status'
    ];

    // Tạo trường hợp hiển thị đầy đủ datetime từ `date` và `time`
    public function getStartAttribute()
    {
        return $this->date . ' ' . $this->time;
    }
}
