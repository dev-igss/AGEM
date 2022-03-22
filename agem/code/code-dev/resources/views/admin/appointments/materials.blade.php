@extends('admin.master')
@section('title','Materiales Usados')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/all') }}" class="nav-link"><i class="fas fa-columns"></i> Citas</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Material Usados</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">

        <div class="header">
            <h2 class="title"><i class="fas fa-clipboard-list"></i> Listado de Materiales Usados en Cita  </h2>
            <ul>


            </ul>
        </div>

        <div class="inside">

            <table id="table-modules" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td><strong> FECHA DE REGISTRO </strong></td>
                        <td><strong> ESTUDIO</strong></td>
                        <td><strong> MATERIAL </strong></td>
                        <td><strong> CANTIDAD</strong></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $ma)
                        <tr>
                            <td>{{ $ma->created_at }}</td>
                            <td>{{ $ma->study->name }}</td>
                            <td>{{ getMaterials(null, $ma->material)  }}</td>
                            <td>{{ $ma->amount }}</td>
                        </tr>
                    @endforeach                    
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection