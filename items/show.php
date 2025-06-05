<?php
$linkToFileMetadata = get_option('link_to_file_metadata');
$itemFiles = $item->Files;
$useLightgallery  = get_theme_option('media_lightgallery');
if ($itemFiles && $useLightgallery) {
    queue_lightgallery_assets();
}
echo head(array('title' => metadata('item', array('Dublin Core', 'Title')), 'bodyclass' => 'items show'));
?>

<?php if (get_theme_option('hide_item_heading') != 1): ?>
    <h1><?php echo metadata('item', 'rich_title', array('no_escape' => true)); ?></h1>
<?php endif; ?>

<nav>
    <ul class="item-pagination navigation">
        <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
        <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
    </ul>
</nav>

<div class="content-container">
    <!-- <div class="primary-content"> -->
        <?php
        if ($itemFiles && !$useLightgallery) {
            $image = item_image('thumbnail', array(), 0, $item);
            $url = metadata('item', array('Item Type Metadata', 'URL'), array('no_filter' => true));
            echo '<div class="element-set center">';
            if ($url) {
                echo '<a class="cover" target="_blank" href="' . $url . '">' . $image . '</a>';
            } else {
                echo $image;
            }
            echo '</div>';
        } elseif ($itemFiles && $useLightgallery) {
            echo lightGallery($itemFiles);
        }
        ?>
    <!-- </div> -->

    <div class="secondary-content">
        <?php echo all_element_texts('item'); ?>

        <style>
            /* Hide metadata entry if option is set */
            <?php if(get_theme_option('hide_item_metadata_title')) : ?>
                #dublin-core-title {
                    display: none;
                }
            <?php endif; ?>
        </style>

        <!-- If the item belongs to a collection, the following creates a link to that collection. -->
        <?php if (metadata('item', 'Collection Name')): ?>
        <div id="collection" class="element">
            <h3><?php echo __('Collection'); ?></h3>
            <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
        </div>
        <?php endif; ?>

        <!-- The following prints a list of all tags associated with the item -->
        <?php if (metadata('item', 'has tags')): ?>
        <div id="item-tags" class="element">
            <h3><?php echo __('Tags'); ?></h3>
            <div class="element-text"><?php echo tag_string('item', 'find'); ?></div>
        </div>
        <?php endif;?>

        <div class="element">
            <div class="element-text">
                <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>
            </div>
        </div>

        <?php if ((get_theme_option('other_media') == 1) && $itemFiles): ?>
        <?php echo lightgallery_other_files($itemFiles); ?>
        <?php endif; ?>

        <!-- The following prints a citation for this item. -->
        <?php if (get_theme_option('show_citation') == 1): ?>
        <div id="item-citation" class="element">
            <h3><?php echo __('Citation'); ?></h3>
            <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
        </div>
        <?php endif; ?>

        <?php if (get_theme_option('show_outputformats') == 1): ?>
        <div id="item-output-formats" class="element">
            <h3><?php echo __('Output Formats'); ?></h3>
            <div class="element-text"><?php echo output_format_list(); ?></div>
        </div>
        <?php endif; ?>
    </div>
</div>



<nav>
    <ul class="item-pagination navigation">
        <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
        <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
    </ul>
</nav>

<?php echo foot(); ?>
