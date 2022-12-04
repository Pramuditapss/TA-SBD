<?php
    
namespace App\Http\Controllers;
    
use App\Models\Console;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
    
class ConsoleController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:console-list|console-create|console-edit|console-delete', ['only' => ['index','show']]);
         $this->middleware('permission:console-create', ['only' => ['create','store']]);
         $this->middleware('permission:console-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:console-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $consoles = DB::table('consoles')
                    ->where('nama_console','LIKE','%'.$keyword.'%')
                    ->whereNull('deleted_at')
                    ->paginate(5);
        //$consoles = Console::where('nama_console','LIKE','%'.$keyword.'%')->paginate(5);
        return view('consoles.index',compact('consoles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consoles.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_console' => 'required',
            'nama_console' => 'required',
            'id_toko' => 'required',
            'id_storage' => 'required',
        ]);
    
        DB::insert('INSERT INTO consoles(id_console, nama_console, id_toko, id_storage) VALUES (:id_console, :nama_console, :id_toko, :id_storage)',
        [
            'id_console' => $request->id_console,
            'nama_console' => $request->nama_console,
            'id_toko' => $request->id_toko,
            'id_storage' => $request->id_storage,
        ]
        );
    
        return redirect()->route('consoles.index')
                        ->with('success','console created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\console  $console
     * @return \Illuminate\Http\Response
     */
    public function show(console $console)
    {
        return view('consoles.show',compact('console'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\console  $console
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $console = DB::table('consoles')->where('id_console', $id)->first();
        return view('consoles.edit',compact('console'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\console  $console
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
         $request->validate([
            'id_console' => 'required',
            'nama_console' => 'required',
            'id_toko' => 'required',
            'id_storage' => 'required'
        ]);
       //$console->update($request->all());
         DB::update('UPDATE consoles SET id_console = :id_console, nama_console = :nama_console,id_toko = :id_toko, id_storage = :id_storage WHERE id_console = :id',
        [
            'id' => $id,
            'id_console' => $request->id_console,
            'nama_console' => $request->nama_console,
            'id_toko' => $request->id_toko,
            'id_storage' => $request->id_storage,
           
        ]
        );

        
        return redirect()->route('consoles.index')
                        ->with('success','Console updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\console  $console
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::update('UPDATE consoles SET deleted_at = NOW() WHERE id_console = :id_console', ['id_console' => $id]);

        //$console->delete();
    
        return redirect()->route('consoles.index')
                        ->with('success','console deleted successfully');
    }
    public function deletelist()
    {
        $consoles = DB::table('consoles')
        ->whereNotNull('deleted_at')
        ->paginate(5);
        return view('/consoles/trash',compact('consoles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    public function restore($id)
    {
        DB::update('UPDATE consoles SET deleted_at = NULL WHERE id_console = :id_console', ['id_console' => $id]);
        return redirect()->route('consoles.index')
                        ->with('success','console Restored successfully');
    }
    public function deleteforce( $id)
    {
        DB::delete('DELETE FROM consoles WHERE id_console=:id_console', ['id_console' => $id]);
        return redirect()->route('consoles.index')
                        ->with('success','console Deleted Permanently');
    }   
}