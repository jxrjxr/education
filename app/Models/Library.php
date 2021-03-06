<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Eloquent
{
    use SoftDeletes;
    protected $dates = ['create_at', 'update_at', 'deleted_at'];
    protected $guarded = ['id'];
}