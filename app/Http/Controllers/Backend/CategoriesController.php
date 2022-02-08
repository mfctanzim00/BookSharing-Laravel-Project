<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $parent_categories = Category::where('parent_id', null)->get();
        return view('backend.pages.categories.index', compact('categories', 'parent_categories'));
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
        $request->validate([
           'name' => 'required|max:50',
           'slug' => 'nullable|unique:categories',
           'description' => 'nullable',
        ]);

        $category = new Category();
        $category->name = $request->name;

        if(empty($request->slug)) {
            $category->slug = str::slug($request->name);
        }
        else {
            $category->slug = $request->slug;
        }
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;
        $category->save();

        session()->flash('success', 'Category has been Created !!');
        return back();
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
        $category = Category::find($id);

        $request->validate([
           'name' => 'required|max:50',
           'slug' => 'nullable|unique:categories,slug,'.$category->id,
           'description' => 'nullable',
        ]);

        $category->name = $request->name;

        if(empty($request->slug)) {
            $category->slug = str::slug($request->name);
        }
        else {
            $category->slug = $request->slug;
        }
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;
        $category->save();
        
        session()->flash('success', 'Category has been Updated !!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete all Child Categories
        $child_categories = Category::where('parent_id', $id)->get();
        foreach ($child_categories as $child) {
            $child->delete();
        }

        $category = Category::find($id);
        $category->delete();
        session()->flash('success', 'Category has been Deleted !!');

        return back();
    }
}
