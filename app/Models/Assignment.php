<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'tingkat',
        'kelas',
        'tanggal_deadline',
        'file',
        'created_by'
    ];

    protected $casts = [
        'tanggal_deadline' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
