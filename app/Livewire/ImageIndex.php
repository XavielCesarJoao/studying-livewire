<?php

namespace App\Livewire;

use App\Models\Image;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ImageIndex extends Component
{
    use WithFileUploads;

    #[Rule('required')]
    #[Rule(['photos.*' => 'required|image|max:1024'])]
    public $photos = [];


    public function render()
    {
        return view('livewire.image-index')->layout('layouts.app');
    }

    public function save()
    {
        $images = [];
        $this->validate();
        if (!is_null($this->photos)) {
            foreach ($this->photos as $photo) {
                $name = $photo->hashName();
                $path = $photo->storeAs('images', $name, 'public');
                $images[] = ['name' => $name, 'path' => $path];
            }

           foreach ($images as $image){
               Image::create($image);
           }

        }
        $this->reset();
    }

    #[Computed(persist: true)]
    public function images()
    {
        return Image::all();
    }

    public function download($id)
    {
        $image = Image::find($id);
       // return Storage::disk('public')->download($image->path, 'image.png');
        return response()->download(storage_path('app/public/'. $image->path), 'image.png');
    }

}
