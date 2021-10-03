<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineFriend extends Model
{
    protected $fillable = ['line_id', 'display_name'];
    use HasFactory;
}
