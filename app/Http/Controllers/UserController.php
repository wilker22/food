<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Index()
    {
        return view('frontend.index');
    } // End Method

    public function ProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        $oldPhotoPath = $data->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'), $filename);
            $data->photo = $filename;

            if ($oldPhotoPath && $oldPhotoPath !== $filename) {
                $this->deleteOldImage($oldPhotoPath);
            }
        }
        $data->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    private function deleteOldImage(string $oldPhotoPath)
    {
        $fullPath = public_path('upload/client_images/' . $oldPhotoPath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    public function UserLogout()
    {
        Auth::guard('web')->logout();

        return redirect()->route('login')->with('success', 'Logout realiazado com sucesso!');
    }

    public function ChangePassword()
    {
        return view('frontend.dashboard.change_password');
    }

    public function UserPasswordUpdate(Request $request)
    {
        $user = Auth::guard('web')->user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->oldPassword, $user->password)) {

            $notification = [
                'message' => 'Antiga senha não confere',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

        //atualiza a nova senha
        User::whereId($user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = [
            'message' => 'Senha atualizada com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
