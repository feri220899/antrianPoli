<?php

namespace App\Http\Controllers;

use App\Models\Antripoli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PasienController extends Controller
{
    function ViewPasien(Request $request) {
        $daftarPasien = DB::table('reg_periksa')
            ->select('pasien.nm_pasien',
                'reg_periksa.no_reg',
                'reg_periksa.kd_dokter',
                'reg_periksa.kd_poli',
                'reg_periksa.no_rawat',
                'reg_periksa.tgl_registrasi',
                'antripoli.status')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('dokter', 'reg_periksa.kd_dokter', '=', 'dokter.kd_dokter')
            ->leftJoin("antripoli", function($join){
                $join->on('reg_periksa.no_rawat', '=', 'antripoli.no_rawat');
            })
            ->where('reg_periksa.kd_dokter', '=', $request->kd_dokter)
            ->whereDate('reg_periksa.tgl_registrasi', '=', now()->format('Y-m-d') )
            ->orderBy('reg_periksa.no_reg', 'asc')
            ->get();
        return view('daftar-pasien', [
            'daftarPasien'=>$daftarPasien,
        ]);
    }

    function inputAda(Request $request) {
        $cek = Antripoli::select('no_rawat', 'status')->where('no_rawat', $request->no_rawat)->first();
        $redirectUrl = url('/view-pasien');
        $csrfToken = Session::token();
        $redirectUrlWithToken = $redirectUrl . '?' . http_build_query(['_token' => $csrfToken, 'kd_dokter' => $request->kd_dokter]);
        if($cek == null){
            $request->validate([
                'no_rawat' => 'required|unique:antripoli'
            ]);
            Antripoli::create([
                'kd_dokter' => $request->kd_dokter,
                'kd_poli' => $request->kd_poli,
                'status' => '0',
                'no_rawat' => $request->no_rawat
            ]);
            return redirect($redirectUrlWithToken);
        }elseif($cek->status == '1'){
            Antripoli::where('no_rawat', $request->no_rawat)
            ->update(['status' => '0']);
            return redirect($redirectUrlWithToken);
        }
    }
    function inputTidakAda(Request $request) {
        $cek = Antripoli::select('no_rawat', 'status')->where('no_rawat', $request->no_rawat)->first();
        $redirectUrl = url('/view-pasien');
        $csrfToken = Session::token();
        $redirectUrlWithToken = $redirectUrl . '?' . http_build_query(['_token' => $csrfToken, 'kd_dokter' => $request->kd_dokter]);
        if($cek == null){
            $request->validate([
                'no_rawat' => 'required|unique:antripoli'
            ]);
            Antripoli::create([
                'kd_dokter' => $request->kd_dokter,
                'kd_poli' => $request->kd_poli,
                'status' => '1',
                'no_rawat' => $request->no_rawat
            ]);
            return redirect($redirectUrlWithToken);
        }elseif($cek->status == '0'){
            Antripoli::where('no_rawat', $request->no_rawat)
            ->update(['status' => '1']);
            return redirect($redirectUrlWithToken);
        }
    }
}
