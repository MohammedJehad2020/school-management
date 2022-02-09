<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['Name_Class'];

    protected $fillable = [
        'Name)Class', 'Grade_id'
    ];

    public $timestamps = true;

    // علاقة بين الصفوف المراحل الدراسية لجلب اسم المرحلة في جدول الصفوف
    public function grades()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }

    
}
