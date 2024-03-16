<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return response()->json($contacts);
    }

    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'address' => 'nullable|string',
        ]);

        // Create a new contact
        Contact::create($validatedData);

        // Return to JSON
        return response()->json(['message' => 'Contact created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
         $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'address' => 'nullable|string',
        ]);

        // Find the contact by ID
        $contact = Contact::findOrFail($id);

        // Update the contact's information
        $contact->update($validatedData);

        return response()->json(['message' => 'Contact updated successfully'], 200);
    
    }

    public function destroy($id)
    {
        // try {
        //     // Find the contact by ID
        //     $contact = Contact::findOrFail($id);
            
        //     // Delete the contact
        //     $contact->delete();
    
        //     return response()->json(['message' => 'Contact deleted successfully'], 200);
        // } catch (\Exception $e) {
        //     // Handle any errors
        //     return response()->json(['error' => 'Failed to delete contact'], 500);
        // }
        $contact = Contact::find($id);
        $contact->delete();
        return response()->json('Contact has been deleted!');
    }
}
