<?php
namespace App\Models\Procesos;
use Illuminate\Database\Eloquent\Model;
class VicidialLogTmp extends Model
{
    public $timestamps = false;
    protected $connection = 'logpredictivo';
    protected $table = 'vicidial_log_TMP';
}