<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDetailInformationUpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class UserDetailInformationController extends Controller
{
    use AuthorizesRequests;

    public function update(UserDetailInformationUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('edit', $user);

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

    public function deleteAvatar($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('edit', $user);

        if ($user->detail_information && $user->detail_information->image) {
            Storage::disk('public')->delete($user->detail_information->image);
            $user->detail_information->image = null;
            $user->detail_information->save();
        }

        return redirect()->back()->with('status', 'image-deleted');
    }
}
