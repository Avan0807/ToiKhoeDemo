<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Model
{
    use HasFactory, HasApiTokens;
    // Tên bảng trong cơ sở dữ liệu (nếu khác tên mặc định của model)
    protected $table = 'Doctors';

    // Cột khóa chính trong bảng (nếu khác 'id')
    protected $primaryKey = 'doctorID';

    // Tắt timestamps
    public $timestamps = false;

    // Các cột cho phép "mass assignment"
    protected $fillable = [
        'name',
        'specialization',
        'email',
        'phone',
        'location',
        'working_hours',
        'status',
    ];


    public function bookings()
    {
        return $this->hasMany(Booking::class, 'doctorID', 'doctorID');
    }
}
