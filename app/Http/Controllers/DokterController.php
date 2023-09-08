<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    function ViewDokter() {
        $namadokter = DB::table('dokter')
        ->select('dokter.kd_dokter', 'dokter.nm_dokter', 'dokter.no_telp')
        ->get();

        return view('dokter-view', [
            'namadokter'=>$namadokter,
        ]);
    }
}
