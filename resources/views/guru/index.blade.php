@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12 mt-3">
            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <center>
                                <h6 class="m-0 font-weight-bold text-primary">Materi Yang Di Upload</h6>
                        </center>
                    </div>
                    <a class="btn btn-success" href="{{ route('guru.create')}}"> Tambah Data Guru</a>
                    
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                        <div class="pull-right">
            </div></br>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr class="text-center">
                                        <th>NIP</th>
                                        <th>MAPEL</th>
                                        <th>RPP</th>
                                        <th>LINK MATERI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($dk as $dt)
                                            <tr class="text-center">
                                                <td>{{$dt->nip}}</td>
                                                <td>{{$dt->mapel}}</td>
                                                <td>{{$dt->rpp}}</td>
                                                <td>{{$dt->embed}}</td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div></br>
@endsection
