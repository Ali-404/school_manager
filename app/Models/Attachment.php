<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'module_id',
        'uploaded_by',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

     public function getExtensionAttribute()
    {
        if (!$this->file_path) return null;

        return Str::afterLast($this->file_path, '.'); // returns "pdf", "png", etc.
    }
}
