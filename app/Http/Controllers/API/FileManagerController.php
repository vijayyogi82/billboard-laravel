<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Document;
use DB;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use App\Models\Expenses;

class FileManagerController extends Controller
{
    public function mobileUpload(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'files' => 'required|array',
                'files.*.base64' => 'required|string',
                'files.*.image_type' => 'required|string',
                'files.*.type' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $requestArr = $validator->validated();

            $result = [];

            if (isset($requestArr['files'])) {
                $counter = 1;
                foreach ($requestArr['files'] as $file) {
                    $folder_path = '';
                    if($file['type'] == '1')
                    {
                        $folder_path = 'user';
                    }
                    else if($file['type'] == '2')
                    {
                        $folder_path = 'campaign';
                    }
                    $fileData = explode('base64,', $file['base64']);
                    if(isset($fileData[1]))
                    {
                        $file_base64 = base64_decode($fileData[1]);
                        $fileName = 'billboard_'.$counter.now()->timestamp.'.' . $file['image_type'];
                        $filepath = 'images/' . $folder_path . '/' . $fileName;
                        $path = Storage::put($filepath, $file_base64);
                        $url = Storage::disk('public')->url('app/'.$filepath);
                        $result[] = Document::create([
                            'file' => [
                                'path' => $path,
                                'url' => $url,
                                'name' => $fileName
                            ],
                            'type' => $file['type'],
                            'remarks' => isset($file['remarks']) ? $file['remarks'] : null,
                            'added_at' => now()->format('Y-m-d H:i:s'),
                            'added_by' => (int)$request->session()->get('user_id')
                        ]);
                    }
                    $counter++;
                }
            }

            return $this->success($result, "Files Uploaded Successfully.", 200);

        } catch (FileNotFoundException $err) {
            return $this->error("Something went wrong. Please try again later.", 404);
        } catch (Exception $err) {
            dd($err);
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $validator = Validator::make($request->route()->parameters(), [
                'id' => 'required|integer|exists:documents'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            DB::beginTransaction();
            $documents = Document::where('id', (int)$request->route('id'))->firstOrFail();
            if ($documents->file && isset($documents->file['path'])) {
                Storage::delete($documents->file['path']);
            }
            $documents->delete();
            DB::commit();
            return $this->success($documents, "File Deleted Successfully.", 200);
        } catch (ModelNotFoundException $err) {
            return $this->error('File not found', 404);
        } catch (FileNotFoundException $err) {
            return $this->error("Something went wrong. Please try again later.", 404);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }
}
