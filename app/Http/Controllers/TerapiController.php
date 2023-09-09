<?php

namespace App\Http\Controllers;

use App\Model\Terapi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
                'keluhan' => $request->keluhan,
            ]);

            return response()->json(['status' => true], 200);
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
}
