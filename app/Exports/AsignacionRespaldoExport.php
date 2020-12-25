<?php

namespace App\Exports;

use App\Models\Cobranza\Asinacionrespaldo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
class AsignacionRespaldoExport implements FromQuery,WithHeadings
{

    use Exportable;
    

    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
                    'IDC',	'ASESOR',	'Campo9',
                ];
    }
    public function query()
    {
        
        return Asinacionrespaldo::query()->select(
            'IDC',	'ASESOR',	'Campo9'
           )
            ->from('ASIGNAR');

       
    }
}
