<?php
namespace App\Models\Procesos;
use Illuminate\Database\Eloquent\Model;
class VicidialListTmp extends Model
{
    public $timestamps = false;
    protected $connection = 'logpredictivo';
    protected $table = 'vicidial_list_TMP';
}