<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private function validateEvent(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
    public function index()
    {
        $events = Event::all();
        return view('events.list', [
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateEvent($request);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('events/images', 'public');
            $data['image'] = $imagePath;
        }
        Event::create($data);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.form', [
            'event' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $this->validateEvent($request);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('events/images', 'public');
            $data['image'] = $imagePath;
        }
        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->image) {
            $imagePath = public_path('storage/' . $event->image);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file
            }
        }
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
    public function search(Request $request)
    {
        $value = $request->input('value');
        $column = $request->input('column');

        $events = Event::where($column, 'like', "%{$value}%")

            ->get();

        return view('events.list', [
            'events' => $events,

        ]);
    }
}
