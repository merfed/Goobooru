<?php

namespace App\Console\Commands;

use Image;
use App\Booru;
use Illuminate\Console\Command;

class BulkUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'goo:bulk-upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process a directory for bulk uploads.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files = glob(public_path('import/*.{'. config('goobooru.allowed_filetypes') .'}'), GLOB_BRACE);
        $files = array_map('basename', $files);

        foreach ($files as $file) {
            $slug = str_random(32);
            $ext = pathinfo(public_path('import/'. $file), PATHINFO_EXTENSION);
            $path = public_path(config('goobooru.upload_path'));
            $thumbnail_path = public_path(config('goobooru.upload_path_thumb'));
            $original = Image::make(public_path('import/'. $file));
            $thumbnail = Image::make(public_path('import/'. $file));
            $thumbnail->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $name = $slug .'.'. $ext;
            $thumbnail_name = 'thumb_'. $slug .'.'. $ext;

            $original->save($path . $name);
            $thumbnail->save($thumbnail_path . $thumbnail_name);

            // copy(public_path('import/'. $file), public_path('uploads/'. $name));
            // rename(public_path('import/'. $file), public_path('thumbnails/'. $thumbnail_name));

            unlink(public_path('import/'. $file));


            // $ext = pathinfo(public_path('uploads/'. $file), PATHINFO_EXTENSION);
            // $name = str_random(32) .'.'. $ext;

            // rename(public_path('import/'. $file), public_path('uploads/'. $name));

            Booru::create([
                'image' => $name,
                'uploader_id' => 0
            ]);
        }

        $this->info('Imported '. number_format(count($files)) .' files into the booru.');
    }
}
