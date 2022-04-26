<?php

namespace App\Http\Controllers;

use App\Angkatan;
use App\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    //
    public function index(Request $request, Pendaftaran $Pendaftaran)
    {
        if ($request->ajax()) {
            $Pendaftarans = $Pendaftaran::with('angkatan')->get();
            return datatables()->of($Pendaftarans)
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
        return view('pendaftaran.index', $data);
    }

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

        $post = Pendaftaran::updateOrCreate(['id'=>$id],[
            'judul'  =>  $request->judul,
            'deskripsi'  =>  $request->deskripsi,
            'tanggal_buka'  =>  $request->tanggal_buka,
            'tanggal_tutup'  =>  $request->tanggal_tutup,
            'link_wa'  =>  $request->link_wa,
            'angkatan_id'  =>  $request->angkatan_id,
        ]);

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pendaftaran  $Pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pendaftaran $Pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pendaftaran  $Pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendaftaran $Pendaftaran)
    {
        return response()->json($Pendaftaran);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pendaftaran  $Pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendaftaran $Pendaftaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pendaftaran  $Pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendaftaran $Pendaftaran)
    {
        $PendaftaranDelete = $Pendaftaran->delete();

        return response()->json($PendaftaranDelete);
        //
    }
}
