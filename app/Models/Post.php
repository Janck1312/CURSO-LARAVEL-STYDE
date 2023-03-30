<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    public function getRecords( $search ) {
        return $this->all();
    }

    public function getRecord($id) {
        return $this->where('id',$id)->first();
    }

    public function saveOrUpdate($id = '', $body) {
        $post = $this->firstOrNew(['id' => $id]);
        $post->fill($body);
        return $post->save();
    }

    public function deleteRecord($id) {
        return $this->findOrFail($id)->delete();
    }
}
