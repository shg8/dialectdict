<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function translations()
    {
        return $this->belongsToMany(Translation::class);
    }

}
