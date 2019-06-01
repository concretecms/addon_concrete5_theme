<?php

namespace Concrete\Package\Concrete5Theme;

use Concrete\Core\Backup\ContentImporter;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Theme\Theme;

class Controller extends Package
{

    protected $pkgHandle = 'concrete5_theme';
    protected $appVersionRequired = '5.7.5';
    protected $pkgVersion = '0.76';
    protected $pkgAutoloaderMapCoreExtensions = true;
    protected $pkgAutoloaderRegistries = array(
        'src' => '\PortlandLabs\Theme'
    );

    public function getPackageDescription()
    {
        return t("concrete5.org theme.");
    }

    public function getPackageName()
    {
        return t("concrete5.org theme");
    }

    public function install()
    {
        $pkg = Parent::install();
        $pkg->updateInstall();
    }

    public function update()
    {
        parent::update();
        $pkg = Package::getByHandle($this->pkgHandle);
        $pkg->updateInstall();
    }

    public function updateInstall()
    {
        if (!Theme::getByHandle('concrete5')) {
            Theme::add('concrete5', $this);
        }
    }

}
