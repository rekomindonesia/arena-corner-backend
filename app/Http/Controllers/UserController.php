<?php
 
namespace App\Http\Controllers;
 
use App\User;
use Illuminate\Http\Request;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
 
class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    // public function index()
    // {
    //     return view('masuk');
    // }
    // public function masuk(Request $request)
    // {
    //     request()->validate([
    //     'email' => 'required',
    //     'password' => 'required',
    //     ]);
 
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {
    //         // Authentication passed...
    //         return redirect()->intended('dashboard');
    //     }
    //     return Redirect::to("masuk")->withSuccess('Oppes! You have entered invalid credentials');
    // }
    // public function dashboard()
    // {
 
    //   if(Auth::check()){
    //     return view('transaksi');
    //   }
    //    return Redirect::to("masuk")->withSuccess('Opps! You do not have access');
    // }
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,

        ]);
 
        $token = $user->createToken('TutsForWeb')->accessToken;
 
        return response()->json([
            'message' => 'Register success'
        ], 200);
    }
 
    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('TutsForWeb')->accessToken;
            return response()->json([
                'data' => 
                    [
                        'message' => 'Login Success', 
                        'token' => $token
                    ]
                ],200);
        } else {
            return response()->json(
                ['message' => 'Login Failed'
            ], 401);
        }
    }
 
    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
}