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
class ComposerLeo {
// https://getcomposer.org/doc/03-cli.md#outdated
// https://semver.mwl.be/#?package=madewithlove%2Felasticsearcher&version=0.2.1&minimum-stability=stable
    private $packages = array();

    public function test() {
        var_dump('TEST');
    }

    public function load() {


       $builder = new ProcessBuilder();
       $builder->setPrefix('composer');
       $builder->setArguments(array('show', '-l' , '--format=json', '--working-dir=..'));
       $process = $builder->getProcess();

       $process->run();
/*
$process->run(function ($type, $buffer) {
    if (Process::ERR === $type) {
        var_dump( 'ERR > '.$buffer);
    } else {
        var_dump( 'OUT > '.$buffer);
    }
});
*/
//       var_dump( $process->getErrorOutput());
//
       // Trasformo il json di ritorno in Array
       $packagesFromJson = json_decode($process->getOutput(), true);
//       var_dump($packagesFromJson);
       $packagesInstalled = $packagesFromJson['installed'];
//       var_dump($packagesInstalled);
       foreach ($packagesInstalled as $packageInstalled) {
           $package = new PackageLeo();
           $package->setName($packageInstalled['name']);
           $package->setVersion($packageInstalled['version']);
           $package->setLatest($packageInstalled['latest']);
           $package->setLatestStatus($packageInstalled['latest-status']);
           $package->setDescription($packageInstalled['description']);

           $this->packages[] = $package;
       }

//       var_dump($packages);
//       var_dump( $process->getOutput());
    }

    public function getInstalledPackages() {
        return $this->packages;
    }

}
