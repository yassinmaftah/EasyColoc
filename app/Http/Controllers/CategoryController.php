<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //create categores for every colocation
    // this is migration of category

    // Schema::create('categories', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('name');
    //         $table->foreignId('colocation_id')->constrained()->cascadeOnDelete();
    //         $table->timestamps();
    //     });

    // create mini dashboad of cataegoris with button add and delete
    // Category has just name
    // i need first to take id of colocation

    public function store(Request $request)
    {
        // dd($request->colocation_id);
        $request->validate([
            'name' => 'required|string|max:255',
            'colocation_id' => 'required|exists:colocations,id',
        ]);

        $categoryExists = Category::where('colocation_id', $request->colocation_id)
            ->where('name', $request->name)
            ->exists();

        if ($categoryExists)
            return back()->with('error', 'You alredy Have this category in the your colocation.');

        Category::create([
            'name' => $request->name,
            'colocation_id' => $request->colocation_id,
        ]);

        return back()->with('success', 'Category Added.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Cetegory Deleted.');
    }
}
