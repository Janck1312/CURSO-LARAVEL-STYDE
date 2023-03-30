<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $post = Post::all();
        return view('posts.index')->with('post',$post);
    }

    public function createview() {
        return view('posts.create');
    }

    public function updateview($id){
        try{
            $updatingPost = $this->getRecord($id);

        }catch(\Exception $e){
            $updatingPost = [
                'success' => false,
                'message'  => $e->getMessage()
            ];
        }
        return view('posts.update')->with('updatingPost',$updatingPost);
    }

    public function getRecord($id) {
        try{
            $post = new Post();
            return $post->getRecord($id);

        }catch(\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
        return $response;
    }

    public function storeOrUpdate(Request $request) {

        //validating fields sended by formularie
        $id = $request->id;
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $messages['title.required'] = 'El título del post es requerido';
        $messages['content.required'] = 'El contenido del post es requerido';
        $messages['content.string'] = 'El contenido del post debe ser solo texto';

        $rules['content'] = 'required|string';
        $rules['title'] = 'required';

        $validator = Validator::make($input,$rules, $messages);
       

        if( $validator->fails() ) {
            
            $errors = $validator->errors();
            $url = $id ? 'posts/update/' : 'posts/create';
            
            return redirect($url.$id)->withErrors($errors);
            
        }else {
            try {
                $post = new Post();
                $post->saveOrUpdate($id, $input);

                $response = [
                    'success' => true,
                    'message' => !$id ? 'Post creado con exito' : 'Post actualizado con exito'
                ];

            }catch(\Exception $e) {
                $response = [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
        }
        return $id ? redirect('posts/update/'.$id)->with('response',$response) : redirect('posts/create')->with('response',$response); 
    }

    public function delete(Request $request) {
        try {
            $id = $request->id;
            $post = new Post();
            $post->deleteRecord($id);
            $response = ['success' => true, 'message' => 'post eliminado con exito'];
        }catch(\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return redirect('posts')->with('response', $response);
    }
}
