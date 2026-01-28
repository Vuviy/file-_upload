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
    public function __construct()
    {
        $container = new Container();
        $this->uploadService = $container->get(UploadService::class);
    }

    public function upload(Request $request): Response
    {
        $uploadedFile = UploadedFile::fromArray($request->file());

        $result = $this->uploadService->upload($uploadedFile);

        return new Response($result->getFilename());
    }
}