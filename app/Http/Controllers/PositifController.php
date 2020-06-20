<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Positif;
use App\DetPositif;
use App\Kabupaten;
use App\Kecamatan;
use App\Kelurahan;
use Carbon\Carbon;

use DB;
use Response;

class PositifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    
    public function index(Request $request)
    {

        $levelsebaran = $request->get('levelsebaran');
        $caritgl = $request->get('caritgl');
        
        $kabupaten = Kabupaten::all();
        // pluck('nama_kabupaten', 'id_kabupaten');
        

        $carikabupaten = $request->get('carikabupaten');

       
        $carikecamatan = $request->get('carikecamatan');

        // $kelurahan = Kelurahan::where('id_kecamatan', $request->carikecamatan)->get();

        // return $kecamatan;

        // $categories = \App\Models\Category::with('articles')->get();
        


        //masing2 kabupaten
        if(isset($caritgl) && ($levelsebaran =='kabupaten') && empty($carikabupaten) && empty($carikecamatan)) {

            $tglnow = Carbon::parse($request->caritgl)->isoFormat('LL');

            $totaldirawat = Positif::select(DB::raw('COALESCE(SUM(tb_positif.dirawat),0) as dirawat'))
            ->join('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->join('tb_kecamatan', 'tb_kelurahan.id_kecamatan', '=', 'tb_kecamatan.id_kecamatan')
            ->join('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tgl',$request->caritgl)
            ->get();

            $totalsembuh = Positif::select(DB::raw('COALESCE(SUM(tb_positif.sembuh),0) as sembuh'))
            ->join('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->join('tb_kecamatan', 'tb_kelurahan.id_kecamatan', '=', 'tb_kecamatan.id_kecamatan')
            ->join('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tgl',$request->caritgl)
            ->get();

            $totalmeninggal = Positif::select(DB::raw('COALESCE(SUM(tb_positif.meninggal),0) as meninggal'))
            ->join('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->join('tb_kecamatan', 'tb_kelurahan.id_kecamatan', '=', 'tb_kecamatan.id_kecamatan')
            ->join('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tgl',$request->caritgl)
            ->get();

            $totalpositif = Positif::select(DB::raw('COALESCE(SUM(tb_positif.jml_positif),0) as jml_positif'))
            ->join('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->join('tb_kecamatan', 'tb_kelurahan.id_kecamatan', '=', 'tb_kecamatan.id_kecamatan')
            ->join('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tgl',$request->caritgl)
            ->get();

            $positif=Positif::select('tb_positif.id_positif','tb_kabupaten.nama_kabupaten as nama', 
                DB::raw( 'floor(AVG( tb_positif.level )) as level' ), 
                DB::raw('SUM(tb_positif.ppln) as ppln'), 
                DB::raw('SUM(tb_positif.ppdn) as ppdn'), 
                DB::raw('SUM(tb_positif.tl) as tl'), 
                DB::raw('SUM(tb_positif.lainnya) as lainnya'), 
                DB::raw('SUM(tb_positif.total) as total'), 
                DB::raw('SUM(tb_positif.dirawat) as dirawat'), 
                DB::raw('SUM(tb_positif.sembuh) as sembuh'), 
                DB::raw('SUM(tb_positif.meninggal) as meninggal'), 
                DB::raw('SUM(tb_positif.jml_positif) as jml_positif'))
            ->where('tgl','like',"%".$caritgl."%")
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->rightjoin('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->groupby('tb_kabupaten.id_kabupaten')
            // ->paginate(10);
            ->get();



        //1 kabupaten
        } elseif (isset($caritgl) && ($levelsebaran =='kabupaten') && $carikabupaten && empty($carikecamatan)) {
            $tglnow = Carbon::parse($request->caritgl)->isoFormat('LL');

            $totaldirawat = Positif::select(DB::raw('COALESCE(SUM(tb_positif.dirawat),0) as dirawat'))
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->rightjoin('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tb_positif.tgl',$request->caritgl)
            ->where('tb_kabupaten.id_kabupaten',$request->carikabupaten)
            ->groupby('tb_kabupaten.id_kabupaten')
            ->get();


            $totalsembuh = Positif::select(DB::raw('COALESCE(SUM(tb_positif.sembuh),0) as sembuh'))
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->rightjoin('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tb_positif.tgl',$request->caritgl)
            ->where('tb_kabupaten.id_kabupaten',$request->carikabupaten)
            ->groupby('tb_kabupaten.id_kabupaten')
            ->get();


            $totalmeninggal = Positif::select(DB::raw('COALESCE(SUM(tb_positif.meninggal),0) as meninggal'))
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->rightjoin('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tb_positif.tgl',$request->caritgl)
            ->where('tb_kabupaten.id_kabupaten',$request->carikabupaten)
            ->groupby('tb_kabupaten.id_kabupaten')
            ->get();


            $totalpositif = Positif::select(DB::raw('COALESCE(SUM(tb_positif.jml_positif),0) as jml_positif'))
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->rightjoin('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tb_positif.tgl',$request->caritgl)
            ->where('tb_kabupaten.id_kabupaten',$request->carikabupaten)
            ->groupby('tb_kabupaten.id_kabupaten')
            ->get();
           

            $positif=Positif::select('tb_positif.id_positif','tb_kabupaten.nama_kabupaten as nama', 
                DB::raw( 'floor(AVG( tb_positif.level )) as level' ), 
                DB::raw('SUM(tb_positif.ppln) as ppln'), 
                DB::raw('SUM(tb_positif.ppdn) as ppdn'), 
                DB::raw('SUM(tb_positif.tl) as tl'), 
                DB::raw('SUM(tb_positif.lainnya) as lainnya'), 
                DB::raw('SUM(tb_positif.total) as total'), 
                DB::raw('SUM(tb_positif.dirawat) as dirawat'), 
                DB::raw('SUM(tb_positif.sembuh) as sembuh'), 
                DB::raw('SUM(tb_positif.meninggal) as meninggal'), 
                DB::raw('SUM(tb_positif.jml_positif) as jml_positif'))
            ->where('tgl','like',"%".$caritgl."%")
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->rightjoin('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tb_kabupaten.id_kabupaten',$request->carikabupaten)
            ->groupby('tb_kabupaten.id_kabupaten')
            // ->paginate(10);
            ->get();


        //masing2 kec
        } elseif (isset($caritgl) && ($levelsebaran =='kecamatan') && $carikabupaten && empty($carikecamatan)) {
            $tglnow = Carbon::parse($request->caritgl)->isoFormat('LL');


            $totaldirawat = Positif::select(DB::raw('COALESCE(SUM(tb_positif.dirawat),0) as dirawat'))
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->rightjoin('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tb_positif.tgl',$request->caritgl)
            ->where('tb_kabupaten.id_kabupaten', $request->carikabupaten)
            ->get();

            $totalsembuh = Positif::select(DB::raw('COALESCE(SUM(tb_positif.sembuh),0) as sembuh'))
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->rightjoin('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tb_positif.tgl',$request->caritgl)
            ->where('tb_kabupaten.id_kabupaten', $request->carikabupaten)
            ->get();


            $totalmeninggal = Positif::select(DB::raw('COALESCE(SUM(tb_positif.meninggal),0) as meninggal'))
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->rightjoin('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tb_positif.tgl',$request->caritgl)
            ->where('tb_kabupaten.id_kabupaten', $request->carikabupaten)
            ->get();

            $totalpositif = Positif::select(DB::raw('COALESCE(SUM(tb_positif.jml_positif),0) as jml_positif'))
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->rightjoin('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tb_positif.tgl',$request->caritgl)
            ->where('tb_kabupaten.id_kabupaten', $request->carikabupaten)
            ->get();


            $positif=Positif::select('tb_positif.id_positif', 'tb_kecamatan.nama_kecamatan as nama', 
                DB::raw( 'floor(AVG( tb_positif.level )) as level' ), 
                DB::raw('SUM(tb_positif.ppln) as ppln'), 
                DB::raw('SUM(tb_positif.ppdn) as ppdn'), 
                DB::raw('SUM(tb_positif.tl) as tl'), 
                DB::raw('SUM(tb_positif.lainnya) as lainnya'), 
                DB::raw('SUM(tb_positif.total) as total'), 
                DB::raw('SUM(tb_positif.dirawat) as dirawat'), 
                DB::raw('SUM(tb_positif.sembuh) as sembuh'), 
                DB::raw('SUM(tb_positif.meninggal) as meninggal'), 
                DB::raw('SUM(tb_positif.jml_positif) as jml_positif'))
            ->where('tgl','like',"%".$caritgl."%")
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->rightjoin('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tb_kabupaten.id_kabupaten',$request->carikabupaten)
            ->groupby('tb_kecamatan.id_kecamatan')
            ->get();
            // ->paginate(10);


        //masing2 kelu
        } elseif (isset($caritgl) && ($levelsebaran =='kelurahan') && $carikabupaten && $carikecamatan) {
            $tglnow = Carbon::parse($request->caritgl)->isoFormat('LL');


            $totaldirawat = Positif::select(DB::raw('COALESCE(SUM(tb_positif.dirawat),0) as dirawat'))
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->where('tb_positif.tgl',$request->caritgl)
            ->where('tb_kecamatan.id_kecamatan',$request->carikecamatan)
            ->groupby('tb_kecamatan.id_kecamatan')
            ->get();

            $totalsembuh = Positif::select(DB::raw('COALESCE(SUM(tb_positif.sembuh),0) as sembuh'))
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->where('tb_positif.tgl',$request->caritgl)
            ->where('tb_kecamatan.id_kecamatan',$request->carikecamatan)
            ->groupby('tb_kecamatan.id_kecamatan')
            ->get();

            $totalmeninggal = Positif::select(DB::raw('COALESCE(SUM(tb_positif.meninggal),0) as meninggal'))
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->where('tb_positif.tgl',$request->caritgl)
            ->where('tb_kecamatan.id_kecamatan',$request->carikecamatan)
            ->groupby('tb_kecamatan.id_kecamatan')
            ->get();

            $totalpositif = Positif::select(DB::raw('COALESCE(SUM(tb_positif.jml_positif),0) as jml_positif'))
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->where('tb_positif.tgl',$request->caritgl)
            ->where('tb_kecamatan.id_kecamatan',$request->carikecamatan)
            ->groupby('tb_kecamatan.id_kecamatan')
            ->get();


            $positif=Positif::select('tb_positif.id_positif','tb_kelurahan.nama_kelurahan as nama', 'tb_positif.level', 'tb_positif.ppln', 'tb_positif.ppdn', 'tb_positif.tl', 'tb_positif.lainnya', 'tb_positif.total', 'tb_positif.dirawat', 'tb_positif.sembuh', 'tb_positif.meninggal', 'tb_positif.jml_positif')
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->where('tb_positif.tgl','like',"%".$caritgl."%")
            ->where('tb_kecamatan.id_kecamatan',$request->carikecamatan)
            // ->paginate(10);
            ->get();

        } else {

            $tglnow = date('Y-m-d');

            $totaldirawat = Positif::select(DB::raw('COALESCE(SUM(tb_positif.dirawat),0) as dirawat'))
            ->join('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->join('tb_kecamatan', 'tb_kelurahan.id_kecamatan', '=', 'tb_kecamatan.id_kecamatan')
            ->join('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tgl',$tglnow)
            ->get();

            $totalsembuh = Positif::select(DB::raw('COALESCE(SUM(tb_positif.sembuh),0) as sembuh'))
            ->join('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->join('tb_kecamatan', 'tb_kelurahan.id_kecamatan', '=', 'tb_kecamatan.id_kecamatan')
            ->join('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tgl',$tglnow)
            ->get();

            $totalmeninggal = Positif::select(DB::raw('COALESCE(SUM(tb_positif.meninggal),0) as meninggal'))
            ->join('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->join('tb_kecamatan', 'tb_kelurahan.id_kecamatan', '=', 'tb_kecamatan.id_kecamatan')
            ->join('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tgl',$tglnow)
            ->get();

            $totalpositif = Positif::select(DB::raw('COALESCE(SUM(tb_positif.jml_positif),0) as jml_positif'))
            ->join('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->join('tb_kecamatan', 'tb_kelurahan.id_kecamatan', '=', 'tb_kecamatan.id_kecamatan')
            ->join('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->where('tgl',$tglnow)
            ->get();

            $positif = Positif::select('tb_positif.id_positif','tb_kabupaten.nama_kabupaten as nama', 
                DB::raw( 'floor(AVG( tb_positif.level )) as level' ), 
                DB::raw('SUM(tb_positif.ppln) as ppln'), 
                DB::raw('SUM(tb_positif.ppdn) as ppdn'), 
                DB::raw('SUM(tb_positif.tl) as tl'), 
                DB::raw('SUM(tb_positif.lainnya) as lainnya'), 
                DB::raw('SUM(tb_positif.total) as total'), 
                DB::raw('SUM(tb_positif.dirawat) as dirawat'), 
                DB::raw('SUM(tb_positif.sembuh) as sembuh'), 
                DB::raw('SUM(tb_positif.meninggal) as meninggal'), 
                DB::raw('SUM(tb_positif.jml_positif) as jml_positif'))
            ->where('tgl' , date('Y-m-d'))
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->rightjoin('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
            ->groupby('tb_kabupaten.id_kabupaten')
            // ->paginate(10);
            ->get();
        }

        
        // return $positif;
        return view('data', ['positif' => $positif, 'levelsebaran' => $levelsebaran, 'kabupaten'=>$kabupaten, 'tglnow' => $tglnow, 'totaldirawat' => $totaldirawat, 'totalsembuh' => $totalsembuh, 'totalmeninggal' => $totalmeninggal, 'totalpositif' => $totalpositif]);

        // data sesuai nama file blade
        // 'positif' ini adalah nama untuk di bladenya, ex: positif as $p
    }


    public function getKecamatan(Request $request)
    {
        $kecamatan = Kecamatan::where('id_kabupaten', $request->get('id_kabupaten'))
            ->pluck('nama_kecamatan', 'id_kecamatan');
    
        return response()->json($kecamatan);

        
    }

    public function getKelurahan(Request $request)
    {
        $kelurahan = Kelurahan::where('id_kecamatan', $request->get('id_kecamatan'))
            ->pluck('nama_kelurahan', 'id_kelurahan');
         
        return response()->json($kelurahan);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kabupaten = Kabupaten::all();
        return view('tambahdata', ['kabupaten' => $kabupaten]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = Positif::where('id_kelurahan',$request->id_kelurahan)->where('tgl',$request->tgl)->count();
        if($cek == 0){
            $positif = new Positif();
        }else{
            $positif = Positif::where('id_kelurahan',$request->id_kelurahan)->where('tgl',$request->tgl)->first();
            $positif->status = 1;
        }


        $this->validate($request,[
            'tgl' => 'required',
            'level' => 'required',
            'ppln' => 'required',
            'ppdn' => 'required',
            'tl' => 'required',
            'lainnya' => 'required',
            'total' => 'required',
            'dirawat' => 'required',
            'sembuh' => 'required',
            'meninggal' => 'required',
            'jml_positif' => 'required',
            'id_kelurahan' => 'required',
            'id_kecamatan' => 'required',
            'id_kabupaten' => 'required'

    ]);

        if ($cek == 0) {

        Positif::create([
            'tgl' => $request->tgl,
            'level' => $request->ppdn,
            'ppln' => $request->ppln,
            'ppdn' => $request->ppdn,
            'tl' => $request->tl,
            'lainnya' => $request->lainnya,
            'total' => $request->total,
            'dirawat' => $request->dirawat,
            'sembuh' => $request->sembuh,
            'meninggal' => $request->meninggal,
            'jml_positif' => $request->jml_positif,
            'id_kelurahan' => $request->id_kelurahan,
            'id_kecamatan' => $request->id_kecamatan,
            'id_kabupaten' => $request->id_kabupaten
        ]);
    } else {
        return redirect('/')->with('alert', 'Data Sudah Ada, Silakan Lakukan Edit');
    }
        

        return redirect('/')->with('alert', 'Data Berhasil Tersimpan');
        // return $request;
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $positif = Positif::find($id);
        // return $positif;
        return view('editdata', ['positif' => $positif]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            // 'tgl' => 'required',
            'level' => 'required|numeric',
            'ppln' => 'required|numeric',
            'ppdn' => 'required|numeric',
            'tl' => 'required|numeric',
            'lainnya' => 'required|numeric',
            'total' => 'required|numeric',
            'dirawat' => 'required|numeric',
            'sembuh' => 'required|numeric',
            'meninggal' => 'required|numeric',
            'jml_positif' => 'required|numeric'
            
            // 'kabupaten' => 'required'
        ]);

        $positif = Positif::find($id);
        // $positif->tgl = $request->tgl;
        $positif->level = $request->level;
        $positif->ppln = $request->ppln;
        $positif->ppdn = $request->ppdn;
        $positif->tl = $request->tl;
        $positif->lainnya = $request->lainnya;
        $positif->total = $request->total;
        $positif->dirawat = $request->dirawat;
        $positif->sembuh = $request->sembuh;
        $positif->meninggal = $request->meninggal;
        $positif->jml_positif = $request->jml_positif;
        
        // $positif->kabupaten = $request->kabupaten;
        $positif->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $positif = Positif::where('id_positif',$id);
        $positif->delete();
        return redirect('/');
    }


    public function createPallette(Request $request)
    {

        $HexFrom = ltrim($request->start, '#');
        $HexTo = ltrim($request->end, '#');

    
        $ColorSteps = 9;
        $FromRGB['r'] = hexdec(substr($HexFrom, 0, 2));
        $FromRGB['g'] = hexdec(substr($HexFrom, 2, 2));
        $FromRGB['b'] = hexdec(substr($HexFrom, 4, 2));
    
        $ToRGB['r'] = hexdec(substr($HexTo, 0, 2));
        $ToRGB['g'] = hexdec(substr($HexTo, 2, 2));
        $ToRGB['b'] = hexdec(substr($HexTo, 4, 2));
    
        $StepRGB['r'] = ($FromRGB['r'] - $ToRGB['r']) / ($ColorSteps - 1);
        $StepRGB['g'] = ($FromRGB['g'] - $ToRGB['g']) / ($ColorSteps - 1);
        $StepRGB['b'] = ($FromRGB['b'] - $ToRGB['b']) / ($ColorSteps - 1);
    
        $GradientColors = array();
    
        for($i = 0; $i <= $ColorSteps; $i++) {
        $RGB['r'] = floor($FromRGB['r'] - ($StepRGB['r'] * $i));
        $RGB['g'] = floor($FromRGB['g'] - ($StepRGB['g'] * $i));
        $RGB['b'] = floor($FromRGB['b'] - ($StepRGB['b'] * $i));
    
        $HexRGB['r'] = sprintf('%02x', ($RGB['r']));
        $HexRGB['g'] = sprintf('%02x', ($RGB['g']));
        $HexRGB['b'] = sprintf('%02x', ($RGB['b']));
    
        $GradientColors[] = implode(NULL, $HexRGB);
        }
        $collect = collect($GradientColors);
        $filtered = $collect->filter(function($value, $key){
            return strlen($value) == 6;
        });
        return $filtered;
    }

    
    function len($val){
        return (strlen($val) == 6 ? true : false );
    }


    public function getDataMap(Request $request)
    {
        $tglnow = Carbon::now()->format('Y-m-d');
        if (is_null($request->date)) {
            $tanggal = $tglnow;
        }else{
            $tanggal = $request->date;
        }

        $dataMap=Positif::select('tb_positif.id_positif', 'tb_kelurahan.id_kelurahan','tb_kelurahan.nama_kelurahan','tb_kecamatan.id_kecamatan','tb_kecamatan.nama_kecamatan', 'tb_positif.level', 'tb_positif.ppln', 'tb_positif.ppdn', 'tb_positif.tl', 'tb_positif.lainnya', 'tb_positif.total', 'tb_positif.dirawat', 'tb_positif.sembuh', 'tb_positif.meninggal', 'tb_positif.jml_positif', 'tb_positif.tgl')
            ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_kelurahan.id_kelurahan')
            ->rightjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_kelurahan.id_kecamatan')
            ->where('tb_positif.tgl','like',"%".$tanggal."%")
            // ->paginate(10);
            ->get();

//         $dataColor = Positif::select('tb_positif.id_positif', 'tb_kabupaten.id_kabupaten', 'tb_kabupaten.nama_kabupaten', 'tb_kecamatan.id_kecamatan', 'tb_kecamatan.nama_kecamatan', 'tb_kelurahan.id_kelurahan', 'tb_kelurahan.nama_kelurahan', 'tb_positif.sembuh', 'tb_positif.dirawat', 'tb_positif.jml_positif', 'tb_positif.meninggal')
//         ->rightjoin('tb_kelurahan', 'tb_positif.id_kelurahan', '=', 'tb_positif.id_positif')
//         ->rightjoin('tb_kecamatan', 'tb_kelurahan.id_kecamatan', '=', 'tb_kecamatan.id_kecamatan')
//         ->rightjoin('tb_kabupaten', 'tb_kecamatan.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
//         ->where('tgl', $tanggal)
//         ->orderby('jml_positif','DESC')
//         ->get();
        return response()->json(["dataMap"=>$dataMap]);
        // return $positif;
    }

    // public function getPositif(Request $request)
    // {
    //     $tglnow = Carbon::now()->format('Y-m-d');
    //     if (is_null($request->date)) {
    //         $tanggal = $tglnow;
    //     }else{
    //         $tanggal = $request->date;
    //     }

    //     $dataColor = Positif::select('tb_positif.id_positif', 'tb_kabupaten.id_kabupaten', 'tb_kabupaten.nama_kabupaten', 'tb_positif.sembuh', 'tb_positif.dirawat', 'tb_positif.jml_positif', 'tb_positif.meninggal')
    //     ->rightjoin('tb_kabupaten', 'tb_positif.id_kabupaten', '=', 'tb_kabupaten.id_kabupaten')
    //     ->where('tgl', $tanggal)
    //     ->orderby('jml_positif','DESC')
    //     ->get();
    //     return response()->json(["dataColor"=>$dataColor]);
    //     // return $pos;

    // }

}
