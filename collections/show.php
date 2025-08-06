<?php
$collectionTitle = metadata('collection', 'rich_title', array('no_escape' => true));
$totalItems = metadata('collection', 'total_items');
?>

<?php echo head(array('title' => $collectionTitle, 'bodyclass' => 'collections show')); ?>

<?php if (get_theme_option('hide_collection_heading') != 1): ?>
    <h1><?php echo $collectionTitle; ?></h1>
<?php endif; ?>

<?php echo all_element_texts('collection'); ?> <!-- Metadata entry collection title -->

<style>
    /* Hide metadata entry if option is set */
    <?php if(get_theme_option('hide_collection_metadata_title')) : ?>
        #dublin-core-title {
            display: none;
        }
    <?php endif; ?>
</style>

<div id="collection-items" class="items browse <?php echo get_theme_option('browse_item_style') ?>">
    <h2><?php echo __('Collection Items'); ?></h2>
    <?php if ($totalItems > 0): ?>
        <?php foreach (loop('items') as $item): ?>
        <?php $itemTitle = metadata('item', 'display_title'); ?>
        <div class="item hentry">
            <div class="item-meta">
            <?php if (metadata('item', 'has files')): ?>
            <div class="item-img">
                <?php echo link_to_item(item_image()); ?>
            </div>
            <?php endif; ?>
    
            <h2><?php echo link_to_item(null, array('class'=>'permalink')); ?></h2>
    
            <?php if ($creator = metadata('item', array('Dublin Core', 'Creator'))): ?>
            <span class="creator"><?php echo $creator; ?></span>
            <?php endif; ?>
            <?php if ($date = metadata('item', array('Dublin Core', 'Date'))): ?>
            <span class="date"><?php echo $date; ?></span>
            <?php endif; ?>
    
            <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
    
            </div><!-- end class="item-meta" -->
        </div><!-- end class="item hentry" -->
        <?php endforeach; ?>
        <?php echo link_to_items_browse(__(plural('View item', 'View all %s items', $totalItems), $totalItems), array('collection' => metadata('collection', 'id')), array('class' => 'view-items-link')); ?>
    <?php else: ?>
        <p><?php echo __("There are currently no items within this collection."); ?></p>
    <?php endif; ?>
</div><!-- end collection-items -->

<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>

<?php echo foot(); ?>
