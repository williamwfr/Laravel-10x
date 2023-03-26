<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support){
        $supports = $support->all();

        return view('admin.supports.index', compact('supports'));
    }

    public function show($id){
        //Support::find($id);
        //Support::where('id', $id)->first();
        //Support::where('id', '!=', $id)->first();
        if (!$support = Support::find($id)){
            return back();
        }
        return view('admin.supports.show', compact('support'));
    }

    public function create(){
        return view('admin.supports.create');
    }

    public function store(Request $request, Support $support){
        $data = $request->all();
        $data['status'] = 'a';

        $support = $support->create($data);
        return redirect()->route('supports.index');
    }

    public function edit(Support $support, $id){
        if(!$support = $support->where('id', $id)->first()){
            return back();
        }
        return view('admin.supports.edit', compact('support'));
    }

    public function update(Request $request, Support $support, $id){
        if (!$support = Support::find($id)){
            return back();
        }
        $support->update($request->only([
            'subject', 'body'
        ]));

        //$support->subject = $request->subject;
        //$support->body = $request->body;
        //$support->save();

        return redirect()->route('supports.index');
    }

    public function destroy($id){
        if (!$support = Support::find($id)){
            return back();
        }
        $support->delete();
        
        return redirect()->route('supports.index');
    }
}
