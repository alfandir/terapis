<?php

namespace App\Http\Controllers;

use App\Model\Terapi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class TerapiController extends Controller
{
    public function index()
    {
        return view('contents.terapi.list', [
            'title' => 'Terapi'
        ]);
    }

    function data()
    {
        $list = Terapi::select('*');

        return DataTables::of($list)
            ->addIndexColumn()
            ->make(true);
    }

    function store(Request $request)
    {
        $request->validate([
            'keluhan' => 'required'
        ]);


        try {
            Terapi::create([
                'name' => session('name'),
                'user_id' => Auth::id(),
                'keluhan' => $request->keluhan,
            ]);

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    function tanggapan(Request $request)
    {
        $request->validate([
            'tanggapan' => 'required',
        ]);

        try {
            $terapi = Terapi::find($request->id);

            $terapi->tanggapan = $request->tanggapan;
            $terapi->petugas_id = Auth::id();

            $terapi->status = 1;

            if ($terapi->isDirty()) {
                $terapi->save();
            }

            if ($terapi->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    function update(Request $request)
    {
        $request->validate([
            'keluhan' => 'required',
        ]);

        try {
            $terapi = Terapi::find($request->id);

            $terapi->keluhan = $request->keluhan;

            if ($terapi->isDirty()) {
                $terapi->save();
            }

            if ($terapi->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    function delete(Request $request)
    {
        try {
            $terapi = Terapi::find($request->id);

            $terapi->delete();

            if ($terapi->trashed()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    function export(Request $request)
    {
        $id = $request->input('id');
        // $id = Crypt::decrypt($encryptedId);

        $terapi = Terapi::find($id);

        $petugas = User::find($terapi->id);

        $data = [
            'title' => 'LAPORAN HASIL TERAPI',
            'petugas' => $petugas->name,
            'keluhan' => $terapi->keluhan,
            'tanggapan' => $terapi->tanggapan
        ];
        // Buat PDF dengan menggunakan laravel-dompdf
        $pdf = PDF::loadView('contents.terapi.export', $data); // Anda dapat membuat view PDF kustom

        // Simpan atau tampilkan PDF
        // Untuk menyimpan sebagai file PDF
        // $pdf->save(storage_path('exported.pdf'));

        // Untuk menampilkan PDF dalam browser
        return $pdf->stream();
    }
}
