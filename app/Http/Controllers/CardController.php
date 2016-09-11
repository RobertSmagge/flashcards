<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Set;
use App\Card;

class CardController extends Controller
{
    /**
     * Display a listing of the cards.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('card.index');
    }

    /**
     * Show the form for creating a new card.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('card.create');
    }

    /**
     * Store a newly created card in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'begrip' => 'required|unique:cards',
                'omschrijving' => 'required',
                'set' => 'required|exists:sets,naam',
            ]
        );

        if (!$request->hasFile('afbeelding')) {
            if ($request->has('url')) {
                $this->validate(
                    $request,
                    [
                        'url' => 'active_url',
                    ]
                );
                $request->request->add(['afbeelding' => $request->url]);
            } else {
                $this->validate(
                    $request,
                    [
                        'afbeelding' => 'required',
                    ]
                );
            }
        }

        $card = new Card($request->all());

        if ($request->hasFile('afbeelding')) {
            $card->afbeelding = Input::file('afbeelding');
        }

        $card->afbeelding = $request->afbeelding;

        $set = Set::whereNaam($request->get('set'))->first();
        $order = $set->cards->count();
        $set->cards()->save($card, ['order' => $order]);

        return redirect()->route('cards.show', [$card]);
    }

    /**
     * Display the specified card.
     *
     * @param Card $card
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        return view('card.show', ['card' => $card]);
    }

    /**
     * Show the form for editing the specified card.
     *
     * @param Card $card
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        return view('card.edit', ['card' => $card]);
    }

    /**
     * Update the specified card in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Card                     $card
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        $this->validate(
            $request,
            [
                'begrip' => 'required|unique:cards,begrip,'.$card->id,
                'omschrijving' => 'required|unique:cards,omschrijving,'.$card->id,
                'set' => 'required|exists:sets,naam',
            ]
        );

        if ($request->hasFile('image')) {
            $card->afbeelding = Input::file('image');
        } elseif ($request->has('url')) {
            $this->validate(
                $request,
                [
                    'url' => 'active_url',
                ]
            );
            $card->afbeelding = $request->url;
        }

        $card->update($request->all());

        $set = Set::whereNaam($request->get('set'))->first();
        $pivotRecord = $set->cards()->where('card_id', $card->id);
        if (!$pivotRecord->exists()) {
            $order = $set->cards->count();
            $set->cards()->save($card, ['order' => $order]);
        }

        return redirect()->route('cards.show', [$card]);
    }

    /**
     * Remove the specified card from storage.
     *
     * @param Card $card
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $card->delete();

        return redirect()->route('cards.index');
    }
}
