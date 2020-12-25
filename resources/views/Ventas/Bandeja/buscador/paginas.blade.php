@if (count($clientes))
   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombres</th>
                <th>Campaña</th>
            </tr>
            <tbody>
                @foreach ($clientes as $item)
                <tr>
                    <td style="width: 10px">{{ $item->IdCampañaPersona }}</td>
                    <td style="width: 10px">{{ $item->Campo2 }}</td>
                    <td>{{ $item->Descripcion }}</td>
                    <td style="width: 5px"> <a href="{{ route('agenda.show', [$item->IdCampañaPersona,$item->IdCampaña]) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a></td>
                </tr>
                @endforeach   
            </tbody>
        </thead>
        

    
    </table>
     
             
@endif