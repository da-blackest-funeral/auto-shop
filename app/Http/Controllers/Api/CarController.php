<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CarController extends Controller
{
    protected $request;

    protected $validatedRequest;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->validatedRequest = $this->validateRequest() ?? [];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse {
        return response()->json(Car::with('autoparts')->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(): \Illuminate\Http\JsonResponse {
        $car = Car::create([
            'model' => $this->validatedRequest['model'],
            'brand' => $this->validatedRequest['brand']
        ]);

        return response()->json($car);
    }

    /**
     * Display the specified resource.
     *
     * @param Car $car
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Car $car): \Illuminate\Http\JsonResponse {
        return response()->json($car->load('autoparts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Car $car
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Car $car): \Illuminate\Http\JsonResponse {
        $car->update($this->validatedRequest);
        $car->autoparts()->sync($request->input('autoparts'));

        return response()->json($car->load('autoparts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Car $car
     * @return Response
     */
    public function destroy(Car $car): Response {
        $car->delete();
        return response(null, ResponseAlias::HTTP_NO_CONTENT);
    }

    protected function validateRequest() {
        if ($this->request->method() == 'POST') {
            return $this->request->validate([
                'model' => 'required',
                'brand' => 'required'
            ]);
        }
    }
}
