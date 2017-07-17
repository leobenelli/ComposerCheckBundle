<?php

namespace LeoBenelli\LBComposerCheckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use LeoBenelli\LBComposerCheckBundle\App\ComposerBundleRepository;

/**
 * @Route("/lb_composer_check_bundle")
 * 
 * @link http://localhost:8000/lb_composer_check_bundle/show_pkgs/ ComposerBundlesVersion
 */
class DefaultController extends Controller
{
    /**
     * @Route("/show_pkgs/")
     */
    public function showPackagesAction()
    {
        /*
        ini_set('xdebug.var_display_max_depth', 5);
        ini_set('xdebug.var_display_max_children', 256);
        ini_set('xdebug.var_display_max_data', 100000);
        */
        $cbr= new ComposerBundleRepository();

        // Recupero le informazioni via composer
        $cbr->load();

        // Prendo i packages installati
        $installedPackages = $cbr->getInstalledPackages();
        
        return $this->render('LBComposerCheckBundle:Default:index.html.twig', [
            'packages' => $installedPackages,
        ]);
          
         
    }
}
