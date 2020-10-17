<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Post;
use App\Role;
use App\RolePermission;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\Helpers\Helper;

class PermissionController extends Controller
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
        $this->pageLayout = 'admin.pages.rolepermission.';
        $this->middleware('Admin');
    }

    /*
    User Listing page
    */
    public function role_index(Builder $builder, Request $request)
    {
        try {
            $post = Role::where('id', '!=', '1')->orderBy('id', 'DESC');
            if (request()->ajax()) {
                return \Yajra\DataTables\DataTables::of($post->get())
                    ->addIndexColumn()
                    ->editColumn('role', function (Role $post) {
                        $action = ucfirst(@$post->role);
                        return $action;
                    })
                    ->editColumn('action', function (Role $post) {
                        $action = '';
                        $action .= '<a title="Edit" class="btn btn-warning btn-sm ml-1" href='.route('admin.permission.create', [$post->id]).'><i class="fa fa-pencil"></i></a>';
                        return $action;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            $html = $builder->columns([
                ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
                ['data' => 'role','name' => 'role','title' =>'Role','width'=>'10%'],
                ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'12%',"orderable" => false],
            ])->parameters(['order' =>[]]);
            return view($this->pageLayout.'role', compact('html'));
        } catch (\Exception $e) {
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }


    public function permission(Builder $builder, Request $request)
    {
        try {
            $post = Permission::orderBy('id', 'DESC');
            if (request()->ajax()) {
                return \Yajra\DataTables\DataTables::of($post->get())
                    ->addIndexColumn()
                    ->editColumn('role', function (Permission $post) {
                        $action = ucfirst(@$post->permission);
                        return $action;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            $html = $builder->columns([
                ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
                ['data' => 'role','name' => 'role','title' =>'Role','width'=>'10%'],
            ])->parameters(['order' =>[]]);
            return view($this->pageLayout.'permission', compact('html'));
        } catch (\Exception $e) {
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    public function getAllPermission()
    {
        $permissions = Permission::get();
        return view($this->pageLayout.'setpermission', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $roles = Role::where('id', $id)->first();
        $permissions = Permission::get();
        $rolePermissions = RolePermission::pluck('permission_id')->toArray();
        return view($this->pageLayout.'create', compact('roles', 'permissions', 'rolePermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role_id'           => 'required',
            'permission'     => 'required',

        ]);
        try {
            if (isset($request->permission)) {
                RolePermission::where('role_id', $request->role_id)->forceDelete();
                foreach ($request->permission as $permission) {
                    RolePermission::create([
                        'role_id' => $request->role_id,
                        'permission_id' => $permission,
                    ]);
                }
            }

            Notify::success('Permission Set successfully !!');
            return redirect()->route('admin.role.index');
        } catch (\Exception $e) {
            Notify::error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
