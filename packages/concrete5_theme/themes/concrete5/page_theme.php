<?php

namespace Concrete\Package\Concrete5Theme\Theme\Concrete5;

use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;

class PageTheme extends \Concrete\Core\Page\Theme\Theme implements ThemeProviderInterface
{
    public function registerAssets()
    {
        $this->providesAsset('css', 'bootstrap/*');
        $this->providesAsset('javascript', 'bootstrap/*');
        $this->providesAsset('css', 'blocks/form');
        $this->providesAsset('css', 'blocks/social_links');
        $this->providesAsset('css', 'blocks/share_this_page');
        $this->providesAsset('css', 'blocks/feature');
        $this->providesAsset('css', 'blocks/testimonial');
        $this->providesAsset('css', 'blocks/date_navigation');
        $this->providesAsset('css', 'blocks/topic_list');
        $this->providesAsset('css', 'blocks/faq');
        $this->providesAsset('css', 'blocks/tags');
        $this->providesAsset('css', 'core/frontend/*');
        $this->providesAsset('css', 'blocks/feature/templates/hover_description');
        $this->requireAsset('css', 'font-awesome');
        $this->requireAsset('javascript', 'jquery');
        $this->requireAsset('javascript', 'picturefill');
        $this->requireAsset('javascript', 'core/frontend/parallax-image');
        $this->requireAsset('javascript-conditional', 'html5-shiv');
        $this->requireAsset('javascript-conditional', 'respond');
        $this->requireAsset('core/lightbox');
    }

    public function getThemeAreaLayoutPresets()
    {
        $presets = array(
            array(
                'handle' => 'left_sidebar',
                'name' => 'Left Sidebar',
                'container' => '<div class="row"></div>',
                'columns' => [
                    '<div class="col-lg-3 col-sm-4"></div>',
                    '<div class="col-lg-8 col-lg-offset-1 col-sm-8"></div>'
                ],
            )
        );
        return $presets;
    }

    protected $pThemeGridFrameworkHandle = 'bootstrap3';

    public function getThemeName()
    {
        return t('concrete5 Shared Theme');
    }

    public function getThemeDescription()
    {
        return t('concrete5 Shared Theme.');
    }

    public function getThemeResponsiveImageMap()
    {
        return array(
            'large' => '900px',
            'medium' => '768px',
            'small' => '0',
        );
    }

    public function getThemeEditorClasses()
    {
        return array(
            array('title' => t('Header Variant Blue'), 'spanClass' => 'header-variant-blue', 'forceBlock' => 1),
            array('title' => t('Header Variant Purple'), 'spanClass' => 'header-variant-purple', 'forceBlock' => 1),
            array('title' => t('Stripe Content Cream'), 'menuClass' => 'menu-stripe-content-cream', 'spanClass' => 'stripe-content-cream', 'forceBlock' => -1)
        );
    }


}
