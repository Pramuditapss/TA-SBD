<?php
    
namespace App\Http\Controllers;
    
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
    
class TokoController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:toko-list|toko-create|toko-edit|toko-delete', ['only' => ['index','show']]);
         $this->middleware('permission:toko-create', ['only' => ['create','store']]);
         $this->middleware('permission:toko-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:toko-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $tokos = DB::table('tokos')
                    ->where('nama_toko','LIKE','%'.$keyword.'%')
                    ->whereNull('deleted_at')
                    ->paginate(5);
        //$tokos = toko::latest()->paginate(5);
        return view('tokos.index',compact('tokos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tokos.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'id_toko' => 'required',
            'nama_toko' => 'required',
        ]);

        DB::insert('INSERT INTO tokos(id_toko, nama_toko) VALUES (:id_toko, :nama_toko)',
        [
            'id_toko' => $request->id_toko,
            'nama_toko' => $request->nama_toko,
        ]
        );
    
        //toko::create($request->all());
    
        return redirect()->route('tokos.index')
                        ->with('success','toko created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function show(toko $toko)
    {
        return view('tokos.show',compact('toko'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toko = DB::table('tokos')->where('id_toko', $id)->first();
        return view('tokos.edit',compact('toko'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, toko $toko)
    {
         request()->validate([
            'nama_toko' => 'required',
            'id_toko' => 'required',
        ]);
        //$toko->update($request->all());
        DB::update('UPDATE tokos SET id_toko = :id_toko, nama_toko = :nama_toko WHERE id_toko = :id',
         [
             'id' => '$id',
             'id_toko' => $request->id_toko,
             'nama_toko' => $request->nama_toko,
           
         ]
         );
    
        return redirect()->route('tokos.index')
                        ->with('success','toko updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::update('UPDATE tokos SET deleted_at = NOW() WHERE id_toko = :id_toko', ['id_toko' => $id]);
        //$toko->delete();
    
        return redirect()->route('tokos.index')
                        ->with('success','toko deleted successfully');
    }
    public function deletelist()
    {
        //$tokos = toko::onlyTrashed()->paginate(5);
        $tokos = DB::table('tokos')
        ->whereNotNull('deleted_at')
        ->paginate(5);
        return view('/tokos/trash',compact('tokos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    public function restore($id)
    {
        //$toko = toko::withTrashed()->where('id_toko',$id)->restore();
        DB::update('UPDATE tokos SET deleted_at = NULL WHERE id_toko = :id_toko', ['id_toko' => $id]);
        return redirect()->route('tokos.index')
                        ->with('success','toko Restored successfully');
    }
    public function deleteforce($id)
    {
        //$toko = toko::withTrashed()->where('id_toko',$id)->forceDelete();
        DB::delete('DELETE FROM tokos WHERE id_toko=:id_toko', ['id_toko' => $id]);
        return redirect()->route('tokos.index')
                        ->with('success','toko Deleted Permanently');
    }


}

