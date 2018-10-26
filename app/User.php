<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasApiTokens;
    use HasRoles;
    private $expire_at = 3600;
    //protected $table = '';
    //protected $primaryKey = 'dd';
    //protected $incrementing
    protected $keyType;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token','expire_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function createToken()
    {
        $token = Uuid::uuid4()->toString();
        self::Query()->updateOrCreate(
            ['name' => $this->name],
            ['api_token' => $token,'expire_at' => date('Y-m-d H:i:s',time() + $this->expire_at)]
        );
        return $token;
    }

    public static function registerRules()
    {
        return array(
            'name' => 'required',
            //'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        );
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
}
