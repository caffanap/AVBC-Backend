<?php

namespace App\Http\Controllers;

use App\Angkatan;
use App\Info;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request, Info $Info)
    {
        if ($request->ajax()) {
            $Infos = $Info::with('angkatan')->where('type', 'kegiatan')->get();
            return datatables()->of($Infos)
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $data['angkatan'] = Angkatan::all();
        return view('kegiatan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;

        $post = Info::updateOrCreate(['id'=>$id], [
            'judul'  =>  $request->judul,
            'deskripsi'  =>  $request->deskripsi,
            'angkatan_id'  =>  $request->angkatan_id != 'Semua Angkatan' ? $request->angkatan_id : null,
            'type' => 'kegiatan',
            'ketentuan' => $request->ketentuan,
            'jadwal' => $request->jadwal,
            'lokasi' => $request->lokasi,
            'maps' => $request->maps
        ]);

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Info  $Info
     * @return \Illuminate\Http\Response
     */
    public function show(Info $Info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Info  $Info
     * @return \Illuminate\Http\Response
     */
    public function edit(Info $Info, $id)
    {
        return response()->json($Info->find($id));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Info  $Info
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Info $Info)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Info  $Info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Info $Info, $id)
    {
        $InfoDelete = $Info->find($id)->delete();

        return response()->json($InfoDelete);
        //
    }
    //
}
