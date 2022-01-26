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

    // admin reviews
    public function index()
    {
        session()->put('page', 'reviews');
        $reviews = Review::query()
            ->orderBy('id', 'desc')
            ->with(['product.section', 'product.category', 'user:id,name'])
            ->get();

        return view('admin.reviews', compact('reviews'));
    }

    public function delete(Review $review): RedirectResponse
    {
        $review->delete();
        session()->flash('successMessage', 'Delete Success');
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Review::query()->where('id', $data['record_id'])->update(['status' => $status]);
            return response()->json(['status' => $status]);
        }
    }
}
