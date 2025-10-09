<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\LogoModel;
use App\Models\NewsModel;
use App\Models\ProgramModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];
    protected $data = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');

        $logo_model = new LogoModel();
        $about_model = new AboutModel();
        $news_model = new NewsModel();
        $program_model = new ProgramModel();
        $about_us = $about_model->findAll();
        $allLogos = $logo_model->findAll();
        $popularNews = $news_model->getPopularNewsFooter();
        $popularProgram = $program_model->getPopularProgramsFooter();

        $this->data['about'] = $about_us;
        if (!empty($allLogos)) {
            $this->data['logo'] = $allLogos;
            $this->data['popularNews'] = $popularNews;
            $this->data['popularProgram'] = $popularProgram;

        }
    }

    // A property to hold data common to all views using the layout


    /**
     * Renders a view with common layout data.
     * This custom render method will automatically merge the base controller data.
     *
     * @param string $viewName
     * @param array $data 
     * @return string
     */
    protected function render(string $viewName, array $data = []): string
    {
        // Merge controller-specific data with base layout data
        $mergedData = array_merge($this->data, $data);
        return view($viewName, $mergedData);
    }
}
