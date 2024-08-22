<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        // dd($request);
        return view('frontend/auth/login');
    }

    public function authenticate(Request $request)
    {

        // dd($request);
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        
        $password = $request->input('password');

        if (User::where('email', $email)->exists()) 
        {
            $user = User::where('email', $email)->first();
            
            Auth::login($user);        

            return redirect('/');
        }
        
        return redirect()->back()->withInput()->withErrors(['email' => 'Invalid email  or password']);
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(Request $request)
    {
        // dd($request);
        // Retrieve all cities for use in the view
        $cities = City::all();

        // Retrieve all categories for use in the view
        $categories = Category::all();


        // Initialize data array
        $data = [
            'categories' => $categories,
            'cities' => $cities,
         ];
        return view('frontend/auth/register',$data);
    }

    public function store(Request $request)
    {
        try 
        {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
                'name' => 'required',
                'password' => 'required',
                'confirmPassword' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'pincode' => 'required',
                'country' => 'required',
                'captcha' => 'required'
            ]);
    
            // Check if validation fails
            // if ($validator->fails()) {
            //     return redirect()->back()->withErrors($validator)->withInput();
            // }
    
            // dd($request);
    
            $user = User::create([
                'name' => $request->input('name'),
                'gender' => $request->input('gender'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'pincode' => $request->input('pincode'),
                'country' => $request->input('country'),
            ]);

            $selectedRole = Role::where('name', 'Customer')->first();

            // dd($request->input('occupation'));
            // dd($selectedRole);
            
            $user->assignRole($selectedRole->name);

            // Register successful, set success message            
            $request->session()->flash('success_message', 'User registered successfully');
    
            // Redirect or return response
            return redirect()->route('home.register')->with('success', 'Registration successful!');    
        } 
        catch (ValidationException $e) {
            // return response()->json(['error' => $e->validator->errors()], 200);

            // Validation failed, return validation errors
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
            // dump($e->validator->errors());
        }
    }
    public function forget_password(Request $request)
    {
        return view('frontend/auth/forget_password');
    }

    public function reset_password(Request $request)
    {
        return view('frontend/auth/reset_password');
    }

    public function my_account(Request $request)
    {
        return view('frontend/auth/my_account');
    }

    public function privacy_policy(Request $request)
    {
        return view('frontend/auth/privacy_policy');
    }

    public function terms(Request $request)
    {
        return view('frontend/auth/terms');
    }

    public function error(Request $request)
    {
        return view('frontend/error/page_not_found');
    }
}