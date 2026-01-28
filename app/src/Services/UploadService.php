<?php

namespace App\Services;

use App\DTO\MimeExtensionMap;
use App\DTO\UploadedFile;
use App\DTO\UploadResult;
use App\Strategy\UploadProcessingStrategyResolver;
use App\Validators\ExtensionValidator;
use App\Validators\FileSizeValidator;
use App\Validators\FileUploadPreValidator;
use App\Validators\MimeTypeValidator;

final readonly class UploadService
{
    public function __construct(
        private FileUploadPreValidator $uploadPreValidator,
        private FileSizeValidator $fileSizeValidator,
        private MimeTypeValidator $mimeTypeValidator,
        private ExtensionValidator $extensionValidator,
        private MimeExtensionMap $mimeExtensionMap,
        private ClamAVVirusScanner $virusScanner,
        private FilenameGenerator $filenameGenerator,
        private FileStorage $storage,
        private UploadProcessingStrategyResolver $processingStrategyResolver
    ){}

    public function upload(UploadedFile $file): UploadResult
    {
        $this->uploadPreValidator->assertValidUpload($file);
        $this->fileSizeValidator->validate($file);

        $mimeType = $this->mimeTypeValidator->validate($file);

        $extension = $this->extensionValidator->validate($file);

        $this->mimeExtensionMap->isMatching($mimeType, $extension);

        $this->virusScanner->scan(
            $file->getTemporaryPath()
        );

        $strategy = $this->processingStrategyResolver
            ->resolve($mimeType);

        $file = $strategy->process($file, $mimeType);

        $storagePath = $this->filenameGenerator->generate($file, $mimeType);

        $stored = $this->storage->store($file, $storagePath);

        return new UploadResult($storagePath->filename(), $mimeType, $stored->size());
    }
}