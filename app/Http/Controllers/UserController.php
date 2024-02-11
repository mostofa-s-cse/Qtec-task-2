<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request){
        try {
            $data = DB::table('users')
                    ->orderBy('users.id', 'DESC')
                    ->get();
            if ($request->ajax()) {
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function ($data) {
                        return $data->name;
                    })
                    ->addColumn('email', function ($data) {
                        return $data->email;
                    })
                    ->addColumn('types', function ($data) {
                            return $data->types == 1 ? 'Admin' : 'User';
                        })
                    ->addColumn('action', function ($data) {
                        return '<div class="" role="group">
                                    <a id=""
                                        href="' . route('users.edit', $data->id) . '" class="btn btn-sm btn-success" style="cursor:pointer"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a class="btn btn-sm btn-danger" style="cursor:pointer"
                                       href="' . route('users.destroy', [$data->id]) . '"
                                       onclick="showDeleteConfirm(' . $data->id . ')" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['name','email','types','action'])
                    ->make(true);
            }
            return view('back-end.user.index');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function create(){
        // dd("test");
        try {
            return view('back-end.user.create');
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    public function store(Request $request){
        // dd($request);
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'password' => 'required|confirmed|min:6',
            'types'=>'required',

        ], []);
        try {
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'types'=>$request->types,
                'password' => Hash::make($request->password),
                'created_at' => Carbon::now(),
            ]);
            return redirect()->route('users.index')
                ->with('success', 'Successfully Submited');
        } catch (\Exception $exception) {

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $users = DB::table('users')
                ->where('id', $id)
                ->first();
            return view('back-end.user.edit', compact('users'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'password' => 'required|confirmed|min:6',
            'types'=>'required',
        ]);
    
        try {
            // Retrieve the existing user record by its ID
            $user = User::find($id);
    
            if (!$user) {
                return redirect()->route('users.index')
                    ->with('error', 'User not found');
            }
            
            DB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'types'=>$request->types,
                'password' => Hash::make($request->password),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('users.index')
                ->with('success', 'User Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            DB::table('users')
                ->where('id', $id)
                ->delete();

            return redirect()->route('users.index')
                ->with('success', 'Deleted Successfully');

        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }
}
