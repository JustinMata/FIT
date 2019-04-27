<?php

namespace App\Http\Controllers\Auth;

use App\User;
use DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    //public function showRegistrationForm()
    public function showRegistrationForm()
    {
        if (request()->get('type') == 'restaurant')
        {
            return view('auth.registerRestaurant');
        }
        else if (request()->get('type') == 'driver')
        {
            return view('auth.registerDriver');
        }
        else return redirect('/');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        if (auth()->user()->hasRole('admin'))
        {
            return 'admin/dashboard';
        }
        else if (auth()->user()->hasRole('driver'))
        {
            return 'driver/dashboard';
        }
        else if(auth()->user()->hasRole('restaurant'))
        {
            return 'restaurant/dashboard';
        }
        else return '/';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {


        $id = DB::table('addresses')->insertGetId([
            'name' => 'default',
            'street1' => $data['street1'],
            'street2' => $data['street2'],
            'city' => $data['city'],
            'state' => $data['state'],
            'postal' => $data['zip'],
        ]);

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'email_verified_at' => now(),
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'type' => $data['type'],
            'address_id' => $id,
        ]);

        if ($user['type'] == "restaurant")
        {
            DB::table('restaurants')->insert([
                'user_id' => $user['id'],
                'provider' => $data['provider'],
                'CC_name' => $data['CC_name'],
                'CC_number' => $data['CC_number'],
                'CC_expiration' => $data['CC_expiration'],
                'CC_CVC' => $data['CC_CVC'],
            ]);
        }
        else
        {
            DB::table('drivers')->insert([
                'user_id' => $user['id'],
                'location_id' => $id,
                'account_number' => $data['account_number'],
                'account_routing' => $data['account_routing'],
                'is_available' => true,
                'car' => $data['car'],
                'license_plate' => $data['license_plate'],
                'license_number' => $data['license_number'],
                'license_expiration' => $data['license_expiration'],
                'insurance_number' => $data['insurance_number'],
            ]);
        }

        return $user;
    }

    /**
     * Get lat and lng coords of newly registered user
     *
     * @param  array  $address
     * @return lat and lng coordinates
     */
    protected function getCoords(array $address)
    {
        $fullAddress = $address['street1'] . '+' . $address['city'] . $address['state'] . '+' . $address['zip'];

        $geocode = \GoogleMaps::load('geocoding')
            ->setParam(['address' => $fullAddress])
            ->get();

        $response = json_decode($geocode);

        $lat = $response->results[0]->geometry->location->lat;
        $lng = $response->results[0]->geometry->location->lng;

        $coords = [];
        data_fill($coords, 'lat', $lat);
        data_fill($coords, 'lng', $lng);

        return $coords;
    }

}
