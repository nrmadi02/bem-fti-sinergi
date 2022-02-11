<?php

namespace App\Http\Controllers\app;

use App\Models\User;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListAnggotaController extends Controller
{
    //
    public function ListVerifiedUser()
    {
        $admin_count = User::where('role', 'admin')->get()->count();
        $anggota_count = User::where('role', 'anggota')->get()->count();
        $verified_count = User::where('is_verified', 1)->get()->count();
        $unverified_count = User::where('is_verified', 0)->get()->count();
        $pageConfigs = ['pageHeader' => false];
        return view('/anggota/list-verified-user', [
            'pageConfigs' => $pageConfigs,
            'anggotaCount' => $anggota_count,
            'adminCount' => $admin_count,
            'verifiedCount' => $verified_count,
            'unverifiedCount' => $unverified_count,
        ]);
    }

    public function getListVerifiedUser()
    {
        $data = User::all();
        return Datatables::of($data)->make(true);
    }
}
