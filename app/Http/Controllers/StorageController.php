<?php
    
namespace App\Http\Controllers;
    
use App\Models\storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
    
class storageController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:storage-list|storage-create|storage-edit|storage-delete', ['only' => ['index','show']]);
         $this->middleware('permission:storage-create', ['only' => ['create','store']]);
         $this->middleware('permission:storage-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:storage-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $storages = DB::table('storages')
                    ->where('nama_storage','LIKE','%'.$keyword.'%')
                    ->whereNull('deleted_at')
                    ->paginate(5);
        //$storages = storage::where('nama_storage','LIKE','%'.$keyword.'%')->paginate(5);
        return view('storages.index',compact('storages'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storages.create');
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
            'id_storage' => 'required',
            'nama_storage' => 'required',
            'detail' => 'required',
        ]);
    
        DB::insert('INSERT INTO storages(id_storage, nama_storage, detail) VALUES (:id_storage, :nama_storage, :detail)',
        [
            'id_storage' => $request->id_storage,
            'nama_storage' => $request->nama_storage,
            'detail' => $request->detail,
            
        ]
        );
    
        return redirect()->route('storages.index')
                        ->with('success','storage created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function show(storage $storage)
    {
        return view('storages.show',compact('storage'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $storage = DB::table('storages')->where('id_storage', $id)->first();
        return view('storages.edit',compact('storage'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         request()->validate([
            'nama_storage' => 'required',
            'id_storage' => 'required',
            'detail' => 'required',
        ]);
    
        //$storage->update($request->all());
        DB::update('UPDATE storages SET nama_storage = :nama_storage, id_storage = :id_storage,detail = :detail WHERE id_storage = :id',
        [
            'id' => $id,
            'nama_storage' => $request->nama_storage,
            'id_storage' => $request->id_storage,
            'detail' => $request->detail,
        ]
        );

    
        return redirect()->route('storages.index')
                        ->with('success','storage updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::update('UPDATE storages SET deleted_at = NOW() WHERE id_storage = :id_storage', ['id_storage' => $id]);

        //$storage->delete();
    
        return redirect()->route('storages.index')
                        ->with('success','storage deleted successfully');
    }
    public function deletelist()
    {
        $storages = DB::table('storages')
        ->whereNotNull('deleted_at')
        ->paginate(5);
        //$storages = storage::onlyTrashed()->paginate(5);
        return view('/storages/trash',compact('storages'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    public function restore($id)
    {
        DB::update('UPDATE storages SET deleted_at = NULL WHERE id_storage = :id_storage', ['id_storage' => $id]);
        //$storage = storage::withTrashed()->where('id_storage',$id)->restore();
        return redirect()->route('storages.index')
                        ->with('success','storage Restored successfully');
    }
    public function deleteforce($id)
    {
        DB::delete('DELETE FROM storages WHERE id_storage = :id_storage', ['id_storage' => $id]);
        return redirect()->route('storages.index')
                        ->with('success','storage Deleted Permanently');
    }
}


