<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $role = new Role();
        return view('role.index',['role'=>$role->getRecords()]);
    }

    public function createview() {
        return view('role.create');
    }

    public function updateview($id) {
        $role = new Role();
        return view('role.update', ['role' => $role->findById($id)]);
    }

    public function saveOrUpdate(Request $request) {
        
        $id = $request->id;
        $input = $request->all();
        $messages['name.required'] = 'El nombre es requerido';
        $rules['name'] = 'required|string';
        $validate = Validator::make($input, $rules, $messages);

        if($validate->fails()) {
            $errors = $validate->errors();
            $url = $id ? 'roles/update/' : 'roles/create';

            return redirect($url . $id)->withErrors($errors);
        }else {
            try {
                $post = new Role();
                $role = !$id ? $post->findOrCreate($input['name']) : $post->findById($id);
                if(is_object($role)) $post->fill($input); $post->save();

                $response = [
                    'success' => true,
                    'message' => !$id ? 'Role creado con exito' : 'Role actualizado con exito'
                ];
            } catch (\Exception $e) {
                $response = [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
        }
        return $id ? redirect('roles/update/' . $id)->with('response', $response) : redirect('roles/create')->with('response', $response); 
    }

    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            $post = new Role();
            $post->deleteRecord($id);
            $response = ['success' => true, 'message' => 'post eliminado con exito'];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return redirect('roles')->with('response', $response);
    }
}
