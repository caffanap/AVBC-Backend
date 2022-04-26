<?php

namespace App\Http\Controllers;

use App\Angkatan;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    //
    public function index(Request $request, Angkatan $Angkatan)
    {
        if ($request->ajax()) {
            $Angkatans = $Angkatan::get();
            return datatables()->of($Angkatans)
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

        return view('angkatan.index');
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

        $post = Angkatan::updateOrCreate(['id'=>$id],[
            'nama'  =>  $request->nama,
        ]);

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Angkatan  $Angkatan
     * @return \Illuminate\Http\Response
     */
    public function show(Angkatan $Angkatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Angkatan  $Angkatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Angkatan $Angkatan)
    {
        return response()->json($Angkatan);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Angkatan  $Angkatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Angkatan $Angkatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Angkatan  $Angkatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Angkatan $Angkatan)
    {
        $AngkatanDelete = $Angkatan->delete();

        return response()->json($AngkatanDelete);
        //
    }
}
