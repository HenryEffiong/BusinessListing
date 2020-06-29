<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Business;
use Illuminate\Support\Facades\Validator;
use App\Category;
use App\Rating;
use Illuminate\Support\Facades\DB;

class BusinessesController extends Controller
{
   
    public function index()
    {
        $businesses = Business::all();
        $data = $businesses->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Business listings retrieved successfully.'
        ];

        return response()->json($response, 200);
    }


    public function create()
    {
        $categories = Category::all();
        return view('business.create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'url' => 'required',
            'image' => 'required|image',
            'contact_email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
            
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $business = Business::create($input);
        $cid = $request['category_id'];
        $category = Category::find($cid);
        $business->category()->attach($category);
        $data = $business->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Business listing stored successfully.'
        ];

        return response()->json($response, 200);
            
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'url' => 'required',
            'image' => 'required|image',
            'contact_email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
            'category' => 'required',
        ]);
        
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }
        
        $business = Business::find($id);
        
        $business->name = $input['name'];
        $business->description = $input['description'];
        $business->url = $input['url'];
        $business->contact_email = $input['contact_email'];
        $business->phone_number = $input['phone_number'];
        $business->address = $input['address'];
        $business->image= $input['image'];
        

        $business->save();
        $cid = $request['category_id'];
        $category = Category::find($cid);
        $business->category()->attach($category); 

        $data = $business->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Business listing updated successfully.'
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $business = Business::find($id);
        $business->delete();

        $response = [
            'success' => true,
            'data' => $business,
            'message' => 'Business listing deleted successfully.'
        ];

        return response()->json($response, 200);
    }

    public function details($id)
    {
        $businessListing = Business::find($id);
        $views = $businessListing['views'];
        
        if ($views == null ) {
            $views = 1;
        }else {
            $views += 1;
        }

        $businessListing->views = $views;
        $businessListing->save();

        return response()->json($views, 200);
    }

    public function rating(Request $request)
    {

        $business_id = $request->business_id;

        $rating_id = $request->rating_id;

        $business = Business::find($business_id);

        $rating = Rating::find($rating_id);

        $business->rating()->attach($rating);  

        $business_rating = DB::table('business_rating')->where('business_id','like', $business_id)->avg('rating_id');

        return response()->json(round($business_rating), 200);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $business = DB::table('businesses')->where('name', 'like', '%'.$search.'%')->get();
        
        return response()->json($business, 200);
    }



}
