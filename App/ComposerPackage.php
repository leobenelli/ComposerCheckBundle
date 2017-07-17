<?php
namespace LeoBenelli\LBComposerCheckBundle\App;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\ProcessBuilder;


/**
 * Oggetto Package 
 *
 * @author benelli
 */
class ComposerPackage {

    private $name;
    private $version;
    private $latest;
    private $latestStatus;
    private $description;

    public function __construct() {
    }

    public static function createByArray( $packageArray ) {
        $instance = new self();

        $instance->setName($packageArray['name']);
        $instance->setVersion($packageArray['version']);
        $instance->setLatest($packageArray['latest']);
        $instance->setLatestStatus($packageArray['latest-status']);
        $instance->setDescription($packageArray['description']);

        return $instance;
    }

    public static function createByPackageName( $packageName ) {
        $instance = new self();
        $instance->setName($packageName);
        $instance->setVersion('package_version');
        $instance->setLatest('package_latest');
        $instance->setLatestStatus('package_latest-status');
        $instance->setDescription('package_description');

        $builder = new ProcessBuilder();
        $builder->setPrefix('composer');
        $builder->setArguments(array('show', $packageName, '--working-dir=..'));
        $process = $builder->getProcess();

        $process->run();

        $instance->setDescription(nl2br($process->getOutput()));


        return $instance;
    }

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
