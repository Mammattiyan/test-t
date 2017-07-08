<?php 
namespace App\Http\Controllers;

use App\Motto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Repositories\DataRepository;

class MottoController extends Controller {
	
	private $repository;

    public function __construct(DataRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(DataRepository $repository)
    {
        //return View::make('welcome')->with('data', $this-repository->getData());
		$data =  $repository->getData();
		//$data = Motto::orderBy('id', 'desc')->get();
		return view('users.editprofile', ['data'=>$data]);
    }
	
	public function view(DataRepository $repository)
    {
        //return View::make('welcome')->with('data', $this-repository->getData());
		$data =  $repository->getData();
		//$data = Motto::orderBy('id', 'desc')->get();
		return view('users.profile', ['data'=>$data]);
    }
	public function getDashboard()
    {
        $posts = Motto::orderBy('id', 'desc')->get();
        return view('welcome', compact('users', 'user'));
    }

}
