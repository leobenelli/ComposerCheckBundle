<?php

namespace LeoBenelli\LBComposerCheckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use LeoBenelli\LBComposerCheckBundle\App\ComposerPackage;
use LeoBenelli\LBComposerCheckBundle\App\ComposerBundleRepository;

/**
 * @Route("/lb_composer_check_bundle")
 * 
 * @link http://localhost:8000/lb_composer_check_bundle/show_pkgs/ ComposerBundlesVersion
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/show_pkgs", name="leobenelli_lbcomposercheck_default_showpackages")
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

    /**
     * @Route("/detail_pkg_content_modal", name="leobenelli_lbcomposercheck_default_detailpackage")
     */
    public function detailPackageAction(Request $request) {
        $packageParam = $request->query->get('package');
        $package = ComposerPackage::createByPackageName($packageParam);

        $detailContentHeader = '';
        $detailContentHeader = $detailContentHeader . '<div class="modal-header">';
        $detailContentHeader = $detailContentHeader . '<h4 class="modal-title" id="myModalLabel">'.$package->getName().'</h4>';
        $detailContentHeader = $detailContentHeader . '</div>';

        $detailContentBody = '';
        $detailContentBody = $detailContentBody . '<div class="modal-body">';
        $detailContentBody = $detailContentBody . $package->getDescription();
        $detailContentBody = $detailContentBody . '</div>';

        $detailContentFooter = '';
        $detailContentFooter = $detailContentFooter . '<div class="modal-footer">';
        $detailContentFooter = $detailContentFooter . '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
        $detailContentFooter = $detailContentFooter . '</div>';

        $detailContent = $detailContentHeader . $detailContentBody . $detailContentFooter;
        return new Response($detailContent);

    }

}
