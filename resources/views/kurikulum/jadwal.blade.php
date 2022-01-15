@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <center>
                    <div class="card-header">{{ __('Tambah Data Jadwal') }}</div>
                </center>

                <div class="card-body">
                    <form method="POST" action="{{route('jadwal')}}">
                        @csrf


                        <div class="row mb-3">
                            <label for="nip_super" class="col-md-4 col-form-label text-md-end">{{ __('Supervisor') }}</label>

                            <div class="col-md-6">
                            <select class="form-control" id="nip_super" name="nip_super" type="text">
                            <option value="" selected disabled>Pilih...</option>
                                @foreach ($super as $item)
                                    <option value="{{$item->nip}}" {{old('nip') == $item->nip ? 'selected' : ''}}>{{$item->nama}}</option>
                                @endforeach
                    
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="time1" class="col-md-4 col-form-label text-md-end">{{ __('Dari Waktu') }}</label>

                            <div class="col-md-6">
                                <input id="time1" type="time" class="form-control @error('time1') is-invalid @enderror" name="time1" value="{{ old('time1') }}" required autocomplete="time1" autofocus>

                                @error('time1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="time2" class="col-md-4 col-form-label text-md-end">{{ __('Sampai Waktu') }}</label>

                            <div class="col-md-6">
                                <input id="time2" type="time" class="form-control @error('time2') is-invalid @enderror" name="time2" value="{{ old('time2') }}" required autocomplete="time2" autofocus>

                                @error('time2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal') }}</label>

                            <div class="col-md-6">
                                <input id="tanggal" type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}" required autocomplete="tanggal">

                                @error('tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="nip_user" class="col-md-4 col-form-label text-md-end">{{ __('Guru') }}</label>

                            <div class="col-md-6">
                            <select class="form-control" id="nip_user" name="nip_user" type="text">
                            <option value="" selected disabled>Pilih...</option>
                                @foreach ($not as $item)
                                    <option value="{{$item->nip}}" {{old('nip') == $item->nip ? 'selected' : ''}}>{{$item->nama}}</option>
                                @endforeach
                    
                                </select>
                            </div>
                        </div>

                        


  


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tambah') }}
                                </button>
                            </div>
                            
                        </div>
                        </br>
                    </form>
                    <a type="submit" class="btn btn-danger float-right" href="{{route('kurikulum.index')}}">
                        {{ __('Kembali') }}
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
