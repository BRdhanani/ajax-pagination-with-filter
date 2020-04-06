<?php get_header(); ?>
<?php

function acf_get_field_key($field_name, $post_id = '')
{
    global $wpdb;
    $acf_fields = $wpdb->get_results($wpdb->prepare("SELECT ID,post_parent,post_name FROM $wpdb->posts WHERE post_excerpt=%s AND post_type=%s", $field_name, 'acf-field'));
    
    switch (count($acf_fields)) {
        case 0: 
            return false;
        case 1: 
            return $acf_fields[0]->post_name;
    }
    
    $field_groups_ids = array();
    $field_groups     = acf_get_field_groups(array(
        'post_id' => $post_id
    ));
    foreach ($field_groups as $field_group)
        $field_groups_ids[] = $field_group['ID'];
    
    foreach ($acf_fields as $acf_field) {
        if (in_array($acf_field->post_parent, $field_groups_ids))
            return $acf_field->post_name;
    }
    return false;
}
?>

<div class="dropdown">

<?php
$fieldKey = acf_get_field_key('select-type');
$field    = get_field_object($fieldKey);
  
if ($field) {
    
      echo '<select name="' . $field['label'] . '">';
    foreach ($field['choices'] as $k => $v) {
        echo '<option value="' . $k . '">' . $v . '</option>';
    }
    echo '</select>';
}

$args = array(
    'post_type' => 'competition',
    'post_status' => 'publish',
    'paged' => 1
);

$my_posts = new WP_Query($args);
if ($my_posts->have_posts()):
?>
    <div class="my-posts">
        <?php
    while ($my_posts->have_posts()): $my_posts->the_post(); ?>
           <h2><?php the_title(); ?></h2>
            <?php the_excerpt(); ?>
       <?php
    endwhile;
?>        
    </div>
<?php
endif;
?>
	<button class="loadmore" id="buton">Load More</button>
    <p class="button"></p>
</div>
