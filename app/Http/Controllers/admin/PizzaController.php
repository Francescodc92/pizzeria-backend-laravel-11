<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pizzas\StorePizzaRequest;
use App\Http\Requests\Pizzas\UpdatePizzaRequest;
use App\Models\Pizza;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::paginate(8);

        return view('admin.pizza.index', compact('pizzas'));
    }

    public function create() 
    {
        return view('admin.pizza.create');
    }

    public function store(StorePizzaRequest $request)
    {
        $formData = $request->validated();

        $image_path = null;
        if(isset($formData['image'])){
            $image_path = Storage::put('uploads/images', $formData['image']);
        }

        $formData['image'] = $image_path;

        Pizza::create($formData);

        return redirect()->route('admin.pizzas.index')->with('message', 'Pizza Created Successfully');
    }

    public function show(Pizza $pizza)
    {
        return view('admin.pizza.show', compact('pizza'));
    }

    public function edit(Pizza $pizza)
    {
        return view('admin.pizza.edit', compact('pizza'));
    }

    public function update(UpdatePizzaRequest $request, Pizza $pizza)
    {

        $formData = $request->validated();

        $formData['available'] = $request->has('available') ? $formData['available'] : false;

        $image_path = $pizza->image;
        if(isset( $formData['image'])){

            if($pizza->image){
                Storage::delete($pizza->image);
            }

            $image_path = Storage::put('uploads/images', $formData['image']);
        }
        else if (isset($formData['remove_image'])){
            if($pizza->image){
                Storage::delete($pizza->image);
            }
            $image_path = null;
        }

        $formData['image'] = $image_path;


        $pizza->update($formData);

        return redirect()->route('admin.pizzas.index')->with('message', 'Pizza Updated Successfully');
    }


    public function destroy(Pizza $pizza)
    {
        $pizza->delete();

        if($pizza->image){
            Storage::delete($pizza->image);
        }

        return redirect()->route('admin.pizzas.index')->with('message', 'Pizza Deleted Successfully');
    }
}
