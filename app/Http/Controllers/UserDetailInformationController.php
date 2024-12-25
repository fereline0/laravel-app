<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDetailInformationUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserDetailInformationController extends Controller
{
    public function update(UserDetailInformationUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $userDetailInformation = $user->detail_information()->firstOrNew();

        if ($request->hasFile('image')) {
            if ($userDetailInformation->image) {
                Storage::disk('public')->delete($userDetailInformation->image);
            }

            $path = $request->file('image')->store('images', 'public');
            $userDetailInformation->image = $path;
        }

        $userDetailInformation->fill($request->only('about', 'gender', 'birthday', 'phone_number'));
        $userDetailInformation->user_id = $user->id;

        $userDetailInformation->save();

        return redirect()->back()->with('status', 'detail-updated');
    }

    public function deleteImage($id)
    {
        $user = User::findOrFail($id);
        $userDetailInformation = $user->detail_information()->first();

        if ($userDetailInformation && $userDetailInformation->image) {
            Storage::disk('public')->delete($userDetailInformation->image);
            
            $userDetailInformation->image = null;
            $userDetailInformation->save();
            
            return redirect()->back()->with('status', 'image-deleted');
        }

        return redirect()->back()->with('error', 'image-not-found');
    }
}
