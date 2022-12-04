<?php
    
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JoinController extends Controller
{
    public function index()
    {
        $joins = DB::table('consoles')
            ->join('storages', 'consoles.id_storage', '=', 'storages.id_storage')
            ->join('tokos', 'consoles.id_toko', '=', 'tokos.id_toko')
            ->select('consoles.nama_console as nama_console', 'storages.nama_storage as nama_storage','tokos.nama_toko as nama_toko')
            ->paginate(6);
            return view('totals.index',compact('joins'))
                ->with('i', (request()->input('page', 1) - 1) * 6);
    }
}