<?php

// NOTE: Extend WP Revision UI

class PikList_Revision
{
  public static function _construct()
  {
    add_action('save_post', array('piklist_revision', 'save_post'), 10, 2);
    add_action('wp_restore_post_revision', array('piklist_revision', 'restore_revision'), 10, 2);
  }
  
  public static function save_post($post_id, $post) 
  {
    if ($parent_id = wp_is_post_revision($post_id)) 
    {
      $parent = get_post($parent_id);
      $meta = get_post_custom($parent->ID);

      foreach ($meta as $key => $value)
      {
        add_metadata('post', $post_id, $key, maybe_serialize($value));   
      }
    }
  }
  
  public static function restore_revision($post_id, $revision_id)
  {
    $meta = get_post_custom($revision->ID);

    foreach ($meta as $key => $value)
    {
      update_metadata('post', $post_id, $key, $value);   
    }
  }  
}

?>