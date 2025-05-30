<?php

namespace App\Http\Controllers;

use App\Models\Style;
use Illuminate\Http\Request;

class StyleController extends Controller
{
    private function validateStyle(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',


        ]);
    }
    public function index()
    {
        $styles = Style::all();
        return view('styles.list', [
            'styles' => $styles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('styles.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateStyle($request);

        $data = $request->all();
        Style::create($data);

        return redirect()->route('styles.index')->with('success', 'Style created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Style $style)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Style $style)
    {
        return view('styles.form', [
            'style' => $style,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Style $style)
    {
        $this->validateStyle($request);
        $data = $request->all();
        $style->update($data);

        return redirect()->route('styles.index')->with('success', 'Style updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Style $style)
    {
        $style->delete();
        return redirect()->route('styles.index')->with('success', 'Style deleted successfully.');
    }
    public function search(Request $request)
    {
        $value = $request->input('value');
        $column = $request->input('column');

        $styles = Style::where($column, 'like', "%{$value}%")

            ->get();

        return view('styles.list', [
            'styles' => $styles,

        ]);
    }
}
