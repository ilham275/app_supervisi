<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Dokumen;
use Validator;
use Hash;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome');
    }

    public function kuriindex()
    {
        $jd = Jadwal::all();
        $data = User::all();
        $dk = Dokumen::where('nip', '=', Auth::user()->nip)->get();
        if(auth()->user()->is_admin == 1){
        return view('kurikulum.index', compact('data', 'jd', 'dk'));
         }
    return redirect()->back();
    }

    public function kuriindexc()
    {
        if(auth()->user()->is_admin == 1){
            return view('kurikulum.createm');
             }

             return redirect()->back();
    }
    


    public function kurisuperindex()
    {
    $jd = Jadwal::all();
    $data = User::all();
    $dk = Dokumen::where('nip', '=', Auth::user()->nip)->get();
    $sa = Jadwal::where('nip_super', '=', Auth::user()->nip)->pluck('nip_user');
    $dki = Dokumen::whereIn('nip',  $sa)->get();
        if(auth()->user()->is_admin == 1){
            return view('kurikulum.indexsuper', compact('data', 'jd', 'dk', 'dki'));
        }
        return redirect()->back();
        
    }
    
    public function kepsek()
    {
        $jd = Jadwal::where('nip_user', '=', Auth::user()->nip)->get();
        $dk = Dokumen::where('nip', '=', Auth::user()->nip)->get();
        $dka = Dokumen::all();
        if(auth()->user()->is_admin == 2){
            return view('kepsek.index', compact('jd', 'dk', 'dka'));
        }
        return redirect()->back();
    }

    public function ckepsek()
    {
        if(auth()->user()->is_admin == 2){
            return view('kepsek.create');

        }
        return redirect()->back();
    }
    
    public function kepseksuper()
    {
        $sa = Jadwal::where('nip_super', '=', Auth::user()->nip)->pluck('nip_user');
        $data = Dokumen::whereIn('nip',  $sa)->get();
        $dk = Dokumen::where('nip', '=', Auth::user()->nip)->get();
        $jadwal = Jadwal::where('nip_super', '=', Auth::user()->nip)->get();
        // dd($data);
        if(auth()->user()->is_admin == 2){
        return view('kepseksuper.index', compact('jadwal', 'data', 'dk'));
        }
        return redirect()->back();
    }

    public function kepseksuperc()
    {
        if(auth()->user()->is_admin == 2){
        return view('kepseksuper.create');
        }
        return redirect()->back();
    }

    public function skepseksuper(Request $request)
    {
        $validasi = $request->validate([
            'mapel' => 'required|string',
            'rpp' => 'required|mimes:pdf|max:5120',
            'embed' => 'required'
        ]);

        $rpp = time(). '-' .$request->rpp->getClientOriginalName();
        $request->rpp->move(public_path('files'), $rpp);

        Dokumen::create([
            'nip' => $request->nip,
            'mapel' => $request->mapel,
            'rpp' => $rpp,
            'embed' => $request->embed,
        ]);

        return redirect()->route('kepseksuper.index');
    }

    public function guru()
    {
        $jd = Jadwal::where('nip_user', '=', Auth::user()->nip)->get();
        $dk = Dokumen::where('nip', '=', Auth::user()->nip)->get();
        if(auth()->user()->is_admin == 3){
        return view('guru.index', compact('dk', 'jd'));
        }
        return redirect()->back();
    }

    public function gurusuper()
    {

        $sa = Jadwal::where('nip_super', '=', Auth::user()->nip)->pluck('nip_user');
        $jadwal = Jadwal::where('nip_super', '=', Auth::user()->nip)->get();
        $data = Dokumen::whereIn('nip',  $sa)->get();
        $dk = Dokumen::where('nip', '=', Auth::user()->nip)->get();
        if(auth()->user()->is_admin == 3){
        return view('gurusuper.index', compact('jadwal', 'data', 'dk'));
        }
        return redirect()->back();

    }
    
    public function tocreate()
    {
        if(auth()->user()->is_admin == 1){
            return view('kurikulum.create');
        }
        return redirect()->back();
    }

    public function create(Request $request)
    {
        $request->validate([
            'nip'=> 'required',
            'nama'=> 'required',
            'alamat'=> 'required',
            'email'=> 'required',
            'is_admin'=> 'required',
            'supervisor'=> 'required',
        ]);

        User::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'is_admin' => $request->is_admin,
            'supervisor' => $request->supervisor,
            'password' => Hash::make($request->nip),
        ]);
        return redirect()->route('kurikulum.index');
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('kurikulum.edit', compact('data'));
    }

    public function update(Request $request,$id)
    {
        User::where('id',$id)->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'is_admin' => $request->is_admin,
            'supervisor' => $request->supervisor,
            'password' => $request->password,
        ]);
        return redirect()->route('kurikulum.index');

    }

    
    
    public function ya($id)
    {
            User::where($id)->update([
                'supervisor' => '0'
            ]);
    }
    
    public function tosupervisor($id)
    {
        User::find($id)->update([
            'supervisor' => 1
        ]);

        return redirect()->back();
    }

    public function deletesupervisor($id)
    {
        User::find($id)->update([
            'supervisor' => 0
        ]);

        return redirect()->back();
    }
    
    public function tojadwal()
    {
        $super = User::where('supervisor', '=', '1')->get();
        $not = User::where('supervisor', '=', '0')->get();
        if(auth()->user()->is_admin == 1){
            return view('kurikulum.jadwal', compact('super', 'not'));
        }
        return redirect()->back();
    }

    public function jadwal(Request $request)
    {

        $request->validate([
            'nip_user'=> 'required',
            'nip_super'=> 'required',
            'tanggal'=> 'required',
            'time1'=> 'required',
            'time2'=> 'required',
        ]);
        
        Jadwal::create([
            'nip_user' => $request->nip_user,
            'nip_super' => $request->nip_super,
            'tanggal' => $request->tanggal,
            'time1' => $request->time1,
            'time2' => $request->time2,
        ]);
        return redirect()->route('kurikulum.index');
    }


    public function todokumen()
    {
        if(auth()->user()->is_admin == 1){
            return view('guru.create');
        }
        if(auth()->user()->is_admin == 3)
        {
            return view('guru.create');
        }
        return redirect()->back();
        
    }

    public function dokumen(Request $request)
    {
        $validasi = $request->validate([
            'mapel' => 'required|string',
            'rpp' => 'required|mimes:pdf|max:5120',
            'embed' => 'required'
        ]);

        $rpp = time(). '-' .$request->rpp->getClientOriginalName();
        $request->rpp->move(public_path('files'), $rpp);

        Dokumen::create([
            'nip' => $request->nip,
            'mapel' => $request->mapel,
            'rpp' => $rpp,
            'embed' => $request->embed,
        ]);

        return redirect()->route('guru.index');
    }

}
