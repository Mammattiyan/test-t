<?php 
namespace App\Http\Controllers;

use App\Pets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PetController extends Controller {
	
	public function getDashboard()
    {
        $posts = Pets::orderBy('id', 'desc')->get();
        return view('welcome', ['pets' => $posts]);
    }

}
