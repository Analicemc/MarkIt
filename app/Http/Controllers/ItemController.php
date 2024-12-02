<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use Exception;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);

        if ($request->hasFile('image')) {
            $validatedData['image_path'] = $this->uploadImage($request->file('image'));
        }
        
        $item = Item::create($validatedData);
        
        return response()->json($item, 201);
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:500',
            'attachment_required' => 'required|in:' . implode(',', Item::AVAILABLE_OPTIONS),
            'observation_required' => 'required|in:' . implode(',', Item::AVAILABLE_OPTIONS),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'orientation' => 'nullable|string',
            'active' => 'required|in:' . implode(',', Item::AVAILABLE_OPTIONS),
            'user_id' => 'required|exists:users,id'
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'attachment_required.in' => 'O campo attachment_required deve ser "T" ou "F".',
            'observation_required.in' => 'O campo observation_required deve ser "T" ou "F".',
            'image.image' => 'O arquivo enviado deve ser uma imagem.',
            'image.mimes' => 'A imagem deve estar no formato: jpeg, png, jpg ou gif.',
            'user_id.exists' => 'O ID do usuário informado não existe.'
        ]);
    }
    private function uploadImage($image)
    {
        return $image->store('items', ['public', 'images']);
    }
}
