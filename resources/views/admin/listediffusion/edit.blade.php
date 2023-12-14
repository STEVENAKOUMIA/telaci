@extends('layouts.admin_app')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gestion des liste de diffusion tela tv</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class=""><a href="{{route('home')}}">Accueil</a> ** </li>
                        <li class=""><a href="{{route('liste_diffusion.list')}}">Liste des programmes de diffusion</a></li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body d-flex">
                            <div class="col-12">
                                <form class="" action="{{route('liste_diffusion.update',$data->id)}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <h5 class="col-12">Modifier la liste de diffusion {{$data->title}}</h5><br>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label class="" for="input1">Titre<span class="contact__form--label__star">*</span></label>
                                                <input class="form-control" name="title"  placeholder="" type="text" required value="{{$data->title}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label class="" for="input1">Catégorie d'émission:{{$data->categorie_programme_tv_id}}<span class="contact__form--label__star">*</span></label>
                                                <select name="categorie_programme_id" class="form-control" id="" required>
                                                    @foreach($categories as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label class="" for="input1">Emission: {{$data->programme_tv_id }}<span class="contact__form--label__star">*</span></label>
                                                <select name="programme_tv_id" class="form-control" id="" required>
                                                    @foreach($programmes as $item)
                                                    <option value="{{$item->id}}">{{$item->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label class="" for="input1">Date de diffusion<span class="contact__form--label__star">*</span></label>
                                                <input class="form-control" name="date_diffusion"  placeholder="" type="datetime-local" required value="{{$data->date_diffusion}}">
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">Mettre à jour</button>
                                        <a href="{{route('liste_diffusion.list')}}" class="btn btn-secondary" data-dismiss="modal">Annuler</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
