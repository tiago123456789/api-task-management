<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "tasks";

    protected $fillable = [ "title", "description", "done", "date_due", "user_id" ];

    protected $hidden = [ "created_at", "updated_at" ];
}
