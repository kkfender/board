<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\Board;
use App\Models\Prefecture;
use App\Models\LocalName;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $localNames = LocalName::get()->toArray();
        $prefectures = Prefecture::get()->toArray();
        $boards = Board::get()->toArray();

        return view('boards.index', compact('prefectures', 'localNames', 'boards'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FormBuilder $formBuilder)
    {
        $localName = LocalName::get()->toArray();
        $prefecture = Prefecture::get()->toArray();

             $form = $formBuilder->create(\App\Forms\SubmissionForm::class, [
            'method' => 'POST',
            'url'    => route('boards.store'),
        ]);
        return view('boards.create', compact('form', 'prefecture', 'localName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $board = new Board();

        $board->name  = $request->input('name');
        $board->title = $request->input('title');
        $board->body  = $request->input('body');
        $board->email = $request->input('email');
        $board->prefecture_id = $request->input('prefecture_id');
        $board->operation_key = $request->input('operation_key');

        $board->save();

        return view('boards.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
