<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Discussion;
use App\Models\Product;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Resources\Api\Settings\ImageResource;
use App\Http\Resources\Api\Products\ProductsResource;
use App\Http\Resources\Api\TraningResource;
use App\Http\Resources\Api\DiscussionResource;
use App\Http\Resources\Api\DoctorsResource;
use App\Traits\ResponseTrait;

class HomeController extends Controller
{
    use ResponseTrait;
    public function show()
    {
        $user = auth()->user();
        $announcements = ImageResource::collection(Image::latest()->get());
        $products = ProductsResource::collection(Product::with([
            'pictures',
            'productType',
        ])->paginate($this->paginateNum()));
        $trainings = TraningResource::collection(Training::with(['product','product.pictures'])->paginate($this->paginateNum()));
        $discussion = DiscussionResource::collection(Discussion::latest()->paginate($this->paginateNum()));
        return $this->successData(['doctor' => new DoctorsResource($user->refresh()),
                                   'is_profile_complete' => auth()->user()->isProfileComplete(),
                                   'notifications'       => $announcements,
                                   'products'            => $products,
                                   'trainings'           => $trainings,
                                   'discussion'          => $discussion,
                                ]);

    }
}
