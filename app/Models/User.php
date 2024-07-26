<?php

namespace App\Models;

use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Orchid\Access\UserAccess;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Platform\Models\User as OrchidUser;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Orchid\Screen\AsSource;

class User extends OrchidUser implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use AsSource, Chartable, Filterable, HasFactory, Notifiable, UserAccess;

    protected $table = 'users' ;

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $allowedSorts = [
        'id',
        'email',
        'created_at',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function hasAccess_SAYED(string $permit, bool $cache = true): bool
    {

        if (! $cache || $this->cachePermissions === null) {
            $this->cachePermissions = $this->roles()
                ->pluck('permissions')
                ->filter(fn ($permission) => is_array($permission));
        }

        if(is_array($this->permissions)){
            $this->rrr = $this->cachePermissions->map(function ($rolePermissions) {
                foreach($this->permissions as $permissionKey => $userPermission) {
                    $rolePermissions[$permissionKey] = $userPermission;
                }
                return $rolePermissions;
            });
        }
        else $this->rrr = $this->cachePermissions;

        return $this->rrr->filter(function (array $permissions) use ($permit) {
            return $this->filterWildcardAccess($permissions, $permit);
        })->isNotEmpty();
    }

    public function createActivationCode()
    {
        $verificationCode = rand(10000, 99999);
        $this->verification_code = $verificationCode;
        $this->save();
    }

    public function sendEmailVerificationNotification()
    {
        $this->createActivationCode();
        $this->notify(new VerifyEmail);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
    
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
