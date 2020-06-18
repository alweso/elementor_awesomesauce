<?php
namespace Elementor;
function category_elementor_init()
 Plugin::instance()->elements_manager->add_category(
 'category-for-elementor',
 [
 'title' => 'blalba Category',
 'icon' => 'font'
 ],
 1
 );

add_action('elementor/init', 'Elementorcategory_elementor_init');
?>
