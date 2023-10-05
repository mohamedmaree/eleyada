<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CertificateRequest;
use App\Models\Certificate;
use App\Services\Image;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseTrait;
use App\Http\Resources\Api\CertificateResource;

class CertificateController extends Controller
{
    use ResponseTrait;

    public function index(): JsonResponse
    {
        $certificates = CertificateResource::collection(auth()->user()->certificates);
        return $this->successData($certificates);
    }

    public function store(CertificateRequest $request): JsonResponse
    {
        if($request->file('images')){
            foreach ($request->file('images') as $image) {
                auth()->user()->certificates()->create([
                    'image' => $image
                ]);
            }
        }
        return $this->successMsg(__('apis.added'));
    }

    public function update(CertificateRequest $request, Certificate $certificate): JsonResponse
    {
        $certificate->delete();
        if($request->file('images')){
            foreach ($request->file('images') as $image) {
                auth()->user()->certificates()->create([
                    'image' => $image
                ]);
            }
        }
        return $this->successMsg(__('apis.updated'));
    }

    public function destroy(Certificate $certificate): JsonResponse
    {
        $certificate->delete();
        return $this->successMsg(__('apis.deleted'));
    }
}
