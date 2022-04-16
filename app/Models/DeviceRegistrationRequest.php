<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeviceRegistrationRequest
 *
 * @property int $id
 * @property string $device_id
 * @property string $code
 * @property string $expiry
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceRegistrationRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceRegistrationRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceRegistrationRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceRegistrationRequest whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceRegistrationRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceRegistrationRequest whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceRegistrationRequest whereExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceRegistrationRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceRegistrationRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeviceRegistrationRequest extends Model
{

    public $fillable = ['device_id', 'code', 'expiry'];
    use HasFactory;

    public $casts = [
        'expiry' => 'datetime'
    ];
}
