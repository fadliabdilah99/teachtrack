<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index()
    {
        $absenHariIni = Absensi::whereDate('created_at', date('Y-m-d'))->get();
        $absenKemarin = Absensi::whereDate('created_at', date('Y-m-d', strtotime('-1 days')))->get();



        // membandingkan data kehadiran hari ini dengan yang kemarin
        $persentase = 0;
        if ($absenKemarin->count() != 0) {
            if ($absenHariIni->count() > $absenKemarin->count()) {
                $persentase = round((($absenHariIni->count() - $absenKemarin->count()) / $absenKemarin->count()) * 100, 2);
                $data['presentase'] = 'naik ' . $persentase . '%';
                $data['status'] = '1';
            } elseif ($absenHariIni->count() < $absenKemarin->count()) {
                $persentase = round((($absenKemarin->count() - $absenHariIni->count()) / $absenKemarin->count()) * 100, 2);
                $data['presentase'] = 'turun ' . $persentase . '%';
                $data['status'] = '2';
            } else {
                $data['presentase'] = 'sama ';
                $data['status'] = '3';
            }
        } else {
            $data['presentase'] = 'tidak ada absen ';
            $data['status'] = '4';
        }


        // menghitung data kehadiran per hari ini dan untuk chart tahunan
        $data['siswaHadir'] = $absenHariIni->where('status', 'hadir')->count();
        $data['siswaTidakHadir'] = $absenHariIni->where('status', '!=', 'hadir')->count();
        $data['pemohon'] = User::where('role', 'pengajuan')->with('seller')->get();
        for ($i = 1; $i <= 12; $i++) {
            $kehadiranChart[] = Absensi::where('status', 'hadir')->whereMonth('created_at', $i)->whereYear('created_at', date('Y'))->count();
            $tidakhadirChart[] = pesanan::where('status', 'selesai')->whereMonth('created_at', $i)->whereYear('created_at', date('Y'))->count();
        }
        $data['kehadiranChart'] = json_encode($kehadiranChart);
        $data['tidakhadirChart'] = json_encode($tidakhadirChart);


        // transaksi
        $data['transaksiHariIni'] = pesanan::whereDate('created_at', date('Y-m-d'))->count();
        $data['transaksiKemarin'] = pesanan::whereDate('created_at', date('Y-m-d', strtotime('-1 days')))->count();
        if ($data['transaksiKemarin'] != 0) {
            if ($data['transaksiHariIni'] > $data['transaksiKemarin']) {
                $data['presentaseTransaksi'] = 'naik ' . round((($data['transaksiHariIni'] - $data['transaksiKemarin']) / $data['transaksiKemarin']) * 100, 2) . '%';
                $data['statusTransaksi'] = '1';
            } elseif ($data['transaksiHariIni'] < $data['transaksiKemarin']) {
                $data['presentaseTransaksi'] = 'turun ' . round((($data['transaksiKemarin'] - $data['transaksiHariIni']) / $data['transaksiKemarin']) * 100, 2) . '%';
                $data['statusTransaksi'] = '2';
            } else {
                $data['presentaseTransaksi'] = 'sama ';
                $data['statusTransaksi'] = '3';
            }
        } else {
            $data['presentaseTransaksi'] = 'tidak ada transaksi ';
            $data['statusTransaksi'] = '4';
        }
        return view('admin.home.index')->with($data);
    }
}
