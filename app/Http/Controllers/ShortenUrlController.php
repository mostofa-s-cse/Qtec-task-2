<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortenUrl;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ShortenUrlController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = DB::table('shorten_urls')
                    ->orderBy('id', 'DESC')
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('long_url', function ($data) {
                        return $data->long_url;
                    })
                    ->addColumn('short_url', function ($data) {
                        return '<a href="' . route('shortenedurls.redirect', $data->short_url) . '" class="" style="cursor:pointer" target="_blank">
                        ' . $data->short_url. '</a>';
                    })                    
                    ->addColumn('click_count', function ($data) {
                        return $data->click_count;
                    })
                    ->addColumn('action', function ($data) {
                        return '<div class="" role="group">
                                    <a id=""
                                        href="' . route('shortenurl.edit', $data->id) . '" class="btn btn-sm btn-success" style="cursor:pointer"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a class="btn btn-sm btn-danger" style="cursor:pointer"
                                       href="' . route('shortenurl.destroy', [$data->id]) . '"
                                       onclick="showDeleteConfirm(' . $data->id . ')" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['long_url','short_url','click_count','action'])
                    ->make(true);
            }
            return view('back-end.shortenurl.index');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }    

    public function create()
    {
        try {
            return view('back-end.shortenurl.create');
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $longUrl = $request->input('long_url');
            $shortUrl = $this->generateShortUrl();
        try {
            $request->validate([
                'long_url' => 'required|url',
            ]);
    
            $longUrl = $request->input('long_url');
            $shortUrl = $this->generateShortUrl();
    
            ShortenUrl::create([
                'long_url' => $longUrl,
                'short_url' => $shortUrl,
                'click_count' => 0,
            ]);
            return redirect()->route('shortenurl.index')
                ->with('success', 'Added Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    
    private function generateShortUrl()
    {
        return substr(md5(uniqid()), 0, 8);
    }

    public function redirectShortUrl($shortUrl)
    {
        try {
        $shortenedUrl = ShortenUrl::where('short_url', $shortUrl)->firstOrFail();

        // dd($shortenedUrl);
        $shortenedUrl->increment('click_count');
        return redirect($shortenedUrl->long_url);
    } catch (\Exception $exception) {
        return back()->with($exception->getMessage());
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $shortenurl = DB::table('shorten_urls')
                ->where('id', $id)
                ->first();
            return view('back-end.shortenurl.edit', compact('shortenurl'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'long_url' => 'required',
            'short_url' => 'required',
            'click_count' => 'required',
        ]);

        try {
            DB::table('shorten_urls')->where('id', $id)->update([
                'long_url' => $request->long_url,
                'short_url' => $request->short_url,
                'click_count' => $request->click_count,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('shortenurl.index')
                ->with('success', 'Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::table('shorten_urls')
                ->where('id', $id)
                ->delete();

            return redirect()->route('shorten_urls.index')
                ->with('success', 'Deleted Successfully');

        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }
}
