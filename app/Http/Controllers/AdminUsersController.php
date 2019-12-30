<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest as RequestsUsersEditRequest;
use App\Photo;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //

        $post = $request->all();

        if ($file = $request->file("photo_id")) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file' => $name]);
            $post['photo_id'] = $photo->id;
        }

        $post['password'] = bcrypt($post['password']);

        User::create($post);

        return redirect('admin/users');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsUsersEditRequest $request, $id)
    {
        //
        if (trim($request->password) == '') {
            $post = $request->except('password');
        }else {
            $post = $request->all();
            $post['password'] = bcrypt($post['password']);
        }
        

        $user = User::findOrFail($id);

        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            if ($user->photo_id) {
                $photo = Photo::findOrFail($user->photo_id);
                unlink('.' . $photo->file);
                $photo['file'] = $name;
                $photo->save();
            }else {
                $photo = Photo::create(['file' => $name]);
            }
            $post['photo_id'] = $photo->id;
        }

        

        $user->update($post);

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        unlink('.' . $user->photo->file);
        $user->delete();
        Session::flash('deleted_user', $user->name . ' has deleted');

        return redirect('/admin/users');
    }
}
