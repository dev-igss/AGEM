@extends('admin.master')
@section('title','Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users/1') }}" class="nav-link"><i class="fas fa-user-lock"></i> Usuarios</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

        <div class="header">
                <h2 class="title"><i class="fas fa-user-lock"></i> Usuarios</h2>
                <ul>
                    <li>
                        <a href="#"><i class="fas fa-chevron-down"></i> Filtar</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('/admin/users/1')}}"><i class="fas fa-user-check"></i> Activos</a></li>
                            <li><a href="{{url('/admin/users/0')}}"><i class="fas fa-user-times"></i> Suspendidos</a></li>
                            <li><a href="{{url('/admin/users/0')}}"><i class="fas fa-users-slash"></i> Eliminados</a></li>
                            <li><a href="{{url('/admin/users/all')}}"><i class="fas fa-users"></i> Todos</a></li>
                        </ul>
                    </li>
                    @if(kvfj(Auth::user()->permissions, 'user_add'))
                        <li>
                            <a href="{{ url('/admin/users/add') }}" ><i class="fas fa-plus-circle"></i> Agregar Usuario</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="inside">
                <table id="table-modules" class="table table-striped table-hover mtop16">
                    <thead>
                        <tr>
                            <td><strong> OPCIONES </strong></td>
                            <td><strong> NOMBRE </strong></td>
                            <td><strong> ROL </strong></td>
                            <td><strong> ESTADO </strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'user_edit'))
                                            <a href="{{ url('/admin/user/'.$user->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Ver"><i class="fas fa-eye"></i></a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'user_permissions'))
                                            <a href="{{ url('/admin/user/'.$user->id.'/permissions') }}" data-toogle="tooltrip" data-placement="top" title="Permisos"><i class="fas fa-cogs"></i></a>
                                        @endif
                                    </div>
                                </td>
                                <td>{{'IBM:'.$user->ibm.' - '.$user->name.' '.$user->lastname}}</td>
                                <td>{{ getRoleUserArray(null, $user->role) }}</td>
                                <td>{{ getUserStatusArray(null, $user->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
