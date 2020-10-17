<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DataTables;
use Validator;
use Str;
use Storage;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Builder;
use Auth;
use App\User;
use App\Helper\Helper;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.user.';
        $this->middleware('Admin');
    }

    /*
    User Listing page
    */
    public function index(Builder $builder, Request $request)
    {
        $postPermission = \App\Helper\Helper::getUserPermission(['user-view']);
        if (empty($postPermission)) {
            $message = "You don't have permission to access this module.";
            return view('error.permission', compact('message'));
        }

        try {
            $users = User::where('user_type', '!=', 'superadmin')->orderBy('id', 'DESC');
            if (request()->ajax()) {
                return \Yajra\DataTables\DataTables::of($users->get())
                    ->addIndexColumn()
                    ->editColumn('action', function (User $users) {
                        $action = '';
                        return $action;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            $html = $builder->columns([
                ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
                ['data' => 'name','name' => 'name','title' =>'Name','width'=>'10%'],
                ['data' => 'email','name' => 'email','title' =>'Email','width'=>'10%'],
                ['data' => 'user_type','name' => 'user_type','title' =>'User Type','width'=>'10%'],
                ['data' => 'status','name' => 'status','title' =>'Status','width'=>'15%'],
                //['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'12%',"orderable" => false],
            ])->parameters(['order' =>[]]);
            return view($this->pageLayout.'index', compact('html'));
        } catch (\Exception $e) {
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
