<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\User;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('home');
    }

    public function create_post()
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);

        $post = Post::get();

            if ($user->can('viewAny',Post::class)) {
              echo "Policies Running:";
            } else {
              echo 'Policies Not Running.';
            }
    }
    public function logout(Request $request)
    {
            //logout user
        $request->session()->flush();

        return redirect('/');
    }
    public function post(Request $request){

        return view('post');

    }

    public function gates(Request $request){
        if(Gate::allows('isAdmin',Post::class)){
            $data = new Post();
            $data->user_id = auth()->user()->id;
            $data->comments = $request->comment;
            $data->save();
            $post = Post::where('user_id',auth()->user()->id)->get();
            return view('post-list',['post'=>$post]);
              }else {
                dd('You are not Created Post');
            }
        if (Gate::allows('isAdmin')) {
            dd('Admin allowed');
        } else {
            dd('You are not Admin');
        }

        if (Gate::denies('isManager')) {
            dd('You are not Manager');
        } else {
            dd('Manager allowed');
        }

        $this->authorize('isAdmin');

        $this->authorize('isUser');

        }
}
