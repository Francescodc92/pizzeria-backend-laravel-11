<div class="mb-4">
  <label class="block text-gray-700 dark:text-white text-sm font-bold mb-2" for="name">
    <span class="text-[#C83B1A]">*</span>
    Nome 
  </label>
  <input class="shadow dark:bg-slate-500 dark:text-white  border-[#C83B1A] appearance-none border rounded  w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" value="{{ isset($pizza) ? $pizza->name : old('name') }}">
  @error('name')
    <span class="text-red-500 text-sm bg-red-300 px-4 py-1 rounded-sm ">{{ $message }}</span>
  @enderror
</div>

<div class="mb-4">
  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">
    Immagine
  </label>
  <input class="shadow appearance-none border dark:bg-slate-500  border-[#C83B1A] dark:text-white  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image" name="image" type="file" accept="image/*">
</div>
@error('image')
  <span class="text-red-500 text-sm bg-red-300 px-4 py-1 rounded-sm ">{{ $message }}</span>
@enderror

@If(isset($pizza))
<div class="my-3">
  <img class="max-w-[300px]" src="{{asset('storage/'. $pizza->image) }}" alt="{{ $pizza->name }}">
  <div class="mt-2">
    <input
        type="checkbox"
        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-500 checked:bg-gray-500 checked:before:bg-gray-500 hover:before:opacity-10"
        id="remove_image"
        name="remove_image"
        value="1"
      />
    <label class="text-sm font-medium text-gray-900 dark:text-white capitalize" for="remove_image">rimuovi immagine precedente</label>
  </div>
</div>
@endIf

<div class="mb-4">
  <label class="block text-gray-700 dark:text-white text-sm font-bold mb-2" for="price">
    <span class="text-[#C83B1A]">*</span> Prezzo
  </label>
  <input class="shadow appearance-none border dark:bg-slate-500  border-[#C83B1A] dark:text-white  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price" name="price" type="number" step="0.01" value="{{ isset($pizza) ? $pizza->price : old('price') }}">
  @error('price')
    <span class="text-red-500 text-sm bg-red-300 px-4 py-1 rounded-sm ">{{ $message }}</span>
  @enderror
</div>

<div class="mb-4">
  <label class="block text-gray-700 dark:text-white text-sm font-bold mb-2" for="price_single">
    Percentuale di sconto
  </label>
  
  <input class="shadow appearance-none  border-[#C83B1A] dark:bg-slate-500 dark:text-white rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="discount_percent" name="discount_percent" type="number" value="{{ isset($pizza) ? $pizza->discount_percent : old('discount_percent') }}">
  @error('discount_percent')
    <span class="text-red-500 text-sm bg-red-300 px-4 py-1 rounded-sm ">{{ $message }}</span>
  @enderror
</div>

<div class="mb-4 flex items-center dark:text-white">
  Disponibile
  <label
  class="relative flex items-center p-3 rounded-full cursor-pointer"
  for="available"
  data-ripple-dark="true"
  >
    <input
      type="checkbox"
      class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-500 checked:bg-gray-500 checked:before:bg-gray-500 hover:before:opacity-10"
      id="available"
      value="1"
      name="available"
      {{ isset($pizza) ?  ($pizza->available ? 'checked' : '') :  (old('available') ? 'checked' : '') }}
    />
    @error('available')
      <span class="text-red-500 text-sm bg-red-300 px-4 py-1 rounded-sm ">{{ $message }}</span>
    @enderror
</div> 
    
<div class="dark:text-white">
  <span class="text-[#C83B1A]">*</span>
  Descrizione
  <textarea
      class="peer h-full min-h-[100px] dark:bg-slate-500 border-[#C83B1A] w-full resize-none rounded-[7px] border border-blue-gray-200  bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"
      name="description"
    >{{ isset($pizza) ? $pizza->description : old('description') }}</textarea>
    @error('description')
      <span class="mt-0 text-red-500 text-sm bg-red-300 px-4 py-1 rounded-sm ">{{ $message }}</span>
    @enderror
</div>
