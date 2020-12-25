<?php
namespace App\Models\Predictivo;
use Illuminate\Database\Eloquent\Model;
class VicidialLog extends Model
{
    protected $connection = 'asterisk';
    protected $table = 'vicidial_log';
    protected $primaryKey = 'uniqueid';
}