<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Type;
use App\Models\SubCategory;
use App\Models\Location;
use DB;

class OptionsController extends Controller
{
    public function AddCategoryView()
    {
        return view('addCategory');
    }

    public function updateCategoryView(int $id = 0)
    {
        $cat = Category::where('id', $id)->first();
        return view('addCategory', ["category" => $cat]);
    }
    
    public function AddCategoryLogic(Request $request)
    {
        $array = [
            "name" => $request->post('catName'),
            "lcation" => $request->post('location') && $request->post('location') == 'on' ? true : false,
            "type" => $request->post('type') ? $request->post('type') : 1,];
        if($request->post('catId') && $request->post('catId') > 0)
        {
            $array['updated_by'] = 1;
            $array['updated_at'] = now();
            DB::table('categories')->where('id', $request->post('catId'))->update($array);
        }
        else
        {
            $array['added_by'] = 1;
            $array['added_at'] = now();
            DB::table('categories')->insert($array);
        }

        return redirect()->route('addCategoryList');
    }
    
    public function updateCategoryStatus(Request $request)
    {
        $status = $request->route()->parameter('status');
        $id = $request->route()->parameter('id');
        DB::table('categories')->where('id', $id)->update(["status" => $status]);
        return redirect()->route('addCategoryList');
    }

    public function CategoryListView()
    {
        $category = Category::get();
        return view('CategoryListView', ["Category" => $category]);
    }

    public function AddTypeView()
    {
        return view('addType');
    }

    public function updateTypeView(int $id = 0)
    {
        $type = Type::where('id', $id)->first();
        return view('updateType', ["type" => $type]);
    }
    
    public function AddTypeLogic(Request $request)
    {
        $array = [
            "name" => $request->post('typeName'),
        ];
        if($request->post('typeId') && $request->post('typeId') > 0)
        {
            $array['updated_by'] = 1;
            $array['updated_at'] = now();
            DB::table('types')->where('id', $request->post('typeId'))->update($array);
        }
        else
        {
            $array['added_by'] = 1;
            $array['added_at'] = now();
            DB::table('types')->insert($array);
        }

        return redirect()->route('addTypeList');
    }

    public function updateTypeStatus(Request $request)
    {
        $status = $request->route()->parameter('status');
        $id = $request->route()->parameter('id');
        DB::table('types')->where('id', $id)->update(["status" => $status]);
        return redirect()->route('addTypeList');
    }

    public function TypeListView()
    {
        $type = Type::get();
        return view('TypeListView', ["Type" => $type]);
    }

    public function AddSubCategoryView()
    {
        $category = Category::where('status', 1)->get();
        $type = Type::where('status', 1)->get();
        return view('addSubCategory', ["category" => $category, "type" => $type]);
    }

    public function updateSubCategoryView(int $id = 0)
    {
        $category = Category::where('status', 1)->get();
        $type = Type::where('status', 1)->get();
        $subCategory = SubCategory::where('id', $id)->first();
        return view('updateSubCategory', ["category" => $category, "type" => $type, "subCategory" => $subCategory]);
    }
    
    public function AddSubCategoryLogic(Request $request)
    {
        $array = [
            "name" => $request->post('subCatName'),
            "category" => $request->post('category') ? $request->post('category') : 0,
            "type" => $request->post('type') ? $request->post('type') : 0,
        ];
        if($request->post('subCatId') && $request->post('subCatId') > 0)
        {
            $array['updated_by'] = 1;
            $array['updated_at'] = now();
            DB::table('sub_categories')->where('id', $request->post('subCatId'))->update($array);
        }
        else
        {
            $array['added_by'] = 1;
            $array['added_at'] = now();
            DB::table('sub_categories')->insert($array);
        }

        return redirect()->route('addSubCategoryList');
    }

    public function updateSubCategoryStatus(Request $request)
    {
        $status = $request->route()->parameter('status');
        $id = $request->route()->parameter('id');
        DB::table('sub_categories')->where('id', $id)->update(["status" => $status]);
        return redirect()->route('addCategoryList');
    }

    public function SubCategoryListView()
    {
        $subCategory = SubCategory::with(['category', 'type'])->get();
        return view('SubCategoryListView', ["SubCategory" => $subCategory->toArray()]);
    }

    public function AddLocationView()
    {
        return view('addLocation');
    }

    public function updateLocationView(int $id = 0)
    {
        $location = Location::where('id', $id)->first();
        return view('updateLocation', ["location" => $location]);
    }
    
    public function AddLocationLogic(Request $request)
    {
        $array = [
            "name" => $request->post('locationName'),
        ];
        if($request->post('locationId') && $request->post('locationId') > 0)
        {
            $array['updated_by'] = 1;
            $array['updated_at'] = now();
            DB::table('locations')->where('id', $request->post('locationId'))->update($array);
        }
        else
        {
            $array['added_by'] = 1;
            $array['added_at'] = now();
            DB::table('locations')->insert($array);
        }

        return redirect()->route('addLocationList');
    }

    public function updateLocationStatus(Request $request)
    {
        $status = $request->route()->parameter('status');
        $id = $request->route()->parameter('id');
        DB::table('locations')->where('id', $id)->update(["status" => $status]);
        return redirect()->route('addLocationList');
    }

    public function LocationListView()
    {
        $location = Location::get();
        return view('LocationListView', ["Location" => $location]);
    }
}


