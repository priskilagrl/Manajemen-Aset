<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Http\Resources\AssetResource;
use App\Models\Kategori;
use App\Models\Status;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = AssetResource::collection(
         Asset::orderBy(request('column') ? request('column') : 'updated_at', request('direction') ? request('direction') : 'desc')->paginate(50)
        );

        return response()->json($assets, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetRequest $request)
    {
        $uniqueNumber = uniqid();
        $uuid = Str::uuid();
        $input = $request->validated();
        $asset = new Asset();
        $asset->kode = 'AST-' . $uniqueNumber;
        $asset->uuid = $uuid;
        $asset->name = $input['name'];
        $asset->description = $input['deskripsi'];

        if (!is_null($input['image'])) {
            $image = Storage::put('public/images/Asset', $request->file('image'));
            $asset->image = $image;
        }
        $asset->save();
        $category = Kategori::find($input['kategori']);
        $status = Status::find($input['status']);
        $asset->kategori()->attach($category);
        $asset->statusAset()->attach($status);

        return response()->json(['status' => 'Asset Berhasil Ditambahkan !'], 201);
        // return response()->json([$input], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        $assets = AssetResource::make($asset);
        return response()->json($assets, 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssetRequest  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        //
    }
}
