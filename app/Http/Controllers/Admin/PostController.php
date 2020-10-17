<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
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
use Helmesvs\Notify\Facades\Notify;
use App\Helper\Helper;

class PostController extends Controller
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
        $this->pageLayout = 'admin.pages.posts.';
        $this->middleware('Admin');
    }

    /*
    User Listing page
    */
    public function index(Builder $builder, Request $request)
    {
        try {
            $postPermission = \App\Helper\Helper::getUserPermission(['post-view','post-create','post-edit','post-delete']);
            if (empty($postPermission)) {
                $message = "You don't have permission to access this module.";
                return view('error.permission', compact('message'));
            }

            $post = Post::orderBy('id', 'DESC');
            if (request()->ajax()) {
                return \Yajra\DataTables\DataTables::of($post->get())
                    ->addIndexColumn()
                    ->editColumn('image', function (Post $post) {
                        if (!empty($post->image)) {
                            return '<div class="tableAvatar"><img height="50px" width="50px" src = "'.asset('storage/posts/').'/'.$post->image .'" alt = "user" class="rounded-circle"></div>';
                        } else {
                            return '<div class="tableAvatar"><img src = "'.asset('uploads/settings/avatar.png') .'" alt = "user" height="50px" width="50px" class="rounded-circle"></div>';
                        }
                    })
                    ->editColumn('action', function (Post $post) {
                        $action = '';
                        $action .= '<a title="Edit" class="btn btn-warning btn-sm ml-1" href='.route('admin.post.edit', [$post->id]).'><i class="fa fa-pencil"></i></a>';
                        return $action;
                    })
                    ->editColumn('description', function (Post $post) {
                        $action = strip_tags($post->description);
                        return $action;
                    })
                    ->editColumn('user_id', function (Post $post) {
                        $action = @$post->user->name;
                        return $action;
                    })
                    ->rawColumns(['action','image'])
                    ->make(true);
            }
            $html = $builder->columns([
                ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
                ['data' => 'user_id','name' => 'user_id','title' =>'UserName','width'=>'10%'],
                ['data' => 'title','name' => 'title','title' =>'Title','width'=>'10%'],
                ['data' => 'description','name' => 'description','title' =>'Description','width'=>'10%'],
                ['data' => 'image','name' => 'image','title' =>'image','width'=>'15%'],
                ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'12%',"orderable" => false],
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
        $postPermission = \App\Helper\Helper::getUserPermission(['post-create']);
        if (empty($postPermission)) {
            $message = "You don't have permission to access this module.";
            return view('error.permission', compact('message'));
        }
        $users = User::where('user_type', '!=', 'superadmin')->pluck('name', 'id');
        return view($this->pageLayout.'create', compact('users'));
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
            'title'           => 'required|unique:posts,title|min:1|max:100',
            'description'     => 'required',
            'user_id'         => 'required',
            'image'           => 'sometimes|mimes:jpeg,jpg,png',
        ]);
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('posts', $file, $filename);
            } else {
                $filename = '';
            }

            Post::create([
                'title'     =>  @$request->title,
                'description'     =>  @$request->description,
                'user_id'     =>  $request->user_id,
                'image'     =>  @$filename,
                'slug'     =>  Str::slug(@$request->title),
            ]);

            Notify::success('Post Created successfully !!');
            return redirect()->route('admin.post.index');
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
        $postPermission = \App\Helper\Helper::getUserPermission(['post-edit']);
        if (empty($postPermission)) {
            $message = "You don't have permission to access this module.";
            return view('error.permission', compact('message'));
        }
        $post = Post::where('id', $id)->first();
        $users = User::where('user_type', '!=', 'superadmin')->pluck('name', 'id');
        return view($this->pageLayout.'edit', compact('users', 'post'));
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
        $validatedData = $request->validate([
            'title'           => 'required|min:1|max:100',
            'description'     => 'required',
            'user_id'         => 'required',
            'image'           => 'sometimes|mimes:jpeg,jpg,png',
        ]);
        try {
            $post = Post::where('id', $id)->first();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('posts', $file, $filename);
            } else if ($post->image) {
                $filename = $post->image;
            } else {
                $filename = '';
            }

            Post::where('slug', $id)->update([
                'title'     =>  @$request->title,
                'description'     =>  @$request->description,
                'user_id'     =>  $request->user_id,
                'image'     =>  @$filename,
            ]);

            Notify::success('Post Updated successfully !!');
            return redirect()->route('admin.post.index');
        } catch (\Exception $e) {
            Notify::error($e->getMessage());
        }
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
