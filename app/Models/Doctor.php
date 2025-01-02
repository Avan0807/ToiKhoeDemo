<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    // Tên bảng trong cơ sở dữ liệu (nếu khác tên mặc định của model)
    protected $table = 'Doctors';

    // Cột khóa chính trong bảng (nếu khác 'id')
    protected $primaryKey = 'doctorID';

    // Tắt timestamps
    public $timestamps = false;

    // Các cột cho phép "mass assignment"
    protected $fillable = [
        'name',
        'specialization', // Đã sửa từ 'specialty' thành 'specialization'
        'email',
        'phone',
        'location', // Đã sửa từ 'address' thành 'location'
        'working_hours', // Thêm cột này nếu cần
        'status',
    ];

    // Định nghĩa quan hệ "One-to-Many" với Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'doctorID', 'doctorID');
    }

    
}
