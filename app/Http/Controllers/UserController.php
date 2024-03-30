<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Title;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\alert;

class UserController extends Controller
{
    public function showHomePage()
    {
        //ดึงdataจากdatabase
        $users = User::all();
        
        //ไปหน้า homepage
        return view('homepage', ['users' => $users]);
    }

    public function showAddPage()
    {
        $titles = Title::orderBy('id')->get();

        return view('addpage', ['titles' => $titles]);
    }

    public function showEditPage($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('homepage')->with('error', 'User not found.');
        }
        $titles = Title::all();
        return view('editpage', compact('user', 'titles'));
    }
    

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_id' => 'required', // Change 'title' to 'title_id'
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->title_id = $request->title_id; // Change 'title' to 'title_id'
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if ($request->hasFile('avatar')) {
            $fileName = time().$request->file('avatar')->getClientOriginalName();
            $avatarPath = $request->file('avatar')->storeAs('avatars', $fileName, 'public');
            $user->avatar = '/storage/'.$avatarPath;
        } else {
            $user->avatar = '';
        }
        $user->save();

        return redirect()->route('homepage')->with('success', 'User added successfully!');
    }

    public function updateUser(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title_id' => 'required', // Change 'title' to 'title_id'
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->title_id = $validatedData['title_id']; // Change 'title' to 'title_id'
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }
        if ($request->hasFile('avatar')) {
            $fileName = time().$request->file('avatar')->getClientOriginalName();
            $avatarPath = $request->file('avatar')->storeAs('avatars', $fileName, 'public');
            $user->avatar = '/storage/'.$avatarPath;
        } else {
            $user->avatar = '';
        }
        $user->save();

        return redirect()->route('homepage')->with('success', 'User updated successfully!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        $user->delete();
        
        //กลับหน้าHomepage
        return redirect()->route('homepage')->with('success', 'User deleted successfully.');
    }
}
