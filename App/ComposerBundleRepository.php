<?php
namespace LeoBenelli\LBComposerCheckBundle\App;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Description of ComposerLeo
 *
 * @author benelli
 */
class ComposerBundleRepository {

    // Array dei packages installati
    private $packages = array();

    /**
     * Funzione di caricamento via composer
     */
    public function load() {

       $builder = new ProcessBuilder();
       $builder->setPrefix('composer');
       $builder->setArguments(array('show', '-l' , '--format=json', '--working-dir=..'));
       $process = $builder->getProcess();

       $process->run();

       // Trasformo il json di ritorno in Array
       $packagesFromJson = json_decode($process->getOutput(), true);

       // Recupero i pacchetti installati
       $packagesInstalled = $packagesFromJson['installed'];

       // Scorro e riempio l'array dei package
       foreach ($packagesInstalled as $packageInstalled) {
           $package = ComposerPackage::createByArray($packageInstalled);

//           $package = new ComposerPackage();
//           $package->setName($packageInstalled['name']);
//           $package->setVersion($packageInstalled['version']);
//           $package->setLatest($packageInstalled['latest']);
//           $package->setLatestStatus($packageInstalled['latest-status']);
//           $package->setDescription($packageInstalled['description']);

           $this->packages[] = $package;
        }
 
        //$package = ComposerPackage::createByPackageName('doctrine/orm');
        
    }
    
    /**
     * Restituisce le informazioni dei packages installati via composer
     * @return array Array dei packages
     */
    public function getInstalledPackages() {
        return $this->packages;
    }

}
