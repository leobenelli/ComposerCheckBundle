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
       // Un'alternativa potrebbe essere di leggere una variabile di ambiente impostata poi su httpd.conf: 
       /*
        * <Directory "/opt/rh/httpd24/root/var/www/html/crwD/web">
        * Options All
        *   AllowOverride All
        *   Require all granted
        *   Options Indexes FollowSymLinks
        *   SetEnv LB_COMPOSER_HOME /tmp    <------
        * </Directory>
        */
       // Tolto tutto e scelta la strada di mettere la variabile globale per far funzionare composer_home
       // $builder->setEnv('COMPOSER_HOME', getenv('LB_COMPOSER_HOME') );

//       $builder->setEnv('COMPOSER_HOME', '..' );

       $builder->setPrefix('composer');
       $builder->setArguments(array('show', '-l' , '--format=json', '--working-dir=..'));
       $process = $builder->getProcess();
       $process->setTimeout(120); // Timeout a 120 secondi 

       $process->run();
       
       // TODO: Occorre gestire il caso di errore es. COMPOSER_HOME non settata che dava in produzione di apache
       /*
        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo 'ERR > '.$buffer;
            } else {
                echo 'OUT > '.$buffer;
            }
        });
        */

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
