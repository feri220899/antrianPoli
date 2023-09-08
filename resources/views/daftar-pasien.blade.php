@extends('layout.layoutBody')
@section('title', 'Home')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">LIST PASIEN</h5>
                <div class="table-responsive">
                    <table  class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No Reg</th>
                                <th>Nama Pasien</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarPasien as $item)
                                <tr
                                @if ($item->status === '0')
                                    style="background-color:#30E3DF;"
                                @elseif($item->status === '1')
                                    style="background-color:#F97B22;"
                                @endif
                                >
                                    <td>{{ $item->no_reg }}</td>
                                    <td>{{ $item->nm_pasien }}</td>
                                    <td class="text-center d-flex justify-content-center">
                                        <form action="{{url('/input-ada')}}" method="post">
                                            @csrf
                                                <input type="text" hidden name="kd_dokter" id="" value="{{ $item->kd_dokter}}">
                                                <input type="text" hidden name="kd_poli" id="" value="{{ $item->kd_poli}}">
                                                <input type="text" hidden name="no_rawat" id="" value="{{ $item->no_rawat}}">
                                                <button type="submit" class="btn btn-success mx-2 text-white" role="button" aria-disabled="true">Ada</a>
                                            </form>
                                            <form action="{{url('/input-tidak-ada')}}" method="post">
                                                @csrf
                                                <input type="text" hidden name="kd_dokter" id="" value="{{ $item->kd_dokter}}">
                                                <input type="text" hidden name="kd_poli" id="" value="{{ $item->kd_poli}}">
                                                <input type="text" hidden name="no_rawat" id="" value="{{ $item->no_rawat}}">
                                                <button type="submit" class="btn btn-danger text-white" role="button" aria-disabled="true">Tidak Ada</a>
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
