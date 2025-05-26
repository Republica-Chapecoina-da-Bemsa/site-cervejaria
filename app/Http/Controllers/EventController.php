<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $data = $request->all();

        Event::create($data);
        return redirect('event');
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
    public function edit(string $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return redirect("event")->with('error', 'Event not found');
        }
        return view('event.form', ['baker' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return redirect("event")->with('error', 'Event not found');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
        ];

        $event->update($data);
        return redirect('event');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return redirect('event')->with('error', 'Café não encontrado');
        }
        $event->delete();
        return redirect('event');
    }
    public function search(Request $request)
    {
        if (!empty($request->value)) {
            $value = $request->value;
            $type = $request->type;

            $data = Event::where($type, 'like', "%$value%")->get();
            if (empty($data)) {
                return view("event.list", ['data' => $data])->with('error', 'Nenhum resultado encontrado.');
            }
        } else {
            $data = Event::all();
        }

        return view("event.list", ['data' => $data]);
    }
}
