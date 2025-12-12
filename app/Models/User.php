<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Permission;
use App\Models\UserPermission;
use App\Models\Role;
use Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'usertype',
        'epf_number',
        'phone',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

      public function permissions(){

        return $this->belongsToMany(Permission::class, 'user_has_permissions');

    }

    public function hasPermission($permission) {



        $userHasPermission = null;



        $permissionRec = Permission::where('permission_name',$permission)->get()->first();



        if($permissionRec != null){



            $userHasPermission = UserPermission::where('permission_id',$permissionRec->id)

            ->where('user_id',Auth::user()->id)->get()->first();

        }





        return $userHasPermission != null ? true : false;



    }



    public static function getUserPermissions($userId){



        return UserPermission::where('user_id',$userId)->pluck('permission_id')->toArray();

    }

}
