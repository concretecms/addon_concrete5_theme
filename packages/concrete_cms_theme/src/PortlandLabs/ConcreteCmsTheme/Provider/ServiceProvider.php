<?php

/**
 * @project:   ConcreteCMS Theme
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

namespace PortlandLabs\ConcreteCmsTheme\Provider;

use Concrete\Core\Application\Application;
use Concrete\Core\Foundation\Service\Provider;
use Concrete\Core\Html\Service\Navigation;
use Concrete\Core\Http\Response;
use Concrete\Core\Http\ResponseFactory;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Theme\ThemeRouteCollection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ServiceProvider extends Provider
{
    protected $eventDispatcher;
    protected $responseFactory;
    protected $navigationHelper;

    public function __construct(
        Application $app,
        EventDispatcherInterface $eventDispatcher,
        ResponseFactory $responseFactory,
        Navigation $navigationHelper
    )
    {
        parent::__construct($app);

        $this->eventDispatcher = $eventDispatcher;
        $this->responseFactory = $responseFactory;
        $this->navigationHelper = $navigationHelper;
    }

    public function register()
    {
        $this->registerPageSelectorRedirect();
    }

    private function registerPageSelectorRedirect()
    {
        $this->eventDispatcher->addListener('on_before_render', function () {
            $page = Page::getCurrentPage();

            if ($page instanceof Page && !$page->isError()) {
                $targetPageId = (int)$page->getAttribute('page_selector_redirect');

                if ($targetPageId > 0) {
                    $targetPage = Page::getByID($targetPageId);

                    if ($targetPage instanceof Page && !$targetPage->isError()) {
                        if ($targetPage->isExternalLink()) {
                            $targetPageUrl = $targetPage->getCollectionPointerExternalLink();
                        } else {
                            /** @noinspection PhpParamsInspection */
                            $targetPageUrl = $this->navigationHelper->getLinkToCollection($targetPage);
                        }

                        $this->responseFactory->redirect($targetPageUrl, Response::HTTP_TEMPORARY_REDIRECT)->send();
                        $this->app->shutdown();
                    }
                }
            }
        });
    }
}