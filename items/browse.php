<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation secondary-nav">
    <?php echo custom_public_nav_items(); ?>
</nav>

<?php echo item_search_filters(); ?>

<?php echo pagination_links(); ?>

<?php if ($total_results > 0): ?>

<?php
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Creator')] = 'Dublin Core,Creator';
$sortLinks[__('Date Added')] = 'added';
?>
<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>

<?php endif; ?>

<?php fire_plugin_hook('public_facets', array('items'=>$items, 'view' => $this)); ?>

<div class="records">
    <?php foreach (loop('items') as $item): ?>
        <?php if (get_theme_option('browse_item_style') === 'list'): ?>
            <div class="item-meta hentry list">
                <h3><?php echo link_to_item(metadata($item, array('Dublin Core', 'Title'), array('class'=>'permalink'))); ?></h3>

                <div class="item-meta-content">
                    <?php if (metadata($item, 'has thumbnail')): ?>
                        <div class="item-img">
                        <?php echo link_to_item(item_image()); ?>
                        </div>
                    <?php endif; ?>

                    <span class="item-meta-details">
                        <?php if ($creator = metadata('item', array('Dublin Core', 'Creator'))): ?>
                            <span class="item-creator"><?php echo $creator; ?></span>
                        <?php endif; ?>
                        <?php if ($date = metadata('item', array('Dublin Core', 'Date'))): ?>
                            <span class="item-date"><?php echo $date; ?></span>
                        <?php endif; ?>
                        <?php if ($description = metadata($item, array('Dublin Core', 'Description'), array('snippet'=>350))): ?>
                            <div class="item-description"><?php echo $description; ?></div>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        <?php else: ?>
            <div class="item hentry" >
                <div class="item-meta">
                    <?php if (metadata('item', 'has files')): ?>
                        <div class="item-img"> <?php echo link_to_item(item_image()); ?> </div>
                    <?php endif; ?>

                    <h2><?php echo link_to_item(null, array('class'=>'permalink')); ?></h2>

                    <span class="item-meta-details">
                        <?php if ($creator = metadata('item', array('Dublin Core', 'Creator'))): ?>
                            <span class="item-creator"> <?php echo $creator; ?> </span>
                        <?php endif; ?>
                        <?php if ($date = metadata('item', array('Dublin Core', 'Date'))): ?>
                            <span class="item-date"><?php echo $date; ?></span>
                        <?php endif; ?>
                    </span>
                    <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?php echo pagination_links(); ?>

<?php if (get_theme_option('show_outputformats') == 1): ?>
<details class="outputs">
    <summary class="outputs-label">
        <?php echo __('Output Formats'); ?>
    </summary>
    <div id="output-format-list">
        <?php echo output_format_list(false); ?>
    </div>
</details>
<?php endif; ?>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
