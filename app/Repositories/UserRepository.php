<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Criteria\UserCriteria;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

/**
 * Class UserRepository.
 * @package namespace App\Repositories;
 */
class UserRepository extends BaseRepository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Find user by ID.
     *
     * @param integer $id user id
     *
     * @return \App\Models\User
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    /**
     * Check request and change password if valid.
     *
     * @param $params
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword($params)
    {
        if (!(Hash::check($params['current-password'], Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with('error', 'Your current password does not matches with the password you provided. Please try again.');
        }

        if(strcmp($params['current-password'], $params['new-password']) == 0){
            //Current password and new password are same
            return redirect()->back()->with('error', 'New Password cannot be same as your current password. Please choose a different password.');
        }

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($params['new-password']);
        $user->save();
    }

    /**
     * Check ruser account information.
     *
     * @param $params
     * @return void
     */
    public function changeInformation($params)
    {
        if (!empty($params['date_of_birth'])) {
            $params['date_of_birth'] = Carbon::createFromFormat('d/m/Y', $params['date_of_birth']);
        }

        $user = Auth::user();
        $user->fill($params);
        $user->save();
    }

    /**
     * Get contacts for datatable.
     *
     * @return mixed
     * @throws \Exception
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getContactsForDataTable()
    {
        $this->pushCriteria(app(UserCriteria::class));

        $idsA = DB::table('user_contacts')
            ->where('user_a_id', Auth::user()->id)
            ->get()
            ->pluck('user_b_id')
            ->toArray();

        $idsB = DB::table('user_contacts')
            ->where('user_b_id', Auth::user()->id)
            ->get()
            ->pluck('user_a_id')
            ->toArray();

        $builder = $this->getBuilder()->select('users.*')->whereNotIn('id', array_merge($idsA, $idsB, [Auth::user()->id]));

        return DataTables::of($builder)
            ->addColumn('profile_picture', function ($builder) {
                return $builder->getAvatarUrl();
            })
            ->addColumn('fullname', function ($builder) {
                return $builder->getFullNameAttribute();
            })
            ->addColumn('formatted_birthday', function ($builder) {
                return $builder->date_of_birth ? Carbon::parse($builder->date_of_birth)->toFormattedDateString() : 'Not specified';
            })
            ->addColumn('work_information', function ($builder) {
                $workText = 'Not specified';

                if ($builder->work_position && $builder->work_place) {
                    $workText = $builder->work_position . ' at ' . $builder->work_place;
                } else if ($builder->work_position && !$builder->work_place) {
                    $workText = $builder->work_position;
                } else if (!$builder->work_position && $builder->work_place) {
                    $workText = 'Work at ' . $builder->work_place;
                }

                return $workText;
            })
            ->make(true);
    }
}