<div class="text-center">
    @foreach ($daftarPasien as $item)
        <h2 class="font-weight-bold">POLI {{$item->nm_dokter}}</h2>
        <hr style="color: rgb(255, 255, 255); background-color: rgb(255, 255, 255); height: 2px; border: none;">
        <h1 class="font-weight-bold">NOMOR ANTRIAN</h1>
        <hr style="color: rgb(255, 255, 255); background-color: rgb(255, 255, 255); height: 2px; border: none;">
        <h1 class="display-1 font-weight-bold">{{ $item->no_reg }}</h1>
        <h1 class="font-weight-bold">{{ $item->nm_pasien }}</h1>
        <hr style="color: rgb(255, 255, 255); background-color: rgb(255, 255, 255); height: 2px; border: none;">
    @endforeach
</div>
