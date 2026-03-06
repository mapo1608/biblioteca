<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    protected $table = 'personal_data';
    public $timestamps = false;

    protected $fillable=[
        'name',
        'surname',
        'email',
        'phone',
        'address',
        'birth_date',
    ];

    

    /**
     * relazione personal_data - users
     */
    public function user()
    {
        return $this->hasOne(User::class, 'fk_personal_data');
    }
}
