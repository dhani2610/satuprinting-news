<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MesinController extends Controller
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
        if (is_null($this->user) || !$this->user->can('mesin.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any mesin !');
        }

        $data['page_title'] = 'Mesin';
        $data['title_btn_create'] = 'Add Mesin';
        $data['mesins'] = Mesin::orderBy('created_at','desc')->get();
        return view('backend.pages.master-data.mesin.index', $data);
    }

 
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('mesin.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any mesins !');
        }

        try {
            $data = new Mesin();
            $data->title = $request->title;
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
        if (is_null($this->user) || !$this->user->can('mesin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any mesin !');
        }

        try {
            $data = Mesin::find($id);
            $data->title = $request->title;
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
        if (is_null($this->user) || !$this->user->can('mesin.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any mesin !');
        }

        try {
            $data = Mesin::find($id);
            $data->delete();

            session()->flash('success', 'Data has been deleted !!');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('failed', 'Data has failed deleted !!');
            return redirect()->back();
        }
    }
}
