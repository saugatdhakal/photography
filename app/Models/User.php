<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be String.
     * Convert Two Dates into days
     * @var <string, string>
     */
    public static function remaningDays($expires)
    {
        $now = time(); //Today Date
        $expiresDate = strtotime($expires);
        $datediff = $expiresDate - $now;
        return round($datediff / (60 * 60 * 24));;
    }
    /**
     * The attributes that should be String.
     * Get token and Check Token Expiers by passing expires date
     * @var <string>
     */
    public static function checkTokenExpiers($token)
    {
        [$id,$token] = explode('|',$token,2);
        $user = DB::table('personal_access_tokens')->find($id);
        $remainigdays = self::remaningDays($user->expires_at); // Get Remaning days
        // Return true if day left < 0

        if($remainigdays <= 0){
           self::deleteToken($id);
           return 'true';
        }else{
            return 'false';
        }

    }
    public static function deleteToken($id){
      $token = PersonalAccessToken::find($id);
      $token->delete();
    }
}
