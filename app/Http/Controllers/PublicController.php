<?php

/**
 * Class PublicController
 *
 * @category Worketic
 *
 * @package Worketic
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\User;
use App\Language;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMailable;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Redirect;
use Hash;
use Auth;
use DB;
use App\Helper;
use App\Profile;
use App\Category;
use App\Location;
use App\Skill;
use Session;
use Storage;
use App\Report;
use App\Job;
use App\Proposal;
use App\EmailTemplate;
use App\Mail\GeneralEmailMailable;
use App\Mail\AdminEmailMailable;
use App\SiteManagement;
use App\Review;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Payout;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use App\Service;
use App\DeliveryTime;
use App\ResponseTime;

/**
 * Class PublicController
 *
 */
class PublicController extends Controller
{

    /**
     * User Login Function
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request)
    {
        $json = array();
        if (Session::has('user_id')) {
            $id = Session::get('user_id');
            $user = User::find($id);
            Auth::login($user);
            $json['type'] = 'success';
            $json['role'] = $user->getRoleNames()->first();
            session()->forget('user_id');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Step1 Registeration Validation
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function registerStep1Validation(Request $request)
    {
        $this->validate(
            $request,
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
            ]
        );
    }

    /**
     * Step2 Registeration Validation
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function registerStep2Validation(Request $request)
    {
        $this->validate(
            $request,
            [
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
                'termsconditions' => 'required',
            ]
        );
    }

    /**
     * Set slug before saving in DB
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyUserCode(Request $request)
    {
        $json = array();
        if (Session::has('user_id')) {
            $id = Session::get('user_id');
            $email = Session::get('email');
            $password = Session::get('password');
            $user = User::find($id);

        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.session_expire');
            return $json;
        }
    }

    /**
     * Show user profile.
     *
     * @param string $slug slug
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserProfile($slug)
    {
        $user = User::select('id')->where('slug', $slug)->first();
        if (!empty($user)) {
            $user = User::find($user->id);
            if ($user->is_disabled == 'true') {
                abort(404);
            }

                
            return view('front-end.users.show', compact('user'));
                        
        } else {
            abort(404);
        }
    }

    /**
     * Get Pass Reset Form
     *
     * @param mixed $verification_code verification_code
     *
     * @access public
     *
     * @return View
     */
    public function resetPasswordView($verification_code)
    {
        if (!empty($verification_code)) {
            session()->put(['verification_code' => $verification_code]);
            if (file_exists(resource_path('views/extend/front-end/reset-password.blade.php'))) {
                return View('extend.front-end.reset-password');
            } else {
                return View('front-end.reset-password');
            }
        } else {
            abort(404);
        }
    }

    /**
     * Reset user password.
     *
     * @param mixed $request req->attr
     *
     * @access public
     *
     * @return View
     */
    public function resetUserPassword(Request $request)
    {
        if (Session::has('verification_code')) {
            $verification_code = Session::get('verification_code');
            if (!empty($request)) {
                $this->validate(
                    $request,
                    [
                        'new_password' => 'required',
                        'confirm_password' => 'required',
                    ]
                );
                $user_id = User::select('verification_code', 'id')
                    ->where('verification_code', $verification_code)
                    ->pluck('id')->first();
                $user = User::find($user_id);
                if ($request->new_password === $request->confirm_password) {
                    if ($verification_code === $user->verification_code) {
                        $user->password = Hash::make($request->confirm_password);
                        $user->verification_code = null;
                        $user->save();
                        Auth::logout();
                        session()->forget('verification_code');
                        return Redirect::to('/');
                    } else {
                        Session::flash('error', trans('lang.invalid_verify_code'));
                        return Redirect::back();
                    }
                } else {
                    Session::flash('error', trans('lang.pass_mismatched'));
                    return Redirect::back();
                }
            } else {
                Session::flash('error', trans('lang.something_wrong'));
                return Redirect::back();
            }
        } else {
            Session::flash('error', trans('lang.invalid_verify_code'));
            return Redirect::back();
        }
    }
}
