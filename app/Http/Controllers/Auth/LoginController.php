<?php
namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\sendMail;
class LoginController extends Controller
{
    /**
     * Instantiate Controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

     /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {

        return view('auth.login');
    }

     /**
     * fetch data state
    */
    public function fetchStates($country_id = null) {
    $states = \DB::table('states')->where('country_id',$country_id)->get();
    return response()->json([
        'status' => 1,
        'states' => $states
    ]);
    }

    /**
     * fetch data city
     */
    public function fetchCities($state_id = null) {
        $cities = \DB::table('cities')->where('state_id',$state_id)->get();
        return response()->json([
            'status' => 1,
            'cities' => $cities
        ]);
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $countries = \DB::table('countries')->orderBy('name','ASC')->get();
        $data['countries'] = $countries;
        
        return view('auth.register',$data);
    }
     /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:250',
        'email' => 'required|email|max:250|unique:users',
        'password' => 'required|min:8|confirmed',
        'gender' => 'required|string|max:250',
        'countries' => 'required|string|max:250',
        'state' => 'required|string|max:250',
        'city' => 'required|string|max:250'

    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'gender' => $request->gender,
        'password' => Hash::make($request->password),
        'countries' => $request->countries,
        'state' => $request->state,
        'city' => $request->city,
    ]);
    // $mailData = ['title'=> 'Registration Successful','body'=>'Thank for registering'];    //Mail functionality closed. you can cred in .env file and uncomment this code for working
    // //print_r($request->only('email'));
    // Mail::to($request->only('email'))->send(new sendMail($mailData));

    
    $credentials = $request->only('email', 'password');
    Auth::attempt($credentials);
    $request->session()->regenerate();
    return redirect()->route('dashboard')
    ->withSuccess('You have successfully registered & logged in!');
    }

     /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {  
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    } 
       /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        if(Auth::check())
        {
                    $data = User::join   ('countries', 'countries.id', '=', 'users.countries')
                    ->join('states', 'states.country_id', '=', 'countries.id')
                    ->join('cities', 'cities.state_id', '=', 'states.id')->where('email', '=',$request->only('email'))             
                    ->get(['countries.name']);
                    return view('auth.dashboard', $data);
                
        }
        
        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    } 
   

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }    
 
    
     
}
