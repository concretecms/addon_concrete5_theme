<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<header class="navbar navbar-static-top" role="banner" data-swiftype-index="false">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".documentation-navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a href="https://www.concrete5.org/" class="header-logo"><img src="<?=$view->getThemePath()?>/images/logo.png" style="width: 160px">
                    </a>
                </div>
                <div>
                    <nav class="collapse navbar-collapse documentation-navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="<?=DIR_REL?>/about">About</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?=DIR_REL?>/about/feature-index">Features</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/about/case-studies">Case Studies</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/about/showcase">Showcase</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/about/blog">Blog</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/about/roadmap">Roadmap</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="<?=DIR_REL?>/download">Download</a>
                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <li>
                                        <a href="<?=DIR_REL?>/trial">Try it now...</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/download">Download concrete5</a>
                                    </li>
                                    <li>
                                        <a href="//documentation.concrete5.org/developers/installation/installation">Installation</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/download/hosting">Hosting</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="<?=DIR_REL?>/solutions">Solutions</a>
                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <li>
                                        <a href="<?=DIR_REL?>/download/hosting">Hosting</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/support">Support</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/solutions/custom-development">Development</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/solutions/enterprise-extensions">Enterprise Extensions</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/solutions/concrete5-education">Education</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/solutions/concrete5-business">Business</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/solutions/concrete5-government">Government</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/solutions/partner-network">Partners</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/solutions/contact-us">Contact us</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="<?=DIR_REL?>/marketplace">Marketplace</a>
                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <li class="">
                                        <a href="<?=DIR_REL?>/marketplace/themes">Themes</a>
                                    </li>
                                    <li class="">
                                        <a href="<?=DIR_REL?>/marketplace/addons">Add-ons</a>
                                    </li>
                                    <li class="">
                                        <a href="//www.concrete5.org/marketplace/how_to_install_add_ons_and_themes_">Installation Help</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="<?=DIR_REL?>/community">Community</a>
                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <li>
                                        <a href="<?=DIR_REL?>/slack">Slack</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/community/forums">Forums</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/developers/stack-overflow">StackOverflow</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/community/members">Search Members</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/developers/bugs">Bug Tracker</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/developers/submitting-code">Submitting Code</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/community/jobs">Job Board</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="https://documentation.concrete5.org">Docs</a>
                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <li>
                                        <a href="https://documentation.concrete5.org/user-guide">User Guide</a>
                                    </li>
                                    <li>
                                        <a href="https://documentation.concrete5.org/developers">Developers</a>
                                    </li>
                                    <li>
                                        <a href="https://documentation.concrete5.org/tutorials">Tutorials</a>
                                    </li>
                                    <li>
                                        <a href="https://documentation.concrete5.org/videos">Video Library</a>
                                    </li>
                                    <li>
                                        <a href="https://documentation.concrete5.org/api">API</a>
                                    </li>
                                    <li>
                                        <a href="<?=DIR_REL?>/community/training1">Training &amp; Certification</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="hidden-sm">
                                <form action="/search">
                                    <i class="fa fa-search"></i>
                                    <input type="text" placeholder="Search" name="query" class="st-default-search-input" style="background:none;box-sizing:border-box">
                                </form>
                            </li>
                            <li class="hidden-xs">
                                <div class="wcbit-toggle">

                                </div>
                            </li>

                        </ul>
                    </nav>                </div>
            </div>
        </div>
    </div>
    <?php View::element('header_notifications', array(), 'concrete5_theme'); ?>
    <script type='text/javascript'>
        $.get('https://www.concrete5.org/tools/header_notification', function(data) {
            var elem = $(data),
                links = elem.find('a').hide();
            $('#header-notifications').replaceWith(elem);
            links.fadeIn();
        });
    </script>
</header>
