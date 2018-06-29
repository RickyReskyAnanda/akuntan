<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        for ($i=0; $i < count($data); $i++) { 
            if($data[$i]->sts == '0')
                $data[$i]->status = 'Belum mengubah password';
            elseif($data[$i]->sts == '1')
                $data[$i]->status = 'Aktif';
            else
                $data[$i]->status = 'Blokir';

            unset($data[$i]->sts);
        }
        return $data;
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
        $this->validate($request,$this->getValidation());
        $additionalData = [
            'sts' => '0',
            'password' => bcrypt($request->username),
        ];

        DB::beginTransaction();
        try {
            $data = User::create($request->all() + $additionalData);
            if($data->sts == '0')
                $data->status = 'Belum mengubah password';
            elseif($data->sts == '1')
                $data->status = 'Aktif';
            else
                $data->status = 'Blokir';

            unset($data->sts);

            DB::commit();
            return response($data, 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response('error', 500);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {   
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $attributes = $this->validate($request,$this->getValidation());
        $user = User::find($request->id);
        
        DB::beginTransaction();
        try {
            $user->update($request->all());
            DB::commit();
            return response('success', 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response('error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            return response('success', 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response('error', 500);
        }
    }

    public function getValidation(){
        return [
            'name' => 'required',
            'username' => 'required|min:6|max:32',
            'level' => 'required'
        ];
    }
}
