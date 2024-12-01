<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Log;


class PropertyController extends Controller
{


    public function index()
    {
        $properties = Property::all();
        return response()->json($properties);
    }


    public function store(Request $request)
    {
    
        Property::create([
            
            'type' => $request->type,
            'address' => $request->address,
            'size' => $request->size,
            'bedrooms' => $request->bedrooms,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'price' => $request->price,
        ]);
        
        return response()->json(['message' => 'Property added successfully!'], 201);
    }


    public function search(Request $request)
    {
        $query = Property::query();

        // Filter by type
        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

            // Filter by number of bedrooms
        if ($request->has('bedrooms') && $request->bedrooms) {
            $query->where('bedrooms', '>=', $request->bedrooms);
        }

            // Filter by price
        if ($request->has('price') && $request->price) {
            $query->where('price', '<=', $request->price); 
        }

        if ($request->has('size') && $request->size) {
            $query->where('size', '>=', $request->size); 
        }

        
        // Filter by area 
        if ($request->has('latitude') && $request->has('longitude') && $request->has('radius')) {
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $radius = $request->radius;

            $query->selectRaw("
                id, type, address, latitude, longitude, price, bedrooms, size,
                (6371 * acos(cos(radians(?)) * cos(radians(latitude)) 
                * cos(radians(longitude) - radians(?)) + sin(radians(?)) 
                * sin(radians(latitude)))) AS distance
            ", [$latitude, $longitude, $latitude])
            ->having('distance', '<=', $radius)
            ->orderBy('distance', 'asc');
        }

        
        return response()->json($query->get());
    }

    
}
