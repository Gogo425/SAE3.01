<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbilitiesEditController extends Controller
{

    // Retrieves abilities and their related skills for a given level
    public function index( Request $request)
    {
        $level = $request->get('level', 1);
        $abilities = DB::table('abilities')
            ->join('skills', 'abilities.id_skills', '=', 'skills.id_skills') // Join abilities with skills table
            ->where('id_level', $level) // Filter by level
            ->select(
                'abilities.id_abilities as ability_id', // Select ability ID
                'abilities.description as ability_description', // Select ability description
                'skills.id_skills as skill_id', // Select skill ID
                'skills.description as skill_description' // Select skill description
            )
            ->get();
    
        // Pass the data to the 'abilities_edit' view
        return view('abilities_edit', [
            'abilities' => $abilities,
        ]);
    }

    // Updates the description of a specific ability
    public function update(Request $request, int $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'description' => 'required|string|max:255', // Ensure 'description' is a required string with max length of 255
        ]);
    
        // Update the ability in the database
        DB::table('abilities')
            ->where('id_abilities', $id) // Find the ability by ID
            ->update([
                'DESCRIPTION' => $validated['description'], // Update its description
            ]);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Ability updated successfully!');
    }
}
