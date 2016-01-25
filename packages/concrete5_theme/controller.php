<?php

namespace Concrete\Package\Concrete5Theme;

use Concrete\Core\Asset\AssetList;
use Concrete\Core\Backup\ContentImporter;
use Concrete\Core\Foundation\Service\ProviderList;
use Concrete\Core\Job\Job;
use Concrete\Core\Routing\Redirect;
use Concrete\Core\Support\Facade\Route;
use Concrete\Package\Concrete5Docs\Page\Relater;
use Concrete\Package\Concrete5Docs\User\UserInfo;
use Package;
use Page;
use Concrete\Core\Block\BlockType\BlockType;
use PortlandLabs\Concrete5\Documentation\Migration\Publisher\Block\MarkdownPublisher;
use SinglePage;
use \Concrete\Core\Page\Theme\Theme;

class Controller extends Package
{

    protected $pkgHandle = 'concrete5_theme';
    protected $appVersionRequired = '5.7.5';
    protected $pkgVersion = '0.75';
    protected $pkgAutoloaderMapCoreExtensions = true;
    protected $pkgAutoloaderRegistries = array(
        'src/PortlandLabs' => '\PortlandLabs'
    );
    protected $pkgAllowsFullContentSwap = true;


    public function getPackageDescription()
    {
        return t("concrete5.org theme.");
    }

    public function getPackageName()
    {
        return t("concrete5.org theme");
    }

}
