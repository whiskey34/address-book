<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //
    public function index()
    {
        //get all posts
        $contacts = Contact::latest()->paginate(5);

        //return collection of posts as a resource
        return new ContactResource(true, 'List Data Contact', $contacts);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            // 'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'     => 'required',
            'phone'     => 'required|numeric|digits:10',
            'email'   => 'required|email',
            'address'   => 'required',
            'city'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        //create new contact
        $contact = Contact::create([
            // 'image'     => $image->hashName(),
            'name'     => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'address'   => $request->address,
            'city'   => $request->city,
        ]);

        //return response
        return new ContactResource(true, 'Data kontak Berhasil Ditambahkan!', $contact);
    }

    // show data contact
    public function show($id)
    {
        //find post by ID
        $contact = Contact::find($id);

        //return single post as a resource
        return new ContactResource(true, 'Detail Data Post!', $contact);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'phone'     => 'required|numeric|digits:13',
            'email'   => 'required|email',
            'address'   => 'required',
            'city'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $contact = Contact::find($id);

        $contact->update([
            // 'image'     => $image->hashName(),
            'name'     => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'address'   => $request->address,
            'city'   => $request->city,
        ]);

        //check if image is not empty
        // if ($request->hasFile('image')) {

        //     //upload image
        //     // $image = $request->file('image');
        //     // $image->storeAs('public/posts', $image->hashName());

        //     //delete old image
        //     // Storage::delete('public/posts/' . basename($post->image));

        //     //update post with new image
        //     $contact->update([
        //         // 'image'     => $image->hashName(),
        //         'name'     => $request->name,
        //         'phone'   => $request->phone,
        //         'email'   => $request->email,
        //         'address'   => $request->address,
        //         'city'   => $request->city,
        //     ]);
        // } else {

        //     //update post without image
        //     $contact->update([
        //         'name'     => $request->name,
        //         'phone'   => $request->phone,
        //         'email'   => $request->email,
        //         'address'   => $request->address,
        //         'city'   => $request->city,
        //     ]);
        // }

        //return response
        return new ContactResource(true, 'Data kontak Berhasil Diubah!', $contact);
    }

    public function destroy($id)
    {

        //find post by ID
        $contact = Contact::find($id);

        //delete image
        // Storage::delete('public/posts/'.basename($post->image));

        //delete post
        $contact->delete();

        //return response
        return new ContactResource(true, 'Kontak Berhasil Dihapus!', null);
    }

}
