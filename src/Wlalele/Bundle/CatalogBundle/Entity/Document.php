<?php

namespace Wlalele\Bundle\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Document
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Wlalele\Bundle\CatalogBundle\Entity\DocumentRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Document
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\File $file
     * @internal param $File
     */
    public function setFile(File $file)
    {
        $this->file = $file;
        $this->path = 'test';
    }

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Document
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return Document
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            $this->path = uniqid().'.'.$this->file->guessExtension();
            $this->filename = $this->file->getClientOriginalName();
        }
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    private function getUploadDir()
    {
        return realpath(__DIR__.'/../../../../../web/upload/');
    }

    public function getAbsolutePath()
    {
        return $this->getUploadDir().'/'.$this->getPath();
    }

    /**
     * @ORM\PostPersist
     * @ORM\PostUpdate
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadDir(), $this->path);
            unset($this->file);
        }
    }

    /**
     * @ORM\PostRemove
     */
    public function remove()
    {
        if (file_exists($this->getAbsolutePath())) {
            unlink($this->getAbsolutePath());
        }
    }
}
