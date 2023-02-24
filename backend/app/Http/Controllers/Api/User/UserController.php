<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePassword;
use App\Http\Requests\User\UpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAll(){

        $dados = User::all();

        $users = $dados->map(function($user, $key){
            $user->created_at = date('d/m/Y', strtotime($user->created_at));
            $user->updated_at = date('d/m/Y', strtotime($user->updated_at));

            return $user;
        });
        
        if(! $users->count() ){

            return response()->json([], 404);
        }
        
        return response()->json($users);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        
        if(!$user) {
          return response()->json([], 404);
        }

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        $user = User::find($id);

        $dados = $request->validated();

        $update = $user->update($dados);

        if(!$update) {
            return response(['success' => false, 'message' => 'Erro ao atualizar.'], 500);
        }

        return response(['success' => true, 'message' => 'Atualizado com sucesso!', 'data' => $update]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changePassword(ChangePassword $request, $targetUser)
    {
        $user = User::find($targetUser);

        $dados = $request->validated();

        $update = $user->update([
            'password' => Hash::make($dados["password"])
        ]);

        if(!$update) {
            return response(['success' => false, 'message' => 'Erro ao atualizar.'], 500);
        }

        return response(['success' => true, 'message' => 'Atualizado com sucesso!', 'data' => $update]);
    }

    private function checkChangeOthers($user, $targetUser){

        if($user->id != $targetUser){

            if( $user->tokenCan('users:manage') || $user->tokenCan('users:update')){
                return true;
            }
        }

        return false;

        // if (!$this->checkChangeOthers($request->user(), $targetUser)) {
        //     return response()->json([
        //         'success' => false, 
        //         'message' => 'Você não pode alterar dados de outro usuário.'
        //     ], 403);
        // };
    }
}
