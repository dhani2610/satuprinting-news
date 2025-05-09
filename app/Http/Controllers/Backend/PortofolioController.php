<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortofolioController extends Controller
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
        if (is_null($this->user) || !$this->user->can('portofolio.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any portofolio !');
        }

        $data['page_title'] = 'Portofolio';
        $data['title_btn_create'] = 'Add Portofolio';
        $data['portofolios'] = Portofolio::orderBy('created_at','desc')->get();
        return view('backend.pages.master-data.portofolio.index', $data);
    }

 
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('portofolio.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any portofolios !');
        }

        try {
            $data = new Portofolio();
            $data->title = $request->title;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/Portofolio/');
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
        if (is_null($this->user) || !$this->user->can('portofolio.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any portofolio !');
        }

        try {
            $data = Portofolio::find($id);
            $data->title = $request->title;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/Portofolio/');
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
        if (is_null($this->user) || !$this->user->can('portofolio.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any portofolio !');
        }

        try {
            $data = Portofolio::find($id);
            $data->delete();

            session()->flash('success', 'Data has been deleted !!');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('failed', 'Data has failed deleted !!');
            return redirect()->back();
        }
    }
}
