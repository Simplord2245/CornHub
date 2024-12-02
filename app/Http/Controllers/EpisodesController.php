<?php

namespace App\Http\Controllers;

use App\Models\Episodes;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index($id, $name){
        $submovie_name = $name;
        $episodes = Episodes::where('submovie_id', $id)->paginate(13);
        return view('episodes', compact('episodes', 'submovie_name'));
    }
    public function delete($id){
        $post = Episodes::with('Submovie')->where('episode_id', $id)->first();
        $post->delete();
        return redirect()->route('episodes.index', ['id' => $post->Submovie->submovie_id, 'name' => $post->Submovie->submovie_title]);
    }
}
