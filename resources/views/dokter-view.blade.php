@extends('layout.layoutBody')
@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">LIST DOKTER</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th><b>Kode dokter</b></th>
                                    <th><b>Nama dokter</b></th>
                                    <th class="text-center"><b>Antrian Pasien</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($namadokter as $item)
                                    <tr>
                                        <td><b>{{ $item->kd_dokter }}</b></td>
                                        <td><b>{{ $item->nm_dokter }}</b></td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <form action="{{ url('/view-pasien') }}" method="" class="mx-2">
                                                @csrf
                                                <input type="hidden" name="kd_dokter" value="{{ $item->kd_dokter }}">
                                                <button type="submit" class="btn btn-success text-white">List Pasien</button>
                                            </form>
                                            <form action="{{ url('/view-antrian') }}" method="">
                                                @csrf
                                                <input type="hidden" name="kd_dokter" value="{{ $item->kd_dokter }}">
                                                <button type="submit" class="btn btn-primary">Antrian</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
