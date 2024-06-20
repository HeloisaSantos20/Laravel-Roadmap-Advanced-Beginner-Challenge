<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'deadline',
        'user_id',
        'status'
    ];

    protected $dates = [
        'deleted_at',
        'deadline',
    ];

    public const STATUS = ['open', 'in progress', 'paused', 'cancelled', 'completed'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getDeadline($format = 'Y-m-d')
    {
        if ($this->deadline) {
            return Carbon::parse($this->deadline)->format($format);
        }
        return null;
    }
}
