<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'company', 'company_logo', 'location', 'salary', 'description', 'benefits', 'type', 'condition'];
}
