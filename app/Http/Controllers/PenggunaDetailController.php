<?php

namespace App\Http\Controllers;

use App\PenggunaDetail;
use App\User;
use Error;
use Illuminate\Http\Request;

class PenggunaDetailController extends Controller
{
    //
    public function index(Request $request, User $User)
    {
        if ($request->ajax()) {
            $Users = $User::with('pengguna_detail.angkatan')->where('role', 'user')->get();
            return datatables()->of($Users)
                ->addColumn('action', function ($data) {
                    $button = '<a href="/admin/anggota/' . $data->id . '" class="btn btn-secondary btn-sm"><i class="far fa-eye"></i> Detail</a> <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('anggota.index');
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

        $post = User::updateOrCreate(['id' => $id], [
            'nama'  =>  $request->nama,
        ]);

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User, $id)
    {
        $data['user'] = $User->with(['pengguna_detail.jurusan', 'pengguna_detail.posisi', 'pengguna_detail.angkatan'])->find($id);
        return view('anggota/detail', $data);
    }

    public function updateJabatan(User $User, Request $request)
    {
        $user = $User->with('pengguna_detail')->where('id', $request->id)->first();
        $user->pengguna_detail->role = $request->role;
        $user->pengguna_detail->save();

        return redirect('/admin/anggota/' . $request->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        return response()->json($User);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User, $id)
    {
        $UserDelete = $User->where('id', $id)->delete();

        return response()->json($UserDelete);
        //
    }
}
