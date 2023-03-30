<?php

namespace App\Http\Controllers;

use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $users = new User();
        return view('users.index', ['users'=> $users->getRecords("")]);
    }

    public function createview(){
        return view('users.create');
    }

    public function updateview($id) {
        $user = $this->getRecord($id);
        if(is_object($user)) return view('users.update',['user' => $user]);
        throw new Error('Something went wrong: try again later');
    }

    public function getRecord($id) {
        try {
            $user = new User();
            return $user->getRecord($id);
        }catch(\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function saveOrUpdate(Request $request) {
        $id = $request->id;
        $input = $request->all();

        $messages['name.required'] = 'El nombre del usuario es requerido';
        $messages['email.required'] = 'El email del usuario es requerido';
        $messages['email.required'] = 'El email no es un email válido';
        $messages['password.confirm'] = 'Las contraseñas no coinciden';
        $messages['password_confirm.required'] = 'La confirmacion de contraseña es requerido';

        $rules['name'] = 'required|string';
        $rules['email'] = $id ? 'required|email|unique:users,email,'.$id : 'required|email|unique:users';
        $rules['password'] = 'required|confirmed';

        $validator = Validator::make($input, $rules, $messages);


        if ($validator->fails()) {

            $errors = $validator->errors();
            $url = $id ? 'users/update/' : 'users/create';

            return redirect($url.$id)->withErrors($errors);
        } else {
            try {
                $post = new User();
                $post->saveOrUpdate($id, $input);

                $response = [
                    'success' => true,
                    'message' => !$id ? 'Post creado con exito' : 'Post actualizado con exito'
                ];
            } catch (\Exception $e) {
                $response = [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
        }
        return $id ? redirect('users/update/' . $id)->with('response', $response) : redirect('users/create')->with('response', $response); 
    }

    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            $post = new User();
            $post->deleteRecord($id);
            $response = ['success' => true, 'message' => 'usuario eliminado con exito'];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return redirect('users')->with('response', $response);
    }
}
