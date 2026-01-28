<?php

namespace App\Http\Controller;

use App\FileResolver;
use App\FileResponse;
use App\Request;
use App\Response;
use App\Services\MimeTypeDetector;
use App\View;

final class FileDownloadController
{
    private FileResolver $fileResolver;

    public function __construct()
    {
        $this->fileResolver = new FileResolver();
    }

    public function download(Request $request): Response
    {
        $path = $request->params('filename');

        try {
            $file = $this->fileResolver->resolve($path);
        } catch (\Exception $exception) {
            return new Response(View::make('404'));
        }

        return new FileResponse($file, $file->mime());
    }
}