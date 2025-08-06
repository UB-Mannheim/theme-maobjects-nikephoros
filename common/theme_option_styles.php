<?php
    ($bodyBgColor = get_theme_option('body_bg_color')) || ($buttonBgColor = "#FFFFFF");
    ($borderColor = get_theme_option('border_color')) || ($buttonBgColor = "#DEDEDE");
    ($linkColor = get_theme_option('link_color')) || ($linkColor = "#C72E2E");
    ($headerImageHeight = get_theme_option('header_image_height')) || ($headerImageHeight = "auto");
    $headerImageHeightMobile = get_theme_option('header_image_height_mobile');
    $headerEverywhere = get_theme_option('header_everywhere');
    $headerImagePosition = get_theme_option('header_image_position');
    $headerImagePosition = str_replace('_', '-', $headerImagePosition);
    $backgroundImageUrl = get_theme_option('background_image');
    $backgroundImagePosition = get_theme_option('background_image_position');
    $backgroundImageRepeat = get_theme_option('background_image_repeat');
    $backgroundImageSize = get_theme_option('background_image_size');
    $backgroundImageOpacity = get_theme_option('background_image_opacity');
    $backgroundImageDonotshowundercontent = get_theme_option('background_image_donotshowundercontent');
    $floatingHome = get_theme_option('floating_homepage');
    is_numeric($backgroundImageOpacity) ? $backgroundImageOpacity / 100 : 100;
    $show_element_set_headings = get_option('show_element_set_headings');
    $media_lightgallery_pdf_embed_hide_toolbar = get_theme_option( 'media_lightgallery_pdf_embed_hide_toolbar');
    $media_lightgallery_pdf_embed_hide_toolbar = get_theme_option( 'media_lightgallery_pdf_embed_hide_toolbar');
    $item_page_layout = get_theme_option( 'item_page_layout');
    $show_breadcrumbs = get_theme_option( 'show_breadcrumbs');
    $browse_hide_sec_nav = get_theme_option('browse_hide_sec_nav');
?>

<style>
    body,
    #search-form,
    #search-container input[type="text"],
    #search-container button,
    #advanced-form {
        background-color: <?php echo $bodyBgColor; ?>
    }

    header nav .navigation,
    #search-container input[type="text"],
    #search-container button,
    #search-form.closed+.search-toggle,
    #advanced-form,
    #search-filters ul li,
    #item-filters ul li,
    .element-set h2,
    #exhibit-page-navigation,
    #exhibit-pages>ul>li:not(:last-of-type),
    #exhibit-pages h4,
    table,
    th,
    td,
    .search-entry,
    .item-pagination.navigation,
    .secondary-nav ul {
        border-color: <?php echo $borderColor; ?>
    }

    a,
    .secondary-nav.navigation li.active a,
    .pagination-nav .sorting a,
    #sort-links .sorting a,
    #exhibit-pages .current a {
        color: <?php echo $linkColor; ?>;
    }

    <?php if ($headerEverywhere !== '1') : ?>
    #home #header-image {
        display: none;
    }
    <?php endif; ?>

    #header-image {
        height: <?php echo $headerImageHeight; ?>;
        align-items: <?php echo $headerImagePosition; ?>;
    }

    <?php if ($headerImageHeightMobile !== '') : ?>
    @media screen and (max-width:640px) {
        #header-image {
            height: <?php echo $headerImageHeightMobile; ?>;
        }
    }
    <?php endif; ?>

    /*** Close gap between metadata entries when headings are hidden ***/
    <?php if (!$show_element_set_headings) : ?>
    #wrap .element-set {
        margin-bottom: 0px;
    }
    <?php endif; ?>

    <?php if ($show_breadcrumbs) : ?>
    #simple-pages-breadcrumbs {
        display: none;
    }

    #content p + h1 {
        margin-top: unset;
    }
    <?php endif; ?>

    /*** Userdefined Backgroundimage ***/
    <?php
        $storage = Zend_Registry::get('storage');
        $uri = $storage->getUri($storage->getPathByType(get_theme_option('background_image'), 'theme_uploads'));
        if ($backgroundImageUrl) :
    ?>
    body {
        background-color: transparent;
        background-image: url('<?php echo $uri; ?>');
        background-size: <?php echo $backgroundImageSize; ?>;
        background-position: <?php echo $backgroundImagePosition; ?>;
        background-repeat: <?php echo $backgroundImageRepeat; ?>;
        background-attachment: fixed;
    }

    #search-form {
        background-color: transparent;
    }

    @media screen {
        #search-form {
            background-color: transparent;
        }
        #search-container #search-form.open + button.search-toggle {
            border: none;
            background-color: transparent;
        }
    }
    <?php endif; ?>

    <?php if ($backgroundImageUrl && ($backgroundImageDonotshowundercontent == '1')) : ?>
    #wrap {
        background-color: #FFFFFF;
        padding: 0px
    }
    #wrap header, #wrap article {
        margin-left: 1.8rem;
        margin-right: 1.8rem;
    }
    <?php endif; ?>

    /*** Floating home ***/
    <?php if ($floatingHome == '1') : ?>
    #home #wrap {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    @media only screen and (min-width: 900px) {
        #home #wrap {
            min-width: 1000px;
        }
    } 
    @media only screen and (max-width: 900px) {
        #home #wrap {
            min-width: 100%;
        }
    }

    #home #search-container {
        display: none;
    }

    #home #site-title {
        margin-top: auto;
    }

    #home .uma-footer {
        padding: 0rem;
    }

    #home .logos .hosted {
        display: none;
    }

    #home footer .legal {
        margin: 1.075rem 0;
    }

    #home footer .logos {
        margin-right: 20px;
    }
    <?php endif; ?>



    <?php if ($media_lightgallery_pdf_embed_hide_toolbar == '1') : ?>
    #wrap .lightgallery .toolbar {
        display: none;
    }

    #wrap .lightgallery #viewerContainer {
        top: auto;
    }
    <?php endif; ?>

    <?php if ($item_page_layout == 'vertical') : ?>
    .content-container {
        display: flex;
        align-items: flex-start;
    }

    #itemfiles {
        flex: 0 1 auto;
        margin-right: 20px;
    }

    .secondary-content {
        display: flex;
        flex-direction: column;
    }
    <?php endif; ?>

    /* Hide Secondary Navigation */
    <?php if ($browse_hide_sec_nav == '1') : ?>
    nav.navigation.secondary-nav > ul > li {
        display: none;
    }
    <?php endif; ?>

</style>