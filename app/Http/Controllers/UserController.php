<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserAccountInformation;
use App\Models\UserAvatar;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var \App\Repositories\UserRepository
     */
    private $repository;

    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        $user = Auth::user();

        return view('settings.index')->with('user', $user);
    }

    /**
     * Change user password.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request){
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password'     => 'required|string|min:6',
        ]);

        $params = $request->all();
        $this->repository->changePassword($params);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    /**
     * Change user account information.
     *
     * @param StoreUserAccountInformation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeInformation(StoreUserAccountInformation $request)
    {
        $params = $request->except('_token');
        $this->repository->changeInformation($params);

        return redirect()->back()->with('success', 'Information changed successfully!');
    }

    /**
     * Update user's profile picture.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function changePhoto(Request $request)
    {
        $userId = Auth::user()->id;

        try {
            $path = $request->file('croppedImage')->store(
                'avatars/' . $userId, 's3'
            );
        } catch (\Exception $e) {
            return response('Error loading avatar', 500);
        }

        $userAvatar = new UserAvatar();
        $userAvatar->user_id = $userId;
        $userAvatar->link = $path;
        $userAvatar->save();

        return response([
            'message' => 'Avatar successfully downloaded',
            'link'    => Auth::user()->getAvatarUrl()
        ], 200);
    }

    /**
     * Delete user's current avatar.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function deletePhoto()
    {
        $lastPhoto = Auth::user()->getLastAvatar();

        if ($lastPhoto) {
            $lastPhoto->delete();
        }

        return response([
            'message' => 'Avatar successfully deleted',
            'link'    => Auth::user()->getAvatarUrl()
        ], 200);
    }
}
