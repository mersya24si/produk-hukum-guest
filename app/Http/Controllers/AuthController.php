<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('logform');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
    'username' => 'required|max:10',
    'password' => 'required|min:3|regex:/[A-Z]/',
], [
    'username.required' => 'Username tidak boleh kosong',
    'username.max' => 'Username maksimal 20 karakter',
    'password.required' => 'Password tidak boleh kosong',
    'password.min' => 'Password minimal 3 karakter',
    'password.regex' => 'Password harus mengandung setidaknya satu huruf kapital'
]);

    $data['username'] = $request->username;
    $data['password'] = $request->password;

return view('tampilanlogin', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
