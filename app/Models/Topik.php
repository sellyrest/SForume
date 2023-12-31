<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    use HasFactory;
    protected $table = 'topiks';
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function saveds()
    {
        return $this->hasMany(Saved::class, 'topic_id', 'id');
    }
    public function responses() {
        return $this->belongsTo(Response::class, 'topic_id', 'id');
    }
    
    public function kategori()
    {
        return $this->belongsTo(TopikKategori::class, 'kategori_id', 'id');
    }

    public function report()
    {
        return $this->hasMany(Report::class, 'table_id', 'id')->where('table_name', 'topiks');
    }
}
