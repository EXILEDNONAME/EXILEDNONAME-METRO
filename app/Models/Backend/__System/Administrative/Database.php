<?php

namespace App\Models\Backend\__System\Administrative;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    use HasFactory;

    protected $table = 'system_backup_databases';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
