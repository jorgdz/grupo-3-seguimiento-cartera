<?php

namespace App\Imports;

use App\Models\Operaciones\Formatodp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FormatodpImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        return new Formatodp([
            
            'TIPDOC'  =>  $row["tipdoc"],	
            'IDENTIFICACION'  =>  $row["identificacion"],	
            'NOMBREUNO'  =>  $row["nombreuno"],	
            'NOMBREDOS'  =>  $row["nombredos"],	
            'APELLIDOPATERNO'  =>  $row["apellidopaterno"],	
            'APELLIDOMATERNO'  =>  $row["apellidomaterno"],	
            'CARGAS'  =>  $row["cargas"],	
            'LUGARNACI'  =>  $row["lugarnaci"],	
            'FECNACIMIENTO'  =>  $row["fecnacimiento"],	
            'NACIONALIDAD'  =>  $row["nacionalidad"],	
            'NIVELINSTRUC'  =>  $row["nivelinstruc"],	
            'DIRECDOMICILIO'  =>  $row["direcdomicilio"],	
            'REFERENCIADOMICILIO'  =>  $row["referenciadomicilio"],	
            'LOCALIDADDOMICILIO'  =>  $row["localidaddomicilio"],	
            'CIUDADDOMICILIO'  =>  $row["ciudaddomicilio"],	
            'COMISIONES'  =>  $row["comisiones"],	
            'CUPOSOLICITADO'  =>  $row["cuposolicitado"],	
            'PROFESION'  =>  $row["profesion"],	
            'CONYUGUE'  =>  $row["conyugue"],	
            'TIPODOCCONYUGUE'  =>  $row["tipodocconyugue"],	
            'IDENTIFICACIONCONYU'  =>  $row["identificacionconyu"],	
            'TLFDOMIC1'  =>  $row["tlfdomic1"],	
            'TLFDOMIC2'  =>  $row["tlfdomic2"],	
            'CELULAR1'  =>  $row["celular1"],	
            'CELULAR2'  =>  $row["celular2"],	
            'SEXO'  =>  $row["sexo"],	
            'ESTADOCIVIL'  =>  $row["estadocivil"],	
            'EMAIL'  =>  $row["email"],	
            'EMAIL2'  =>  $row["email2"],	
            'TIPOVIVIENDA'  =>  $row["tipovivienda"],	
            'VALORRENTA'  =>  $row["valorrenta"],	
            'TIEMRESIDE'  =>  $row["tiemreside"],	
            'TRABAJO'  =>  $row["trabajo"],	
            'DIRECTRABAJO'  =>  $row["directrabajo"],	
            'REFERENCIATRABAJO'  =>  $row["referenciatrabajo"],	
            'LOCALIDADTRABAJO'  =>  $row["localidadtrabajo"],	
            'CARGO'  =>  $row["cargo"],	
            'SUELDO'  =>  $row["sueldo"],	
            'TIEMTRABAJO'  =>  $row["tiemtrabajo"],	
            'CIUDADTRABAJO'  =>  $row["ciudadtrabajo"],	
            'TLFTRABA1'  =>  $row["tlftraba1"],	
            'TLFTRABA2'  =>  $row["tlftraba2"],	
            'EXTTRABA1'  =>  $row["exttraba1"],	
            'EXTTRABA2'  =>  $row["exttraba2"],	
            'OTROSINGRESOS'  =>  $row["otrosingresos"],	
            'ORIGENOTROS'  =>  $row["origenotros"],	
            'VALOROTROS'  =>  $row["valorotros"],	
            'TRABAANTERIOR'  =>  $row["trabaanterior"],	
            'CARGOANTERIOR'  =>  $row["cargoanterior"],	
            'TLFTRABANTE'  =>  $row["tlftrabante"],	
            'SUELDOANTERIOR'  =>  $row["sueldoanterior"],	
            'TRABACONYUGUE'  =>  $row["trabaconyugue"],	
            'DIRETRABACONYUGUE'  =>  $row["diretrabaconyugue"],	
            'CARGOCONYUGUE'  =>  $row["cargoconyugue"],	
            'TLFCONYUGUE'  =>  $row["tlfconyugue"],	
            'SUELDOCONYUGUE'  =>  $row["sueldoconyugue"],	
            'REFECOMER1'  =>  $row["refecomer1"],	
            'REFECOMER2'  =>  $row["refecomer2"],	
            'TLFREFECOMER1'  =>  $row["tlfrefecomer1"],	
            'TLFREFECOMER2'  =>  $row["tlfrefecomer2"],	
            'PARIENTEUNO'  =>  $row["parienteuno"],	
            'PARENTESCOUNO'  =>  $row["parentescouno"],	
            'DIRECPARIUNO'  =>  $row["direcpariuno"],	
            'TLFPARIUNO'  =>  $row["tlfpariuno"],	
            'PARIENTEDOS'  =>  $row["parientedos"],	
            'PARENTESCODOS'  =>  $row["parentescodos"],	
            'DIRECPARIDOS'  =>  $row["direcparidos"],	
            'TLFPARIDOS'  =>  $row["tlfparidos"],	
            'NOMBREPLASTICO'  =>  $row["nombreplastico"],	
            'TIENDAENTREGA'  =>  $row["tiendaentrega"],	
            'CASILLA'  =>  $row["casilla"],	
            'CIUDADCASILLA'  =>  $row["ciudadcasilla"],	
            'LOCALIDADCASILLA'  =>  $row["localidadcasilla"],	
            'ESTCTADOMICILIO'  =>  $row["estctadomicilio"],	
            'ESTCTATRABAJO'  =>  $row["estctatrabajo"],	
            'ESTCTACASILLA'  =>  $row["estctacasilla"],	
            'MSGCOBRANZA'  =>  $row["msgcobranza"],	
            'MSGSALDOS'  =>  $row["msgsaldos"],	
            'MSGPROPAG'  =>  $row["msgpropag"],


        ]);
    }
}
