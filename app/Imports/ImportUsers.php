<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;


class ImportUsers implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       //dd($row[1]);
        return new User([
            'cedula'            => $row[0],
            'nombre1'           => $row[2],
            'nombre2'           => 'xxxxxxxxxxx',
            'apellido_paterno'  => $row[3],
            'apellido_materno'  => 'xxxxxxxxxxx', 
            'direccion'         => 'xxxxxxxxxxx',
            'celular'           => '0999999999',
            'genero_id'         => 2, 
            'telefono'          => '0999999999', 
            'foto'              => '', 
            'estado_civil'      => '', 
            'email'             => '', 
            'discapacidad'      => 0, 
            'comentario'        => '', 
            'extension'         => '', 
            'usuario'           => $row[1], 
            'password'          => '$2y$10$x7s2aQK8JDd4AzCMKAt4legcD9S9MOsnZxwFSPcPEgI.uGX/mYShS', 
            'perfil_actualizado'=> 0, 
            'enabled'           => 1,      
            'created_at'        => '2019-08-24 11:27:56', 
            'updated_at'        => '2019-08-24 11:28:11', 
            'fecha_nacimiento'  => '2019-08-24 11:28:11',
            'area'              => 'Ventas',
        ]);
    }
}
