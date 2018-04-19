<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    //
	use SoftDeletes;

    protected $table = "tasks";

    protected $fillable = [
    	'name',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
