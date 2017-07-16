<?php

namespace LeoBenelli\LBComposerCheckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use LeoBenelli\LBComposerCheckBundle\App\ComposerLeo;

class DefaultController extends Controller
{
    /**
     * @Route("/LB/")
     */
    public function indexAction()
    {
        ini_set('xdebug.var_display_max_depth', 5);
        ini_set('xdebug.var_display_max_children', 256);
        ini_set('xdebug.var_display_max_data', 100000);

        $cl = new ComposerLeo();

        $cl->load();

        $installedPackages = $cl->getInstalledPackages();


        
//        var_dump($installedPackages);
//        var_dump('test-controller');
/*
   // Metodo 1

       $process = new Process('composer show -l --format json --working-dir=..');
       $process->run();



       // executes after the command finishes
       if (!$process->isSuccessful()) {
           echo $process->getErrorOutput();
           throw new ProcessFailedException($process);
       }
        var_dump($process->getOutput());

       // Metodo 2

       $builder = new ProcessBuilder(array('composer', 'show -l --format json --working-dir=..'));
       $builder->getProcess()->run();
*/
/* OKOKOK
       // Metodo 3
       $builder = new ProcessBuilder();
       $builder->setPrefix('composer');
//            ->setArguments(array('show', '--format json', '--working-dir=..'))
       var_dump( $builder
           ->setArguments(array('show', '-l', '--working-dir=..', '--format=json'))
           ->getProcess()
           ->getCommandLine() );

       $process = $builder->getProcess();
//       $process->run();

$process->run(function ($type, $buffer) {
    if (Process::ERR === $type) {
        var_dump( 'ERR > '.$buffer);
    } else {
        var_dump( 'OUT > '.$buffer);
    }
});
       var_dump( $process->getErrorOutput());

       var_dump( $process->getOutput());

*/
       // return $this->render('LBComposerCheckBundle:Default:index.html.twig');
        
        return $this->render('LBComposerCheckBundle:Default:index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'packages' => $installedPackages,
        ]);
          
         
    }
}
