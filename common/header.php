<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes" />
    <?php if ($author = option('author')): ?>
    <meta name="author" content="<?php echo $author; ?>" />
    <?php endif; ?>
    <?php if ($copyright = option('copyright')): ?>
    <meta name="copyright" content="<?php echo $copyright; ?>" />
    <?php endif; ?>
    <?php if ( $description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <?php
    queue_css_file(array('style', 'public', 'iconfonts'));
    queue_css_url("https://www.uni-mannheim.de/typo3conf/ext/uma_site/Resources/Public/Icons/sprite.css");
    queue_css_url("https://www.uni-mannheim.de/typo3conf/ext/uma_site/Resources/Public/Css/app.css");
    echo head_css();
    echo $this->partial('common/theme_option_styles.php');
    ?>

    <!-- JavaScripts -->
    <?php
    queue_js_file(array('globals'));
    queue_js_file(array('mashare', 'jquery-accessibleMegaMenu'), 'js');
    echo head_js();
    ?>
</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <div id="wrap">

        <header role="banner">

            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>

            <div class="align-bottom" style="display: flex;">
                <?php $logostyle = ( get_theme_option('logo_text_position') == 'below' ? "" : 'style="display: inline-block;"' ) ; ?>
                <div id="site-title" class="uma-header-left">
                <div id="header-logo" <?php echo $logostyle; ?>><?php echo link_to_home_page(theme_logo()); ?></div>
                <p id="header-text" <?php echo $logostyle; ?>><?php echo get_theme_option('logo_text'); ?></p>
            </div>

                <div class="uma-header-right">
                    <nav id="top-nav" role="navigation">
                        <?php echo centerrow_public_nav_main(); ?>
                    </nav>
                    <?php if (get_theme_option('no_quicksearch') != 1): ?>
                        <div id="search-container" role="search">
                        <?php if (get_theme_option('replace_quicksearch') != 1): ?>
                            <?php if (get_theme_option('use_advanced_search') === null || get_theme_option('use_advanced_search')): ?>
                                <?php echo search_form(array('show_advanced' => true, 'form_attributes' => array('role' => 'search', 'class' => 'closed'))); ?>
                            <?php else: ?>
                                <?php echo search_form(array('form_attributes' => array('role' => 'search', 'class' => 'closed'))); ?>
                            <?php endif; ?>
                            <button type="button" class="search-toggle" title="<?php echo __('Toggle search'); ?>"></button>
                        <?php else: ?>
                            <search>
                                <form id="search-form" class="advanced-search-form" action="find" aria-label="Search">
                                    <input id="query" class="advanced-search-form input" name="keywords" type="search" placeholder="Search Items">
                                    <button id="submit_search" class="advanced-search-form button" name="submit-search" type="submit">Search</button>
                                </form>
                            </search>
                        <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <article id="content" role="main">

            <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
