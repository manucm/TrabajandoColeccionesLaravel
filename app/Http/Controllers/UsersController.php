<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
	protected $validation_rules = [
		'name' => 'required|min:4',
	];
    public function usersForm() {
    	return view('users.usersForm');
    }

    public function store(Request $request) {
    	$this->validate($request, $this->validation_rules);
    	dd($request->all());
    }
}
