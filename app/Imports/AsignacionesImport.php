<?php

namespace App\Imports;

use App\Models\Cobranza\Asignacion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AsignacionesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        foreach ($row as $key => $value) {
            if ($key != 'idc' && $key!='asesor') {
            ECHO " <hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><center><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr> <stronge style='background-color:red;';>  POR FAVOR INGRESAR EL FORMATO   CORRESPONDIENTE ,<BR/><BR/> COLUMNAS ---> | IDC | ASESOR </stronge><center> <BR/><a href='http://damplus.net/Asignaciones' ><i class='fa fa-eye'>VOLVER</a></i><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr> ";
               exit;
            }
           
        }
        
        return new Asignacion([
            
            'IDC'  =>  $row["idc"],	
            'ASESOR'  =>  $row["asesor"],	
            'Campo9'  =>  '',


        ]);
    }
}
