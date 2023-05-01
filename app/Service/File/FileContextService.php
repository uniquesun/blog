<?php

namespace App\Service\File;

class FileContextService
{
    protected $uploader;

    public function setStrategy(UploaderInterface $uploader): static
    {
        $this->uploader = $uploader;
        return $this;
    }

    public function upload($file)
    {
        return $this->uploader->upload($file);
    }

}