@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <center>
                    <div class="card-header">{{ __('Tambah Materi') }}</div>
                </center>

                <div class="card-body">
                    <form method="POST" action="{{route('guru.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3" type="hidden">

                            <div class="col-md-6">
                            <input type="hidden" name="nip" value="{{ Auth::user()->nip }}">
                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="mapel" class="col-md-4 col-form-label text-md-end">{{ __('Mapel') }}</label>

                            <div class="col-md-6">
                            <select class="form-control" id="mapel" name="mapel" type="text">
                            <option>Pilih Mapel....</option>
                                <option>Matematika</option>
                                <option>Bahasa Indonesia</option>
                                <option>Kimia</option>
                                <option>Fisika</option>
                      
                    
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="rpp" class="col-md-4 col-form-label text-md-end">{{ __('RPP') }}</label>

                            <div class="col-md-6">
                                <input id="rpp" type="file" class="form-control @error('rpp') is-invalid @enderror" name="rpp" value="{{ old('rpp') }}" required autocomplete="rpp" autofocus>

                                @error('rpp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="embed" class="col-md-4 col-form-label text-md-end">{{ __('Embed') }}</label>

                            <div class="col-md-6">
                                <input id="embed" type="url" class="form-control @error('embed') is-invalid @enderror" name="embed" value="{{ old('embed') }}" required autocomplete="embed" autofocus >

                                @error('embed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                      
  


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tambah Jadwal') }}
                                </button>
                            </div>
                            
                        </div>
                        </br>
                    </form>
                    <a type="submit" class="btn btn-danger float-right" href="{{route('guru.index')}}">
                        {{ __('Kembali') }}
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
