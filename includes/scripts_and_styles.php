<?php
function add_type_attribute($tag, $handle, $src) {
  // if not your script, do nothing and return original $tag
  if ( 'podlove-vue-app-client' !== $handle ) {
      return $tag;
  }
  // change the script tag by adding type="module" and return it.
  $tag = '<script crossorigin type="module" src="' . esc_url( $src ) . '"></script>';
  return $tag;
}

// admin styles & scripts
add_action('admin_print_styles', function () {
    $screen = get_current_screen();

    $is_episode_edit_screen = \Podlove\is_episode_edit_screen();

    $version = \Podlove\get_plugin_header('Version');

    $vue_screens = [
        'podlove_page_podlove_slackshownotes_settings',
        'podlove_page_podlove_tools_settings_handle',
        'podlove_page_podlove_analytics',
        'podlove-setup-wizard'
    ];

    // vue job dashboard
    if ($is_episode_edit_screen || in_array($screen->base, $vue_screens)) {
        wp_enqueue_script('podlove-vue-app-client', \Podlove\PLUGIN_URL.'/js/dist/client.js', [], $version, true);
<<<<<<< HEAD
        add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);
=======
>>>>>>> 6ca060a4744249c97d016dd3c3b420a4285881e3
        wp_enqueue_style('podlove-vue-app-client', \Podlove\PLUGIN_URL.'/js/dist/style.css', [], $version);

        $episode = Podlove\Model\Episode::find_one_by_post_id(get_the_ID());

        add_filter('podlove_data_js', function ($data) use ($episode) {
          $data['episode'] = json_encode(array(
            'duration' => $episode->duration,
            'id' => $episode->id
          ));

          $data['post'] = json_encode(array(
            'id' => get_the_ID()
          ));

          $data['api'] = json_encode(array(
            'base' => esc_url_raw(rest_url('podlove')),
            'nonce' => wp_create_nonce('wp_rest'),
          ));

          return $data;
        });
    }

    if (\Podlove\is_podlove_settings_screen() || $is_episode_edit_screen) {
        wp_enqueue_style('podlove-admin', \Podlove\PLUGIN_URL.'/css/admin.css', [], $version);
        wp_enqueue_style('podlove-admin-font', \Podlove\PLUGIN_URL.'/css/admin-font.css', [], $version);

        // chosen.js scripts & styles
        wp_enqueue_style('podlove-admin-chosen', \Podlove\PLUGIN_URL.'/js/admin/chosen/chosen.min.css', [], $version);
        wp_enqueue_style('podlove-admin-image-chosen', \Podlove\PLUGIN_URL.'/js/admin/chosen/chosenImage.css', [], $version);

        wp_enqueue_script('podlove_admin', \Podlove\PLUGIN_URL.'/js/dist/podlove-admin.js', [
            'jquery', 'jquery-ui-sortable', 'jquery-ui-datepicker',
        ], $version);

        wp_enqueue_style('jquery-ui-style', \Podlove\PLUGIN_URL.'/js/admin/jquery-ui/css/smoothness/jquery-ui.css');
    }
});
