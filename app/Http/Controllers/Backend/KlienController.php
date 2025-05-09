<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Klien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KlienController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        if (is_null($this->user) || !$this->user->can('klien.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any klien !');
        }

        $data['page_title'] = 'Klien';
        $data['title_btn_create'] = 'Add Klien';
        $data['kliens'] = Klien::orderBy('created_at','desc')->get();
        return view('backend.pages.master-data.klien.index', $data);
    }

 
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('klien.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any kliens !');
        }

        try {
            $data = new Klien();
            $data->title = $request->title;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/klien/');
                $image->move($destinationPath, $name);
                $data->image = $name;
            }
            $data->save();

            session()->flash('success', 'Data has been created !!');
            return redirect()->back();

        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('klien.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any klien !');
        }

        try {
            $data = Klien::find($id);
            $data->title = $request->title;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/klien/');
                $image->move($destinationPath, $name);
                $data->image = $name;
            }
            
            $data->save();

            session()->flash('success', 'Data has been edited !!');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('klien.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any klien !');
        }

        try {
            $data = Klien::find($id);
            $data->delete();

            session()->flash('success', 'Data has been deleted !!');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('failed', 'Data has failed deleted !!');
            return redirect()->back();
        }
    }
}
