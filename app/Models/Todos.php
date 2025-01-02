<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todos extends Model
{
    protected $table = 'todos';
    protected $fillable = ['nama_tugas', 'deskripsi', 'deadline', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
