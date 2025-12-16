<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['name', 'description', 'code', 'color', 'picture', 'manager_id'];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    /**
     * Get the manager that owns this module
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
