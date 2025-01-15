<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\User;

class Appointment extends Model
{
    use HasFactory;

    // Đặt tên bảng, nếu không Laravel sẽ mặc định lấy tên số nhiều của model (appointments)
    protected $table = 'Appointments';

    // Các cột có thể được gán giá trị trực tiếp
    protected $fillable = [
        'userID',              // ID người dùng đặt lịch
        'doctorID',            // ID bác sĩ
        'date',                // Ngày đặt lịch
        'time',                // Thời gian
        'consultation_type',   // Loại tư vấn (Online/Offline)
        'note',                // Ghi chú
        'status',              // Trạng thái lịch hẹn (chờ duyệt, hoàn thành, hủy)
        'approval_status',     // Trạng thái phê duyệt (chờ duyệt, đã duyệt, từ chối)
        'workflow_stage'       // Giai đoạn trong quy trình (initial review, approved, ...)
    ];

    // Accessor: Tạo trường kết hợp `date` và `time` thành datetime
    public function getStartAttribute()
    {
        return $this->date . ' ' . $this->time;
    }

    // Relationship: Liên kết với người dùng (User)
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    // Relationship: Liên kết với bác sĩ (Doctor)
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctorID', 'id');
    }
}
