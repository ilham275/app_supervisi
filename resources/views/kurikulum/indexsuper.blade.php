@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12 mt-3">
            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <center>
                                <h6 class="m-0 font-weight-bold text-primary">Data Guru Supervisor Dan Kurikulum</h6>
                        </center>
                    </div>
                    <a class="btn btn-success" href="{{ route('tocreate')}}"> Tambah Data Guru</a>
                    
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
                                        <th>NAMA</th>
                                        <th>EMAIL</th>
                                        <th>JABATAN</th>
                                        <th>SUPERVISOR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($data as $dt)
                                            <tr class="text-center">
                                                <td>{{$dt->nip}}</td>
                                                <td>{{$dt->nama}}</td>
                                                <td>{{$dt->email}}</td>
                                                <td>
                                                    @if($dt->is_admin == '1')
                                                    Kurikulum
                                                    @elseif($dt->is_admin == '2')
                                                    Kepsek
                                                    @elseif($dt->is_admin == '3')
                                                    Guru
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($dt->supervisor == 0)
                                                    Bukan Supervisor
                                                </br>
                                                <a href="{{ route('kurikulum.to.supervisor', $dt->id) }}" class="btn btn-sm btn-success">Active</a>
                                                @else
                                                    Supervisor
                                                </br>
                                                <a href="{{ route('kurikulum.delete.supervisor', $dt->id) }}" class="btn btn-sm btn-danger">Deactive</a>
                                                @endif
                                                </td>
                                                <!-- <td>
                                                <a class="btn btn-primary" href="{{route('edit', $dt->id)}}">Edit</a>


                                                </td> -->
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div></br>

                
                

            </div>
            <!-- /.container-fluid -->
        </div>
    </div>
<div class="row">
        <div class="col-md-12 mt-3">
            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <center>
                                <h6 class="m-0 font-weight-bold text-primary">Jadwal Supervisor</h6>
                        </center>
                    </div>
</br>
                    <a class="btn btn-warning" href="{{ route('tojadwal')}}">Tambah Data Jadwal Supervisor</a>
                    
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
                                        <th>NIP SUPERVISOR</th>
                                        <th>NIP GURU</th>
                                        <th>TANGGAL</th>
                                        <th>DARI WAKTU</th>
                                        <th>SAMPAI WAKTU</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($jd as $dt)
                                            <tr class="text-center">
                                                <td>{{$dt->nip_super}}</td>
                                                <td>{{$dt->nip_user}}</td>
                                                <td>{{$dt->tanggal}}</td>
                                                <td>{{$dt->time1}}</td>
                                                <td>{{$dt->time2}}</td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div></br>

                
                

            </div>
            <!-- /.container-fluid -->
        </div>
    </div>


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
                                        <th>VERIFIKASI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($dk as $dt)
                                            <tr class="text-center">
                                                <td>{{$dt->nip}}</td>
                                                <td>{{$dt->mapel}}</td>
                                                <td><a href="{{asset('files/'.$dt->rpp)}}" class="ml-2" target="_blank">lihat</a></td>
                                                <td><a href="{{ $dt->embed }}" class="ml-2" target="_blank">lihat</a></td>
                                                <td>{{$dt->nilai}}</td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <center>
                                <h6 class="m-0 font-weight-bold text-primary">Materi Yang Perlu DiSupervisor</h6>
                        </center>
                    </div>
                    
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
                                        <th>VERIFIKASI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($dk as $dt)
                                            <tr class="text-center">
                                                <td>{{$dt->nip}}</td>
                                                <td>{{$dt->mapel}}</td>
                                                <td><a href="{{asset('files/'.$dt->rpp)}}" class="ml-2" target="_blank">lihat</a></td>
                                                <td><a href="{{ $dt->embed }}" class="ml-2" target="_blank">lihat</a></td>
                                                <td>{{$dt->nilai}}</td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
@endsection
