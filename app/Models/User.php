<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

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

    public function getRecords($search)
    {
        return $this->all();
    }

    public function getRecord($id)
    {
        return $this->where('id', $id)->first();
    }

    public function saveOrUpdate($id = '', $body)
    {
        $save = $this->firstOrNew(['id' => $id]);
        $save->fill($body);
        $save->password = Hash::make($body['password']);
        return $save->save();
    }

    public function deleteRecord($id)
    {
        return $this->findOrFail($id)->delete();
    }

    public function assignRole($user_id, $role_id ) 
    {
        $role = Role::findById($role_id);
        $user = $this->find($user_id);
        return $user->assignRole($role);
    }
}
