<?php
namespace App\Repositories;
use Auth;
use App;
use App\Relationhistory;
use App\Education;
use App\Profession;
use App\Bodytype;
use App\Zodiac;
use App\Disability;
use App\Languages;
use App\Currency;
use App\Color;
use App\Hairapp;
use App\Eyewear;
use App\Appearance;
use App\Pets;
use App\Marital;
use App\Countries;
use App\Smoketype;
use App\Drinktype;
use App\Relationfor;
use App\Motto;
use App\Uservid;
use App\Userpic;
use App\User;
use App\Userprofile;
use DB;

class DataRepository {

    public function getData()
    {
		$user = Auth::user()->id;
        $data = array();

        $data['mottos'] = Motto::all();

        $data['pets'] = Pets::all();
		
		$data['relationhistory']=Relationhistory::all();
		$data['education']      =Education::all();
		$data['profession']     =Profession::all();
		$data['bodytype']       =Bodytype::all();
		$data['zodiac']         =Zodiac::all();
		$data['languages']      =Languages::all();
		$data['currency']       =Currency::all();
		$data['color']          =Color::all();
		$data['hairapp']        =Hairapp::all();
		$data['eyewear']        =Eyewear::all();
		$data['appearance']     =Appearance::all();
		$data['pets']           =Pets::all();
		$data['marital']        =Marital::all();
		$data['countries']      =Countries::all();
		$data['smoketype']      =Smoketype::all();
		$data['drinktype']      =Drinktype::all();
		$data['relationfor']    =Relationfor::all();
		$data['uservid']        =Uservid::where('user_id', $user);
		$data['userpic']        =Userpic::where('user_id', $user);
		$data['user']        = User::where('id', $user)->first();
		$data['userprofiles']        =Userprofile::where('user_id', $user)->first();
		
		$data['mapped'] = DB::table('users')
			->leftjoin('userprofiles', 'users.id', '=', 'userprofiles.user_id')
            ->leftjoin('relationhistory', 'userprofiles.relationhist', '=', 'relationhistory.id')
			->leftjoin('relationhistory AS rel_look', 'userprofiles.relationlooking', '=', 'relationhistory.id')
            ->leftjoin('education', 'userprofiles.education', '=', 'education.id')
			->leftjoin('profession', 'userprofiles.profession', '=', 'profession.id')
			->leftjoin('bodytype', 'userprofiles.bodytype', '=', 'bodytype.id')
			->leftjoin('zodiac', 'userprofiles.zodiac', '=', 'zodiac.id')
			->leftjoin('color AS h_color', 'userprofiles.haircolor', '=', 'h_color.id')
			->leftjoin('hairapp', 'userprofiles.hairapp', '=', 'hairapp.id')
			->leftjoin('color AS e_color', 'userprofiles.eyecolor', '=', 'e_color.id')
			->leftjoin('eyewear', 'userprofiles.eyewear', '=', 'eyewear.id')
			->leftjoin('appearance', 'userprofiles.appearance', '=', 'appearance.id')
			->leftjoin('smoketype', 'userprofiles.smoke', '=', 'smoketype.id')
			->leftjoin('drinktype', 'userprofiles.drink', '=', 'drinktype.id')
			->leftjoin('marital', 'userprofiles.marital', '=', 'marital.id')
			->leftjoin('marital AS lmarital', 'userprofiles.relmarital', '=', 'lmarital.id')
            ->select('users.id','relationhistory.rel_hist','rel_look.rel_hist AS lrel_hist', 'education.education', 'profession.profession', 'bodytype.body_type', 'zodiac.zodiac', 'h_color.name AS hcolor', 'e_color.name AS ecolor', 'hairapp.type AS htype','eyewear.type AS etype', 'appearance.type AS atype','smoketype.type AS stype', 'drinktype.type AS dtype', 'marital.status','lmarital.status AS lstatus')
			->where('users.id', $user)
            ->get();
		
		
        return $data;
    }

}