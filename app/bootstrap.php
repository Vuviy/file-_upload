<?php

use App\Container;
use App\DTO\MimeExtensionMap;
use App\Services\ClamAVVirusScanner;
use App\Services\FilenameGenerator;
use App\Services\FileStorage;
use App\Services\ImageProcessor;
use App\Services\UploadService;
use App\Strategy\ImageStrategy;
use App\Strategy\NoStrategy;
use App\Strategy\UploadProcessingStrategyResolver;
use App\Validators\ExtensionValidator;
use App\Validators\FileSizeValidator;
use App\Validators\FileUploadPreValidator;
use App\Validators\MimeTypeValidator;

$container = new Container();

$container->set(ImageProcessor::class, fn () => new ImageProcessor());

$container->set(ImageStrategy::class,
    fn ($c) => new ImageStrategy(
        $c->get(ImageProcessor::class)
    )
);

$container->set(NoStrategy::class, fn () => new NoStrategy());

$container->set(UploadProcessingStrategyResolver::class,
    fn ($c) => new UploadProcessingStrategyResolver([
        $c->get(ImageStrategy::class),
        $c->get(NoStrategy::class),
    ])
);

$container->set(FileUploadPreValidator::class, fn () => new FileUploadPreValidator());
$container->set(FileSizeValidator::class, fn () => new FileSizeValidator());
$container->set(MimeTypeValidator::class, fn () => new MimeTypeValidator());
$container->set(ExtensionValidator::class, fn () => new ExtensionValidator());
$container->set(MimeExtensionMap::class, fn () => new MimeExtensionMap());
$container->set(ClamAVVirusScanner::class, fn () => new ClamAVVirusScanner());
$container->set(FilenameGenerator::class, fn () => new FilenameGenerator());
$container->set(FileStorage::class, fn () => new FileStorage());

$container->set(UploadService::class,
    fn ($c) => new UploadService(
        $c->get(FileUploadPreValidator::class),
        $c->get(FileSizeValidator::class),
        $c->get(MimeTypeValidator::class),
        $c->get(ExtensionValidator::class),
        $c->get(MimeExtensionMap::class),
        $c->get(ClamAVVirusScanner::class),
        $c->get(FilenameGenerator::class),
        $c->get(FileStorage::class),
        $c->get(UploadProcessingStrategyResolver::class)
    )
);
