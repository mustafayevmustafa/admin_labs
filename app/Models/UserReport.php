<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    use HasFactory;
    protected $table = 'user_reports';

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_id', 'id');
    }
    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_id', 'id');
    }
    public function reportCategory()
    {
        return $this->belongsTo(ReportCategory::class, 'report_cat_id', 'id');
    }
}
