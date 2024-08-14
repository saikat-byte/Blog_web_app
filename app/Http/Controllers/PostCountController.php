<?php

namespace App\Http\Controllers;

use App\Models\PostCount;
use Illuminate\Http\Request;

class PostCountController extends Controller
{
    private int $post_id;

    public function __construct( int $post_id)
    {
        $this->post_id = $post_id;
    }

    final public function postReadCount(){

        $post_count = PostCount::where('post_id', $this->post_id)->first();

        if ( $post_count) { //Update
            $post_count->count += 1;
            $post_count->save();
        }else{ //create
            $this->storePostCount();
        }

    }
    /**
     * @return void
     */
    private function storePostCount():void
    {
       $read_post_count = [
            'post_id' => $this->post_id,
            'count' => 1
        ];
        PostCount::create($read_post_count);

    }
}
