<?php

namespace App\Http\Controllers;

use App\Enums\ImportType;
use Illuminate\Contracts\View\View;

class ImportController extends Controller
{
    public function create(): View
    {
        return view('imports.create', [
            'importTypes' => ImportType::toArray()
        ]);
    }


    public function store(ImportStoreRequest $request)
    {
        $fileName = $request->file('file')->store('import-files');

        /** @var ImportModel $importModel */
        $importModel = ImportModel::query()->create([
            'uploader_id' => auth()->id(),
            'file_name'   => $fileName,
            'import_type' => $request->input('importType'),
            'status'      => ImportStatus::default()
        ]);

        event(new ImportCreated($importModel));


        dd('okkk');
    }
}
