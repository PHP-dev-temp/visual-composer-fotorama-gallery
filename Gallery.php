<?php

namespace Ta\VC;

class Gallery
{
    //region Singleton
    /** @var Gallery */
    private static $instance;

    /** @return Gallery */
    public static function getInstance()
    {
        if (Gallery::$instance == null)
            Gallery::$instance = new Gallery();
        return Gallery::$instance;
    }

    /** @return Gallery */
    private function __construct(){ }
    //endregion

    private $shortcode = 'ta_vc_gallery';
    private $defaults = [
        'images' => '',
        'show_title' => false,
        'show_social_buttons' => false,
        'show_gallery' => false,
    ];

    public function init()
    {
        add_shortcode($this->shortcode, array($this, 'render'));
        add_action('vc_before_init', array($this, 'register'));
    }

    public function render($atts)
    {
        extract(shortcode_atts($this->defaults, $atts));
        $sliders = explode(',', $images);
        if (count($sliders)<1) $show_gallery = false;

        ob_start();
        include('templates/gallery.php');
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    public function register()
    {
        vc_map(array(
            'name' => 'Galerija',
            'base' => $this->shortcode,
            'class' => '',
            'category' => 'Ta',
            'params' => [
                [
                    "type"        => "checkbox",
                    "heading"     => esc_html__( "Show title", "wp-bootstrap-starter" ),
                    "param_name"  => "show_title"
                ],
                [
                    "type"        => "checkbox",
                    "heading"     => esc_html__( "Show social buttons", "wp-bootstrap-starter" ),
                    "param_name"  => "show_social_buttons"
                ],
                [
                    "type"        => "checkbox",
                    "heading"     => esc_html__( "Show gallery", "wp-bootstrap-starter" ),
                    "param_name"  => "show_gallery"
                ],
                [
                    "type"        => "attach_images",
                    "heading"     => esc_html__( "Images in gallery", "wp-bootstrap-starter" ),
                    "description" => esc_html__( "Add image.", "wp-bootstrap-starter" ),
                    "param_name"  => "images",
                    "value"       => "",
                ],
            ]
        ));
    }

}
