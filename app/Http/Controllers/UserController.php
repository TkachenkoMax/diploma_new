<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserAccountInformation;
use App\Models\User;
use App\Models\UserAvatar;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    /**
     * Shows page with user's contacts.
     *
     * @return $this
     */
    public function contacts()
    {
        $userContacts = Auth::user()->getContacts();

        return view('contacts.list')->with('contacts', $userContacts);
    }

    /**
     * Shows contacts management page.
     *
     * @return $this
     */
    public function management()
    {
        $incomingContacts  = Auth::user()->getIncomingContactRequests();
        $outcomingContacts = Auth::user()->getOutcomingContactRequests();

        return view('contacts.management')->with([
            'incomingContacts'  => $incomingContacts,
            'outcomingContacts' => $outcomingContacts,
        ]);
    }

    /**
     * Delete contact relationship between users.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteContact(Request $request)
    {
        $userId = Auth::user()->id;
        $contactId = $request->user_id;

        DB::table('user_contacts')
            ->where([
                'user_a_id' => $userId,
                'user_b_id' => $contactId
            ])
            ->orWhere(function ($query) use ($userId, $contactId) {
                $query->where([
                    'user_b_id' => $userId,
                    'user_a_id' => $contactId
                ]);
            })
            ->delete();

        return response('Contact deleted', 200);
    }

    /**
     * Accept add to contact request.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function acceptRequest(Request $request)
    {
        $userId = Auth::user()->id;
        $contactId = $request->user_id;

        DB::table('user_contacts')
            ->where([
                'user_a_id' => $contactId,
                'user_b_id' => $userId
            ])
            ->update([
                'status' => User::CONTACT_ACCEPTED_STATUS
            ]);

        return response('Contact request accepted', 200);
    }

    /**
     * Decline add to contact request.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function declineRequest(Request $request)
    {
        $userId = Auth::user()->id;
        $contactId = $request->user_id;

        DB::table('user_contacts')
            ->where([
                'user_a_id' => $userId,
                'user_b_id' => $contactId
            ])
            ->orWhere(function ($query) use ($userId, $contactId) {
                $query->where([
                    'user_b_id' => $userId,
                    'user_a_id' => $contactId
                ]);
            })
            ->delete();

        return response('Contact request declined', 200);
    }
}
