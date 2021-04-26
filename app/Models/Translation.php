<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function setPronunciationUploadAttribute($value)
    {
        if (!is_string($value)) {
            $attribute_name = "pronunciation_upload";
            $disk = "public";
            $destination_path = "pronunciation";

            $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
        } else {
            $this->attributes['pronunciation_upload'] = $value;
        }
    }
}
