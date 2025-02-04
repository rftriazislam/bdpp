<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'refer_id',
        'country',
        'city',
        'district',
        'phone',
        'role',
        'address',
        'balance',
        'user_type',
        'password',
        'birth_day',
        'thana'
    ];

    public function members()
    {
        return  $this->hasMany(User::class, 'refer_id', 'id');
    }
    public function childs()
    {
        return  $this->hasOne(UserView::class, 'user_id', 'id');
    }

    public function allmembers()
    {
        return $this->members()->withCount('allmembers');
    }

    public function countChildren($node = null)
    {
        $query = $this->members();
        // if (!empty($node))
        // {
        //     $query = $query->where('node', $node);
        // }

        $count = 0;
        foreach ($query->get() as $child) {
            $count += $child->countChildren() + 1; // Plus 1 to count the direct child
        }
        return $count;
    }
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
}
