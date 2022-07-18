<?php

namespace App\Http\Controllers;

use App\Models\FileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileManagerController extends Controller
{
    /**
     * @var string
     */
    private $original_file_extension;
    /**
     * @var string
     */
    private $original_file_name;
    /**
     * @var
     */
    private $original_file_type;
    /**
     * @var string
     */
    private $chunk_path = 'chunks';
    /**
     * @var
     */
    private $new_file_name;

    public function index()
    {
        $files = FileManager::where('user_id', auth()->id())->get();
        return response()->json($files);
    }

    public function store(Request $request)
    {
        $upload_finish = false;
        $file_manager = '';
        $file = $request->file('file');

        $this->original_file_name = $file->getClientOriginalName();
        $this->original_file_type = $file->getClientMimeType();
        // get real extension of the file
        $split_dot = explode('.', basename($this->original_file_name, '.part'));
        $this->original_file_extension = end($split_dot);

        $this->makeChunkDirectory();
        $path = Storage::disk('local')->path("{$this->chunk_path}/{$this->original_file_name}");

        File::append($path, $file->get());

        if ($request->has('is_last') && $request->boolean('is_last')) {
            $random_string = Str::random(24);
            $this->new_file_name = $random_string . '.' . $this->original_file_extension;
            File::move($path, storage_path("app/public/{$this->new_file_name}"));
            $upload_finish = true;
            $file_manager = $this->saveFileManager();
        }

        return response()->json(['uploaded' => true, 'is_finished' => $upload_finish, 'file_manager' => $file_manager]);
    }

    private function saveFileManager()
    {
        $storage = Storage::disk('public');
        $file_manager = new FileManager();
        $file_manager->name = basename($this->original_file_name, '.part');
        $file_manager->type = $this->original_file_type;
        $file_manager->size = $storage->getSize($this->new_file_name);
        $file_manager->path = $storage->url($this->new_file_name);
        $file_manager->thumbnail = $this->generateThumbnail($storage);
        $file_manager->save();
        return $file_manager;
    }

    private function generateThumbnail($storage)
    {

        switch ($this->original_file_type) {
            case Str::startsWith($this->original_file_type, 'image/'):
                return $storage->url($this->new_file_name);

            case Str::startsWith($this->original_file_type, 'video/'):
                return 'hello_world';
            default:
                return '';
        }
        // TODO : file wise thumbnail setter
    }

    private function makeChunkDirectory()
    {
        Storage::makeDirectory($this->chunk_path);
    }
}
