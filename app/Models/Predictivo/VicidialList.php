<?php
namespace App\Models\Predictivo;
use Illuminate\Database\Eloquent\Model;
class VicidialList extends Model
{
    protected $connection = 'asterisk';
    protected $table = 'vicidial_list';
    protected $primaryKey = 'uniqueid';
}