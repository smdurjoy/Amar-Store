<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Review $review): RedirectResponse
    {
        try {
            $rules = [
                'review' => 'required',
            ];
            $this->validate($request, $rules);

            $review->fill($request->all())->save();
            session()->flash('successMessage', 'Review posted.');

        } catch (\Exception $e) {
            session()->flash('errorMessage', $e->getMessage());
        }

        return redirect()->back();
    }
}
