<?php

/**
 * Implements hook_css_alter().
 */
function tweme_css_alter(&$css) {
  unset($css['modules/poll/poll.css']);
}

/**
 * Preprocesses variables for block.tpl.php.
 */
function tweme_preprocess_block(&$vars) {
  $block = $vars['block'];

  if ($block->region == 'featured') {
    if ($block->module == 'imageblock' && module_exists('imageblock')) {
      if ($img = imageblock_get_file($block->delta)) {
        $src = file_create_url($img->uri);
        $vars['attributes_array']['style'] = sprintf('background-image: url(%s)', $src);
      }
    }
    $vars['classes_array'][] = 'item';
    if ($vars['block_id'] == 1) {
      $vars['classes_array'][] = 'active';
    }
  }
}