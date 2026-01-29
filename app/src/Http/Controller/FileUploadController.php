<?php

namespace App\Http\Controller;

use App\Container;
use App\DTO\UploadedFile;
use App\Request;
use App\Response;
use App\Services\UploadService;

final class FileUploadController
{
    private UploadService $uploadService;
    public function __construct(private Container $container)
    {
      $this->uploadService = $this->container->get(UploadService::class);
    }

    public function upload(Request $request): Response
    {
        $uploadedFile = UploadedFile::fromArray($request->file());
        $result = $this->uploadService->upload($uploadedFile);

        $pathToFile = 'http://cdn.mysitevuviy.com/files/' . $result->getFilename();
        return new Response($pathToFile, 200);
    }
}