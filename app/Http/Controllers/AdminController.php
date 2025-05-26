<?php

namespace App\Http\Controllers;

use App\Models\tags;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    //Admin Dashboard
    public function Admin_dashboard()
    {
        return view('backend.index');
    }

    //Create_category
    public function Create_category()
    {
        return view('backend.pages.createcategory');
    }

    //Add_category
    public function Add_category(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
        ]);

        $data  = new tags();

        //Checks if the category already exist b4 adding to the database
        $category =  tags::where('category', $request->category)->exists();

        if ($category) {
            Alert::error('Failed', 'category already exist');
            return redirect()->back();
        } else {
            $data->category = $request->category;

            $data->save();

            // Notify the user that the Category has been successfully added to the database
            Alert::success('Success', 'Category Created successfully');
            // return redirect('login');
            return redirect('all_category');
        }
    }


    //All_category
    public function All_category()
    {
        $data = tags::orderBy('created_at', 'desc')->paginate(30);

        return view('backend.pages.allcategory', compact('data'));
    }

    //Edit_category
    public function Edit_category($id)
    {

        $data = tags::findOrFail($id);

        if ($data) {
            return view('backend.pages.updatecategory', compact('data'));
        } else {
            return redirect()->back();
            Alert::error('Failed', 'Inavlid Entry');
        }
    }

    //Update_category
    public function Update_category($id, Request $request)
    {
        $request->validate([
            'category' => 'required|string',
        ]);

        $data = tags::findOrFail($id);

        //checks if the category already exist && != any other category in the database b4 adding to database
        $category = tags::where('category', $request->category)->exists();

        if ($category && $data->category !== $request->category) {

            Alert::error('Registration Failed', 'Category already exist');
            return redirect()->back();
        } else {
            $data->category = $request->category;

            $data->save();

            // Notify the user that the Category has been successfully updated in the database
            Alert::success('Success', 'Category Updated successfully');
            return redirect('all_category');
        }
    }

    //Delete_category
    public function Delete_category($id)
    {
        $tag = tags::findOrFail($id);

        $tag->delete();

        // Notify the user that the Category has been successfully Deleted from the database
        Alert::success('Success', 'Category Deleted successfully');
        return redirect('all_category');
    }
}
