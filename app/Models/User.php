<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * Các trường được phép gán giá trị.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'phoneNumber',
        'province',
    ];

    /**
     * Các trường bị ẩn khi trả về JSON.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * Các trường sẽ được tự động chuyển đổi kiểu dữ liệu.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Accessor: Tự động format số điện thoại khi truy cập.
     *
     * @return string
     */
    public function getPhoneNumberAttribute($value)
    {
        // Format số điện thoại thành +84-xxx-xxx-xxxx
        return '+84-' . substr($value, 1);
    }

    /**
     * Mutator: Tự động mã hóa mật khẩu khi lưu vào database.
     *
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Scope: Tìm kiếm người dùng theo tỉnh/thành phố.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $province
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByProvince($query, $province)
    {
        return $query->where('province', $province);
    }

    /**
     * Scope: Tìm kiếm người dùng theo số điện thoại.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $phoneNumber
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByPhoneNumber($query, $phoneNumber)
    {
        return $query->where('phoneNumber', $phoneNumber);
    }
}
