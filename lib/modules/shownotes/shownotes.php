<?php
namespace Podlove\Modules\Shownotes;

class Shownotes extends \Podlove\Modules\Base
{
    protected $module_name        = 'Shownotes';
    protected $module_description = 'Generate and manage episode show notes. Helps you provide rich metadata for URLs. Full support for Publisher Templates.';
    protected $module_group       = 'web publishing';

    public function load()
    {
        add_filter('podlove_episode_form_data', [$this, 'extend_episode_form'], 10, 2);
    }

    public function extend_episode_form($form_data, $episode)
    {
        $form_data[] = array(
            'type'     => 'callback',
            'key'      => 'shownotes',
            'options'  => array(
                'callback' => function () use ($episode) {
                    ?>
                    <div id="podlove-shownotes-app"><shownotes></shownotes></div>
                    <?php
},
                'label'    => __('Shownotes', 'podlove-podcasting-plugin-for-wordpress'),
            ),
            'position' => 415,
        );
        return $form_data;
    }
}
