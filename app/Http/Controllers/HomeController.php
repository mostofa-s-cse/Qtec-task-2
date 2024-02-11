<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use App\Models\FormBuilder;
use App\Models\Forms;

class HomeController extends Controller
{
    public function frontendHome()
    {
        $organizations = DB::table('users')
        ->where('types', '2')
        ->get();
        return view('front-end.index',compact('organizations'));
    }


    public function individualCategories(Request $request)
    {
        try {
            $categories = Categories::where('organization_id', $request->id)->get();
        return view('front-end.category',compact('categories'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function read(Request $request)
        {
            $category_id = $request->category_id;
            // dd($category_id);
            // Find the record by its name attribute
            $item = FormBuilder::where('category_id', $category_id)->firstOrFail();
            return $item;
        }

    public function create(Request $request)
    {
        // dd($request);
        $request->request->remove('_token');
        $item = new Forms();
        $item->author = $request->author;
        $item->form_id = $request->form_id;
        $item->category_id = $request->category_id;
        $request->request->remove('form_id');
        $item->form = $request->all();
        $item->save();
        return redirect('/')->with('success', 'Form submit successfully');
    }
}
