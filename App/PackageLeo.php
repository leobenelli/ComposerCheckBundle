<?php
namespace LeoBenelli\LBComposerCheckBundle\App;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Description of PackageLeo
 *
 * @author benelli
 */
class PackageLeo {

    private $name;
    private $version;
    private $latest;
    private $latestStatus;
    private $description;

    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setVersion($version) {
        $this->version = $version;
        return $this;
    }
    public function getVersion()
    {
        return $this->version;
    }

    public function setLatest($latest) {
        $this->latest = $latest;
        return $this;
    }
    public function getLatest()
    {
        return $this->latest;
    }

    public function setLatestStatus($latestStatus) {
        $this->latestStatus = $latestStatus;
        return $this;
    }
    public function getLatestStatus()
    {
        return $this->latestStatus;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }
    public function getDescription()
    {
        return $this->description;
    }

}
