<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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
        return view('user.user');
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
        // return $request->all();
        $attributes = $this->validate($request,$this->getValidation());
        $additionalData = [
            'sts' => '0',
            'password' => bcrypt($request->username),
        ];
        DB::beginTransaction();
        try {
            $data = User::create($attributes + $additionalData);
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
    public function update(Request $request, User $user)
    {
        $attributes = $request->validate($this->getValidation());

        DB::beginTransaction();
        try {
                $user->update($attributes);
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
            'nama' => 'string|required',
            'username' => 'required|min:6|max:32',
            'level' => 'required',
        ];
    }
}
