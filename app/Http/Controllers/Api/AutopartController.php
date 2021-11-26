<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Autopart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AutopartController extends Controller
{
    protected $request;

    protected $validatedRequest;

    protected $requestValues;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->validatedRequest = $this->validateRequest() ?? [];
        $this->requestValues = $this->setRequestValues();
    }

    /**
     * Display a listing of the resource
     */
    public function index() {
        return response()->json(
            Autopart::with('attributes')
                ->paginate(50)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(): \Illuminate\Http\JsonResponse {
        $attributes = $this->makeAutopartAttributes();

        $validatedFields = $this->validatedRequest;

        $autopart = Autopart::create([
            'name' => $validatedFields['name'],
            'price' => $validatedFields['price'],
            'article' => $validatedFields['article'] ?? 'Артикул не задан.',
            'category_id' => $validatedFields['category_id'],
        ]);

        $autopart->attributes()->saveMany($attributes);

        return response()->json($autopart->load('attributes'));
    }

    /**
     * Display the specified resource.
     *
     * @param Autopart $autopart
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Autopart $autopart): \Illuminate\Http\JsonResponse {
        return response()->json(
            $autopart->load('attributes')
        );
    }

    /**
     * Update the specified resource in storage
     *
     * @param Autopart $autopart
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Autopart $autopart) {
        $autopart->update($this->validatedRequest);

        $attributes = $this->makeAutopartAttributes($autopart->id);
        $attributesArray = $this->convertToArray($attributes, $autopart->id);

        $autopart->attributes()->upsert($attributesArray, ['id']);

        return response()->json($autopart->load('attributes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Autopart $autopart
     * @return Response
     */
    public function destroy(Autopart $autopart): Response {
        $autopart->delete();
        return response('Удалено', ResponseAlias::HTTP_NO_CONTENT);
    }

    /**
     * @param $autopartId
     * @return array
     */
    protected function makeAutopartAttributes($autopartId): array {
        $attributes = [];
        foreach ($this->requestValues as $title => $value) {
            $attribute = Attribute::firstOrCreate([
                'title' => $title,
                'value' => $value,
                'autopart_id' => $autopartId,
            ]);

            $attributes[] = $attribute;
        }

        return $attributes;
    }

    protected function convertToArray($attributes, $autopartId) {
        $result = [];
        foreach ($attributes as $attribute) {
            $result[] = [
                'id' => $attribute->id,
                'title' => $attribute->title,
                'value' => $attribute->value,
                'autopart_id' => $autopartId
            ];
        }

        return $result;
    }

    /**
     * @return array
     */
    protected function setRequestValues(): array {
        $requestValues = [];
        if (
            $this->request->input('attributenames') !== null &&
            $this->request->input('attributevalues') !== null
        ) {
            $requestValues = array_combine(
                $this->request->input('attributenames'),
                $this->request->input('attributevalues')
            );
        }

        return $requestValues;
    }

//    /**
//     * @param $attributes
//     * @return array
//     */
//    protected function getAttributesIds($attributes): array {
//        $Ids = [];
//        foreach ($attributes as $attribute) {
//            $Ids[] = $attribute->id;
//        }
//
//        return $Ids;
//    }

    protected function validateRequest() {
        if ($this->request->method() === 'POST') {
            return $this->request->validate([
                'name' => 'required',
                'price' => 'required',
                'article' => '',
                'category_id' => 'required',
            ]);
        }
    }
}
