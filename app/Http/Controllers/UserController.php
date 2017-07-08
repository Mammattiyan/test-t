<?php 
namespace App\Http\Controllers;

use Intervention\Image\Facades\Image as Image;
use App;
use App\User;
use App\Userprofile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;



class UserController extends Controller {
	
	public function store(Request $request)
	{
	
	
		/*$this->validate($request, [
            'profileimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
*/
        $image = $request->file('profileimage');
        $input['imagename'] = 'profile.jpg';
     
   
        $destinationPath = public_path('/users/'.Auth::user()->id);
        $img = Image::make($image->getRealPath());
        $img->fit(400, 400, function ($constraint) {
		    $constraint->aspectRatio();
		})->save($destinationPath.'/'.$input['imagename']);
		
		
		$user=new User;
		$user->where('email', '=', Auth::user()->email)->update(['profileimage' => 'users/profile.jpg']);
		return redirect()->route('profile');
       /* $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);

        $this->postImage->add($input);

        return back()
        	->with('success','Image Upload successful')
        	->with('imageName',$input['imagename']);
	
	
		//$name=str_random(30) . '-' . $request->file('profileimage')->getClientOriginalName();
		$request->file('profileimage')->move('users/'.Auth::user()->id,'profile.jpg');
		
		App::make('ProcessImage')->execute($request->file('profileimage'), 'users/'.Auth::user()->id, 180, 180);
		$user=new User;
		$user->where('email', '=', Auth::user()->email)->update(['profileimage' => 'users/profile.jpg']);
		return redirect()->route('profile');
	   //return view('users.edit-profile');
		//$newUserProfileImagePath = $profileImagePath = App::make('ProcessImage')->execute($request->file('profileimage'), 'images/profileimages/', 180, 180);

		/*$newUserBirthday = Carbon::createFromDate($request->year, $request->month, $request->day);

		$newUser = $this->dispatchFrom(RegisterUserCommand::class, $request, [
			'birthday' => $newUserBirthday, 
			'profileImagePath' => $newUserProfileImagePath
		]);
*/
	}

	
	public function storeDetails(Request $request)
	{
		$input = $request->all();
		print_r($input);
		//die();
			
		$rules = array(
			'name'         => 'required',
			//'age'          => 'required',
			'age_submit'   => 'required',
			'height'       => 'required',
			'about-me'     => 'required',
			'org_motto'    => 'required',
			//'motto'        => 'required',
			'rel_hist'     => 'required',
			'education'    => 'required',
			'profession'   => 'required',                  
			'marital'      => 'required',                    
			'children'     => 'required',
			'rel_looking'  => 'required',
			'rel_marital'  => 'required'
		);
		$messages = array(
			'name.required'         =>'Name is required',
			'age.required'          =>'DOB is required',  
			'height.required'       =>'Height  is required',  
			'about-me.required'     =>'About is required',
			//'motto.required'        =>'Motto is required',
			'rel_hist.required'     =>'Relation History is required',
			'education.required'    =>'Education is required',
			'profession.required'   =>'Profession is required',
			'marital.required'      =>'Marital is required',
			'children.required'     =>'Children  is required',
			'rel_looking.required'  =>'Relation Looking for is required',
			'rel_marital.required'  =>'Marital status of Relationship looking for is required' 
		);

    // do the validation ----------------------------------
    // validate against the inputs from our form
    $validator = Validator::make($input, $rules, $messages);

    // check if the validator failed -----------------------
    if ($validator->fails()) {

        // get the error messages from the validator
        $messages = $validator->messages();

        // redirect our user back to the form with the errors from the validator
        return redirect()->route('edit-profile')
            ->withErrors($validator);

    } else {
	
		$user = new User;
		$user->where('email', '=', Auth::user()->email)->update(['birthday' => $input['age_submit']]);
		
		$userp = new Userprofile;
		
		$userp_id = Userprofile::firstOrCreate(['user_id' =>  Auth::user()->id]);
	
		if (Userprofile::where('user_id', '=', Auth::user()->id)->exists()) {
			$userp->where('user_id', '=', Auth::user()->id)->update([
			'about'           => $input['about-me'],         
			  'appearance1'      => $input['over_app'],          
			  'bodytype'        =>  $input['body_type'],
			  'children'        => $input['children'],       
			  'countries_visit' =>  $input['countries'],  
			  'disability'      => $input['disability'],             
			  'drink'           => $input['drink'],			     
			  'education'       => $input['education'],    
			  'ethinicity'      => $input['ethinic'], 			   
			  'eyecolor'        => $input['eye_color'],    
			  'eyewear'         => $input['eye_wear'],        
			  'fluency'         => $input['languages'],
			  'hairapp'         => $input['hair_app'],      
			  'haircolor'       => $input['hair_color'], 
			  'height'          => $input['height'],    
			  'marital'         => $input['marital'],    
			  'motto'           => $input['org_motto'],   
			  'pets'            => $input['pets'],		      
			  'profession'      => $input['profession'],
			  'relappearance'   => $input['rel_app'],  
			  'relationhist'    => $input['rel_hist'],
			  'relationlooking' => $input['rel_looking'],      
			  'relethinicity'   =>  $input['rel_ethin'],       
			  'relmarital'      =>  $input['rel_marital'],
			  'relpets'         => $input['countries'],            
			  'reltatoo'        => $input['rel_tattoo'],   
			  'smoke'           => $input['smoke'],   
			  'tatoo'           => $input['tattoo'],    
			  'weight'          => $input['weight'],              
			  'zodiac'         	=>$input['zodiac']
			]);			
		   
		} else {
			Userprofile::create([
			 'about'           => $input['about-me'],         
			  'appearance'      => $input['over_app'],          
			  'bodytype'        =>  $input['body_type'],
			  'children'        => $input['children'],       
			  'countries_visit' =>  $input['countries'],  
			  'disability'      => $input['disability'],             
			  'drink'           => $input['drink'],			     
			  'education'       => $input['education'],    
			  'ethinicity'      => $input['ethinic'], 			   
			  'eyecolor'        => $input['eye_color'],    
			  'eyewear'         => $input['eye_wear'],        
			  'fluency'         => $input['languages'],
			  'hairapp'         => $input['hair_app'],      
			  'haircolor'       => $input['hair_color'], 
			  'height'          => $input['height'],    
			  'marital'         => $input['marital'],    
			  'motto'           => $input['org_motto'],   
			  'pets'            => $input['pets'],		      
			  'profession'      => $input['profession'],
			  'relappearance'   => $input['rel_app'],  
			  'relationhist'    => $input['rel_hist'],
			  'relationlooking' => $input['rel_looking'],      
			  'relethinicity'   =>  $input['rel_ethin'],       
			  'relmarital'      =>  $input['rel_marital'],
			  'relpets'         => $input['countries'],            
			  'reltatoo'        => $input['rel_tattoo'],   
			  'smoke'           => $input['smoke'],   
			  'tatoo'           => $input['tattoo'],    
			  'weight'          => $input['weight'],              
			  'zodiac'         	=>$input['zodiac'],
			  'user_id'        => Auth::user()->id
			  ]);
		}

		
		
        // validation successful ---------------------------

        // our duck has passed all tests!
        // let him enter the database

        /*// create the data for our duck
        $duck = new Duck;
        $duck->name     = Input::get('name');
        $duck->email    = Input::get('email');
        $duck->password = Hash::make(Input::get('password'));

        // save our duck
        $duck->save();

        // redirect ----------------------------------------
        // redirect our user back to the form so they can do it all over again
        return Redirect::to('ducks');*/

    }

	}
	
}
