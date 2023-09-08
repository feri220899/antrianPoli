<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AntrianPasienController extends Controller
{
    function AntrianPasien() {
        return view('antrian-pasien');
    }
    function ViewAntrianPasien(Request $request) {
        $daftarPasien = DB::table('reg_periksa')
        ->select('pasien.nm_pasien', 'reg_periksa.no_reg', 'reg_periksa.no_rawat', 'dokter.nm_dokter', 'reg_periksa.tgl_registrasi')
        ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
        ->join('dokter', 'reg_periksa.kd_dokter', '=', 'dokter.kd_dokter')
        ->leftJoin("antripoli", function($join){
            $join->on('reg_periksa.no_rawat', '=', 'antripoli.no_rawat');
        })
        ->where('reg_periksa.kd_dokter', '=', $request->kd_dokter)
        ->whereNotExists(function ($query) {
            $query->from('antripoli')
                  ->whereRaw('reg_periksa.no_rawat = antripoli.no_rawat');
        })
        ->whereDate('reg_periksa.tgl_registrasi', '=', now()->format('Y-m-d') )
        ->orderBy('reg_periksa.no_reg', 'asc')
        ->take(1)
        ->get();
        return view('component.view-antrian', [
            'daftarPasien'=>$daftarPasien,
        ]);
    }
}
