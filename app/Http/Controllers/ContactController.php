<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function __construct(public $imageService = new ImageService())
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contacts = Contact::latest()->get();
        return Inertia::render('Contacts/Index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Contacts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        $contact = Contact::create([
            'name' => $request->name,
            "phone_number" => $request->phoneNumber,
        ]);
        if ($request->hasFile('image')) {
            $image = $this->imageService->upload($request->file('image'));
            $contact->update([
                'image' => $image
            ]);
        }

        return to_route('contact.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return Inertia::render('Contacts/Edit', compact('contact'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request)
    {
        $contact = Contact::find($request->id);
        if ($contact) {
            $contact->update([
                'name' => $request->name,
                "phone_number" => $request->phoneNumber,
            ]);
            if ($request->hasFile('image')) {
                $this->imageService->unlink($contact->image);
                $image = $this->imageService->upload($request->file('image'));
                $contact->update([
                    'image' => $image
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        if ($contact) {
            $this->imageService->unlink($contact->image);
            $contact->delete();
            return;
        }
    }
}
