<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'Appointments';

    // Cột khóa chính trong bảng
    protected $primaryKey = 'appointmentID';

    // Tắt timestamps nếu không có trong bảng
    public $timestamps = false;

    // Các cột cho phép "mass assignment"
    protected $fillable = [
        'userID',
        'doctorID',
        'date',
        'time',
        'consultation_type',
        'note',
        'status',
    ];
}
