<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('members');
    }

    public function membersData()
    {
        return view('members-data');
    }


    //saveMembers to members table
    // modal Member
    public function saveMembers(Request $request)
    {

        //add validation and return error message
        $request->validate([
            'seller_name' => 'required',
            'seller_email' => 'required',
        ]);


        try {
            $save_seller = Member::create([
                'name' => $request->seller_name,
                'email' => $request->seller_email,
                'active' => $request->status
            ]);

            return response()->json(['data' => $save_seller, 'code' => 200]);
        } catch (\Throwable $th) {

            return response()->json(['data' => $th->getMessage(), 'code' => 500]);
        }
    }

    //get members data
    public function getMembers()
    {
        try {
            $members = Member::all();
            return response()->json(['data' => $members, 'code' => 200]);
        } catch (\Throwable $th) {
            return response()->json(['data' => $th->getMessage(), 'code' => 500]);
        }
    }

    //deleteMembers
    public function deleteMembers($value)
    {
        $member = Member::find($value);
        $member->delete();
        return response()->json($member);
    }

    //editMembers
    public function editMembers($id)
    {
        try {
            $member = Member::find($id);
            return response()->json(['data' => $member, 'code' => 200]);
        } catch (\Throwable $th) {
            return response()->json(['data' => $th->getMessage(), 'code' => 500]);
        }
    }

    //updateMembers
    public function updateMembers(Request $request)
    {
        try {
            $member = Member::find($request->id);
            $member->name = $request->seller_name;
            $member->email = $request->seller_email;
            $member->active = $request->status;
            $member->save();
            return response()->json(['data' => $member, 'code' => 200]);
        } catch (\Throwable $th) {
            return response()->json(['data' => $th->getMessage(), 'code' => 500]);
        }
    }
}
