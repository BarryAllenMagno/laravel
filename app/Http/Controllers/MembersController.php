<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Members;

class MembersController extends Controller
{
    public function getAllMembers()
    {
        $data = DB::table('members')->paginate(10);
        return response()->json($data);
    }

    public function saveMember(Request $request)
    {
        $validated = $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'email'           => 'nullable|email|unique:members,email',
            'phone'           => 'nullable|string|max:20',
            'birth_date'      => 'nullable|date',
            'gender'          => 'nullable|string',
            'address'         => 'nullable|string',
            'marital_status'  => 'nullable|string',
            'spiritual_bday'  => 'nullable|date',
            'status'          => 'nullable|string',
        ]);

        $member = new Members($validated);
        $member->save();

        return response()->json([
            'message' => 'Member saved successfully!',
            'member' => $member
        ], 201);
    }

    public function getMemberDetails(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:members,id',
        ]);

        $member = Members::findOrFail($validated['id']);

        return response()->json([
            'message' => 'Member details retrieved successfully.',
            'data' => $member,
        ]);
    }

    public function updateMember(Request $request)
    {
        $validatedData = $request->validate([
            'id'              => 'required|exists:members,id',
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'email'           => 'nullable|email|unique:members,email,' . $request->id,
            'phone'           => 'nullable|string|max:20',
            'birth_date'      => 'nullable|date',
            'gender'          => 'nullable|string',
            'address'         => 'nullable|string',
            'marital_status'  => 'nullable|string',
            'spiritual_bday'  => 'nullable|date',
            'status'          => 'nullable|string',
        ]);

        $member = Members::findOrFail($request->id);

        $member->update($validatedData);

        return response()->json([
            'message' => 'Member updated successfully.',
            'data' => $member,
        ]);
    }

    public function deleteMember(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:members,id',
        ]);

        $member = Members::findOrFail($validated['id']);

        $deletedId = $member->id;

        $member->delete();

        return response()->json([
            'message' => 'Member deleted successfully.',
            'deleted_id' => $deletedId
        ]);
    }
}
