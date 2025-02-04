<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storage\StorageCreateRequest;
use App\Http\Requests\Storage\StorageUpdateRequest;
use App\Models\Storage;
use App\Models\User;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function index()
    {
        $storages = Storage::orderBy('id', 'desc')->paginate(10);
        $users = User::all();
        return view('pages.Storage.storage-index', ['models' => $storages, 'users' => $users]);
    }

    public function store(StorageCreateRequest $request)
    {
        $data = $request->all();

        $storage = Storage::create($data);
        return back();
    }

    public function update(StorageUpdateRequest $request, Storage $storage)
    {
        $data = $request->all();

        $storage->update($data);
        return back();
    }

    public function delete(Storage $storage)
    {
        $storage->delete();
        return back();
    }

    public function status(Storage $storage)
    {
        if ($storage->status == 1) {
            $storage->status = 0;
            $storage->save();
        } elseif ($storage->status == 0) {
            $storage->status = 1;
            $storage->save();
        }
        return back();
    }
}
