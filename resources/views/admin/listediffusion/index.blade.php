@extends('layouts.admin_app')

@section('content')

    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gestion des liste de diffusion tela tv</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class=""><a href="{{route('home')}}">Accueil</a> ** </li>
                        <li class=""><a href="{{route('liste_diffusion.list',$date)}}">Liste des programme de diffusion</a></li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

<!--                            <form action="" method="get">
                                @csrf
                                <input type="date" name="date_diffusion" id="nouvelle_date">
                                <button onclick="onChangeDate()">Changer les dates</button>
                            </form><br><br>
                            -->
                            <a href="{{route('liste_diffusion.create')}}" class="btn btn-primary">Ajouter une liste de diffusion</a><br><br>
                        @if($datas->count()>0)
                            <!-- Button trigger modal -->
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Catégorie</th>
                                        <th>Emission</th>
                                        <th>Date diffusion</th>
                                        <th>Date</th>
                                        @if(auth()->user()->is_staff==1)
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($datas as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->categorieProgramme->name}}</td>
                                            <td>{{$data->programmeTv->nom}}</td>
                                            <td>{{$data->date_diffusion}}</td>
                                            <td>@if($data->created_at!=null) {{$data->created_at->format('d-m-Y')}} @else NEANT @endif</td>
                                            @if(auth()->user()->is_staff==1)
                                                <td>

                                                    <a href="{{route('liste_diffusion.edit',$data->id)}}" class="btn btn-warning btn-xs">Modifier</a>
                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#validateModal{{$data->id}}">
                                                        <i class="fa fa-trash"></i> Supprimer
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="validateModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <h3>Voulez vous supprimer la liste de diffusion N° {{$data->id}}</h3>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{route('liste_diffusion.delete',$data->id)}}" class="btn btn-success">Confirmer le suppression</a>
                                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Fermer</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--end modale --}}
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h5 class="text-center">Aucune liste de diffusion enregistrée pour le moment</h5>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
