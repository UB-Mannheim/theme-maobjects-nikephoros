<?php
$pageTitle = __('Browse Collections');
echo head(array('title'=>$pageTitle,'bodyclass' => 'collections browse'));
?>

<h1><?php echo $pageTitle; ?> <?php echo __('(%s total)', $total_results); ?></h1>
<?php echo pagination_links(); ?>

<?php
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Date Added')] = 'added';
?>
<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>

<?php fire_plugin_hook('public_facets', array('collections'=>$collections, 'view' => $this)); ?> <!-- TODO: wont load for some reason -->

<div class="records">
    <?php foreach (loop('collections') as $collection): ?>
        <?php if (get_theme_option('browse_collection_style') === 'list'): ?>
            <div class="item-meta hentry list">
                <h3><?php echo link_to_collection(); ?></h3>

                <div class="item-meta-content">
                    <?php if ($collectionImage = record_image('collection')): ?>
                        <?php echo link_to_collection($collectionImage, array('class' => 'image')); ?>
                    <?php endif; ?>

                    <span class="item-meta-details">
                        <?php if ($collection->hasContributor()): ?>
                            <div class="collection-contributors">
                                <p>
                                    <strong><?php echo __('Contributors'); ?>:</strong>
                                    <?php echo metadata('collection', array('Dublin Core', 'Contributor'), array('all'=>true, 'delimiter'=>', ')); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        <?php if ($description = metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>350))): ?>
                            <div class="collection-description"> <?php echo $description; ?> </div>
                        <?php endif; ?>

                        <?php echo link_to_items_browse(__('View the items in %s', metadata('collection', 'rich_title', array('no_escape' => true))), array('collection' => metadata('collection', 'id')), array('class' => 'view-items-link')); ?>
                        <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>
                    </span>
                </div>
            </div>
        <?php else: ?>
            <div class="collection hentry">
                <?php if ($collectionImage = record_image('collection')): ?>
                    <?php echo link_to_collection($collectionImage, array('class' => 'image')); ?>
                <?php endif; ?>

                <h2><?php echo link_to_collection(); ?></h2>

                <?php if ($description = metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>150))): ?>
                    <div class="collection-description"> <?php echo $description; ?> </div>
                <?php endif; ?>

                <?php if ($collection->hasContributor()): ?>
                    <div class="collection-contributors">
                        <p>
                            <strong><?php echo __('Contributors'); ?>:</strong>
                            <?php echo metadata('collection', array('Dublin Core', 'Contributor'), array('all'=>true, 'delimiter'=>', ')); ?>
                        </p>
                    </div>
                <?php endif; ?>

                <?php echo link_to_items_browse(__('View the items in %s', metadata('collection', 'rich_title', array('no_escape' => true))), array('collection' => metadata('collection', 'id')), array('class' => 'view-items-link')); ?>
                <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>

<?php echo foot(); ?>
