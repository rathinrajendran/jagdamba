<?php

/* ─────────────────────────────────────────────────────────────
   HOME PAGE SETTINGS
───────────────────────────────────────────────────────────── */

add_action("acf/init", function () {
  if (!function_exists("acf_add_local_field_group")) {
    return;
  }

  acf_add_local_field_group([
    "key" => "group_home_page_dynamic",

    "title" => "Home Page Settings",

    "fields" => [
      /*
      |--------------------------------------------------------------------------
      | HERO SECTION
      |--------------------------------------------------------------------------
      */

      [
        "key" => "field_home_hero_tab",
        "label" => "Hero Section",
        "type" => "tab",
        "placement" => "top",
      ],

      [
        "key" => "field_home_hero_title",
        "label" => "Hero Title",
        "name" => "home_hero_title",
        "type" => "text",
      ],

      [
        "key" => "field_home_hero_subtitle",
        "label" => "Hero Subtitle",
        "name" => "home_hero_subtitle",
        "type" => "textarea",
      ],

      [
        "key" => "field_home_hero_bg",
        "label" => "Hero Background",
        "name" => "home_hero_bg",
        "type" => "image",
        "return_format" => "array",
        "preview_size" => "large",
      ],

      /*
      |--------------------------------------------------------------------------
      | FEATURE SECTION
      |--------------------------------------------------------------------------
      */

      [
        "key" => "field_home_feature_tab",
        "label" => "Feature Section",
        "type" => "tab",
        "placement" => "top",
      ],

      [
        "key" => "field_home_feature_title",
        "label" => "Feature Title",
        "name" => "home_feature_title",
        "type" => "text",
      ],

      [
        "key" => "field_home_feature_description",
        "label" => "Feature Description",
        "name" => "home_feature_description",
        "type" => "wysiwyg",
      ],

      [
        "key" => "field_home_feature_image",
        "label" => "Feature Image",
        "name" => "home_feature_image",
        "type" => "image",
        "return_format" => "array",
      ],
    ],

    "location" => [
      [
        [
          "param" => "page_type",
          "operator" => "==",
          "value" => "front_page",
        ],
      ],
    ],

    "position" => "acf_after_title",

    "style" => "seamless",

    "label_placement" => "top",

    "instruction_placement" => "label",
  ]);
});

/* --------------------------------------------------------------------------
   CONTENT HUB MENU
   -------------------------------------------------------------------------- */

add_action('admin_menu', function () {

  add_menu_page(

    'Content Hub',

    'Content Hub',

    'manage_options',

    'content-hub',

    '__return_null',

    'dashicons-layout',

    20

  );
});

function jagdamba_hero_banner_cpt()
{
  register_post_type("hero_banner", [
    "labels" => [
      "name" => "Home • Hero Banners",
      "singular_name" => "Hero Banner",
    ],

    "public" => true,

    "supports" => ["title"],

    "menu_icon" => "dashicons-images-alt2",

    "show_in_menu" => "content-hub",
    "show_in_rest" => true,
  ]);
}
add_action("init", "jagdamba_hero_banner_cpt");
function create_services_post_type()
{
  register_post_type("services", [
    "labels" => [
      "name" => "Services",
      "singular_name" => "Service",
    ],

    "public" => true,

    "has_archive" => false,

    "menu_icon" => "dashicons-hammer",

    "show_in_menu" => "content-hub",

    "supports" => ["title", "editor", "thumbnail"],
  ]);
}
add_action("init", "create_services_post_type");
function jagdamba_media_gallery_cpt()
{
  register_post_type("gallery", [
    "labels" => [
      "name" => "Gallery",
      "singular_name" => "Gallery Item",
    ],

    "public" => true,

    "menu_icon" => "dashicons-format-gallery",

    "show_in_menu" => "content-hub",

    "supports" => ["title", "editor", "thumbnail"],
  ]);
}
add_action("init", "jagdamba_media_gallery_cpt");

/* ==========================================================================
   PRODUCTS CPT
   ========================================================================== */
function create_product_cpt()
{
  register_post_type("products", [
    "labels" => [
      "name" => "Products",
      "singular_name" => "Product",
    ],

    "public" => true,

    "menu_icon" => "dashicons-products",

    "show_in_menu" => "content-hub",

    "supports" => ["title", "editor", "thumbnail"],


    "has_archive" => true,

    "rewrite" => [
      "slug" => "our-products",
      "with_front" => false,
    ],

    "show_in_rest" => false,
    'supports' => [
      'title',
      'editor',
      'thumbnail'
    ],
    'template' => [],
  ]);
}
add_action("init", "create_product_cpt");

/* --------------------------------------------------------------------------
   PRODUCT CATEGORY MENU
   -------------------------------------------------------------------------- */

add_action('admin_menu', function () {

  add_submenu_page(
    'content-hub',
    'Product Categories',
    'Product Categories',
    'manage_options',
    'edit-tags.php?taxonomy=product_category&post_type=products'
  );

});

/* --------------------------------------------------------------------------
   PRODUCT CATEGORIES
   -------------------------------------------------------------------------- */

function jagdamba_product_categories()
{
  register_taxonomy(
    "product_category",
    ["products"],
    [
      "labels" => [
        "name" => "Product Categories",
        "singular_name" => "Product Category",
        "search_items" => "Search Categories",
        "all_items" => "All Categories",
        "parent_item" => "Parent Category",
        "parent_item_colon" => "Parent Category:",
        "edit_item" => "Edit Category",
        "update_item" => "Update Category",
        "add_new_item" => "Add New Category",
        "new_item_name" => "New Category Name",
        "menu_name" => "Product Categories",
      ],

      "hierarchical" => true,

      "public" => true,

      "show_admin_column" => true,

      "show_ui" => true,

      "show_in_rest" => true,

      "rewrite" => [
        "slug" => "product-category",
      ],
    ]
  );
}
add_action("init", "jagdamba_product_categories");

function jagdamba_clients_cpt()
{
  register_post_type("clients", [

    "labels" => [
      "name" => "Home • Clients",
      "singular_name" => "Client",
    ],

    "public" => true,

    "has_archive" => false,

    "menu_icon" => "dashicons-groups",

    "show_in_menu" => "content-hub",

    "supports" => ["title", "thumbnail"],

    "show_in_rest" => true,
  ]);
}
add_action("init", "jagdamba_clients_cpt");

add_action("init", function () {
  register_post_type("social_links", [
    "labels" => [
      "name" => "Social Links",
      "singular_name" => "Social Link",
      "add_new" => "Add Social Link",
      "add_new_item" => "Add New Social Link",
      "edit_item" => "Edit Social Link",
      "new_item" => "New Social Link",
      "view_item" => "View Social Link",
      "search_items" => "Search Social Links",
      "not_found" => "No social links found",
      "not_found_in_trash" => "No social links found in Trash",
    ],

    "public" => true,

    "has_archive" => false,

    "menu_icon" => "dashicons-share",

    "show_in_menu" => "content-hub",

    "supports" => ["title"],

    "show_in_rest" => true,
  ]);
});

// ─── THEME SETUP ────────────────────────────────────────────────────────────
function theme_setup()
{
  add_theme_support("title-tag");
  add_theme_support("post-thumbnails");
  register_nav_menus(["primary" => "Primary Menu"]);
  add_theme_support("custom-logo");
}
add_action("after_setup_theme", "theme_setup");

// ─── ENQUEUE ASSETS ─────────────────────────────────────────────────────────
function jagdamba_assets()
{
  wp_enqueue_style("main-style", get_stylesheet_uri());
}
add_action("wp_enqueue_scripts", "jagdamba_assets");

function jagdamba_fonts()
{
  wp_enqueue_style(
    "google-fonts",
    "https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Roboto:wght@100;300;400;500;700;900&display=swap",
    [],
    null
  );
}
add_action("wp_enqueue_scripts", "jagdamba_fonts");

function theme_assets()
{
  // Tailwind
  wp_enqueue_script(
    "tailwind",
    "https://cdn.tailwindcss.com",
    [],
    null,
    false
  );

  // Swiper CSS
  wp_enqueue_style(
    "swiper-css",
    "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css",
    [],
    null
  );

  // Swiper JS
  wp_enqueue_script(
    "swiper-js",
    "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js",
    [],
    null,
    true
  );

  // Swiper height fix
  wp_add_inline_style(
    "swiper-css",
    '
        .myHeroSlider,
        .myHeroSlider .swiper-wrapper,
        .myHeroSlider .swiper-slide { height: 100vh; }
      '
  );

  // Swiper init (single, authoritative)
  wp_add_inline_script(
    "swiper-js",
    '
        window.addEventListener("load", function () {
          var el = document.querySelector(".myHeroSlider");
          if (!el || typeof Swiper === "undefined") return;
          new Swiper(el, {
            loop: true,
            speed: 1000,
            autoplay: { delay: 4000, disableOnInteraction: false },
            pagination: { el: ".swiper-pagination", clickable: true },
            effect: "fade",
            fadeEffect: { crossFade: true }
          });
        });
      '
  );
}
add_action("wp_enqueue_scripts", "theme_assets");

// ─── PRODUCT APPLICATION META BOX ───────────────────────────────────────────
function product_meta_box()
{
  add_meta_box(
    "product_details",
    "Product Details",
    "product_meta_callback",
    "products",
    "normal",
    "high"
  );
}
add_action("add_meta_boxes", "product_meta_box");

function product_meta_callback($post)
{
  wp_nonce_field("product_details_save", "product_details_nonce");
  $application = get_post_meta($post->ID, "_product_application", true);
?>
  <table class="form-table">
    <tr>
      <th><label for="product_application">Application</label></th>
      <td>
        <textarea id="product_application" name="product_application"
          rows="4" style="width:100%;"
          placeholder="e.g. Production monitoring, Pipeline testing and maintenance..."><?php echo esc_textarea(
                                                                                          $application
                                                                                        ); ?></textarea>
        <p class="description">Shown in the product carousel on the homepage under the title.</p>
      </td>
    </tr>
  </table>
<?php
}

function product_save_meta($post_id)
{
  if (
    !isset($_POST["product_details_nonce"]) ||
    !wp_verify_nonce(
      $_POST["product_details_nonce"],
      "product_details_save"
    ) ||
    (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) ||
    !current_user_can("edit_post", $post_id)
  ) {
    return;
  }

  if (isset($_POST["product_application"])) {
    update_post_meta(
      $post_id,
      "_product_application",
      sanitize_textarea_field($_POST["product_application"])
    );
  }
}
add_action("save_post_products", "product_save_meta");

// ─── HERO BANNER META BOX ────────────────────────────────────────────────────
function hero_banner_meta_box()
{
  add_meta_box(
    "hero_banner_image",
    "Slide Background Image",
    "hero_banner_image_callback",
    "hero_banner",
    "normal",
    "high"
  );
}
add_action("add_meta_boxes", "hero_banner_meta_box");

function hero_banner_image_callback($post)
{
  wp_nonce_field("hero_banner_save", "hero_banner_nonce");
  $image_id = get_post_meta($post->ID, "_hero_banner_image_id", true);
  $image_url = $image_id
    ? wp_get_attachment_image_url($image_id, "large")
    : "";
?>
  <div style="margin:10px 0;">
    <img id="hero-banner-preview"
      src="<?php echo esc_url($image_url); ?>"
      style="max-width:100%;max-height:300px;display:<?php echo $image_url
                                                        ? "block"
                                                        : "none"; ?>;margin-bottom:10px;">

    <input type="hidden" id="hero_banner_image_id" name="hero_banner_image_id"
      value="<?php echo esc_attr($image_id); ?>">

    <button type="button" class="button button-primary" id="hero-banner-upload-btn">
      Upload / Choose Image
    </button>

    <button type="button" class="button" id="hero-banner-remove-btn"
      style="display:<?php echo $image_id ? "inline-block" : "none"; ?>;">
      Remove Image
    </button>
  </div>



  <script>
    jQuery(function($) {
      var frame;
      $('#hero-banner-upload-btn').on('click', function(e) {
        e.preventDefault();
        if (frame) {
          frame.open();
          return;
        }
        frame = wp.media({
          title: 'Select Slide Image',
          button: {
            text: 'Use this image'
          },
          multiple: false
        });
        frame.on('select', function() {
          var att = frame.state().get('selection').first().toJSON();
          $('#hero_banner_image_id').val(att.id);
          $('#hero-banner-preview').attr('src', att.url).show();
          $('#hero-banner-remove-btn').show();
        });
        frame.open();
      });
      $('#hero-banner-remove-btn').on('click', function() {
        $('#hero_banner_image_id').val('');
        $('#hero-banner-preview').attr('src', '').hide();
        $(this).hide();
      });
    });
  </script>
<?php
}

function hero_banner_save_meta($post_id)
{
  if (
    !isset($_POST["hero_banner_nonce"]) ||
    !wp_verify_nonce($_POST["hero_banner_nonce"], "hero_banner_save") ||
    (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) ||
    !current_user_can("edit_post", $post_id)
  ) {
    return;
  }

  if (isset($_POST["hero_banner_image_id"])) {
    update_post_meta(
      $post_id,
      "_hero_banner_image_id",
      sanitize_text_field($_POST["hero_banner_image_id"])
    );
  }
}
add_action("save_post_hero_banner", "hero_banner_save_meta");

// ─── ACF OPTIONS PAGE ────────────────────────────────────────────────────────
add_action("acf/init", function () {
  if (function_exists("acf_add_options_page")) {
    acf_add_options_page([
      "page_title" => "Footer Settings",
      "menu_title" => "Footer Settings",
      "menu_slug" => "footer-settings",
      "capability" => "edit_posts",
      "redirect" => false,
    ]);
  }
});
// ─── CLIENTS CPT ───────────────────────────────────────────────────────────

// Remove unnecessary editor completely
function remove_client_editor()
{
  remove_post_type_support("clients", "editor");
}
add_action("init", "remove_client_editor");

// Rename Featured Image text
function jagdamba_change_featured_image_labels()
{
  $screen = get_current_screen();

  if ($screen->post_type == "clients") {
    remove_meta_box("postimagediv", "clients", "side");

    add_meta_box(
      "postimagediv",
      "Client Logo",
      "post_thumbnail_meta_box",
      "clients",
      "side",
      "high"
    );
  }
}
add_action("do_meta_boxes", "jagdamba_change_featured_image_labels");

// ─── MEDIA GALLERY PAGE META BOX ──────────────────────────────────────────

function gallery_page_meta_box()
{
  add_meta_box(
    "gallery_page_meta",
    "Media Gallery Hero Settings",
    "gallery_page_meta_callback",
    "page",
    "normal",
    "high"
  );
}

add_action("add_meta_boxes", "gallery_page_meta_box");

function gallery_page_meta_callback($post)
{
  $template = get_page_template_slug($post->ID);

  if ($template !== "page-media-gallery.php") {
    return;
  }

  wp_nonce_field("gallery_page_meta_save", "gallery_page_meta_nonce");

  $hero_title = get_post_meta($post->ID, "_gallery_hero_title", true);

  $hero_image_id = get_post_meta($post->ID, "_gallery_hero_image_id", true);

  $hero_image = $hero_image_id
    ? wp_get_attachment_image_url($hero_image_id, "large")
    : "";
?>

  <div style="padding:10px 0;">

    <p>
      <strong>Hero Title</strong>
    </p>

    <input
      type="text"
      name="gallery_hero_title"
      value="<?php echo esc_attr($hero_title); ?>"
      style="width:100%;padding:10px;"
      placeholder="Media & Gallery">

    <br><br>

    <p>
      <strong>Hero Background Image</strong>
    </p>

    <img
      id="gallery-hero-preview"
      src="<?php echo esc_url($hero_image); ?>"
      style="max-width:100%;max-height:220px;display:<?php echo $hero_image
                                                        ? "block"
                                                        : "none"; ?>;margin-bottom:10px;">

    <input
      type="hidden"
      id="gallery_hero_image_id"
      name="gallery_hero_image_id"
      value="<?php echo esc_attr($hero_image_id); ?>">

    <button
      type="button"
      class="button button-primary"
      id="gallery-hero-upload-btn">
      Upload Hero Image
    </button>

  </div>

  <script>
    jQuery(function($) {

      let frame;

      $('#gallery-hero-upload-btn').on('click', function(e) {

        e.preventDefault();

        if (frame) {
          frame.open();
          return;
        }

        frame = wp.media({
          title: 'Select Hero Image',
          button: {
            text: 'Use this image'
          },
          multiple: false
        });

        frame.on('select', function() {

          const attachment = frame
            .state()
            .get('selection')
            .first()
            .toJSON();

          $('#gallery_hero_image_id').val(attachment.id);

          $('#gallery-hero-preview')
            .attr('src', attachment.url)
            .show();

        });

        frame.open();

      });

    });
  </script>

<?php
}

function gallery_page_meta_save($post_id)
{
  if (
    !isset($_POST["gallery_page_meta_nonce"]) ||
    !wp_verify_nonce(
      $_POST["gallery_page_meta_nonce"],
      "gallery_page_meta_save"
    )
  ) {
    return;
  }

  if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
    return;
  }

  if (!current_user_can("edit_post", $post_id)) {
    return;
  }

  if (isset($_POST["gallery_hero_title"])) {
    update_post_meta(
      $post_id,
      "_gallery_hero_title",
      sanitize_text_field($_POST["gallery_hero_title"])
    );
  }

  if (isset($_POST["gallery_hero_image_id"])) {
    update_post_meta(
      $post_id,
      "_gallery_hero_image_id",
      sanitize_text_field($_POST["gallery_hero_image_id"])
    );
  }
}

add_action("save_post_page", "gallery_page_meta_save");

/* ─────────────────────────────────────────────────────────────
   ABOUT PAGE DYNAMIC ACF FIELDS
───────────────────────────────────────────────────────────── */
add_action("acf/init", function () {
  if (!function_exists("acf_add_local_field_group")) {
    return;
  }

  acf_add_local_field_group([
    "key" => "group_about_page_dynamic",

    "title" => "About Page Settings",

    "fields" => [
      /* HERO */
      [
        "key" => "field_about_hero_tab",
        "label" => "Hero Section",
        "type" => "tab",
      ],

      [
        "key" => "field_about_hero_title",
        "label" => "Hero Title",
        "name" => "about_hero_title",
        "type" => "text",
      ],

      [
        "key" => "field_about_hero_bg",
        "label" => "Hero Background",
        "name" => "about_hero_bg",
        "type" => "image",
        "return_format" => "array",
      ],

      /* STORY */
      [
        "key" => "field_story_tab",
        "label" => "Story Section",
        "type" => "tab",
      ],

      [
        "key" => "field_about_small_title",
        "label" => "Small Title",
        "name" => "about_small_title",
        "type" => "text",
      ],

      [
        "key" => "field_about_main_title",
        "label" => "Main Title",
        "name" => "about_main_title",
        "type" => "textarea",
      ],

      [
        "key" => "field_about_description",
        "label" => "Description",
        "name" => "about_description",
        "type" => "wysiwyg",
      ],

      [
        "key" => "field_about_story_image",
        "label" => "Story Image",
        "name" => "about_story_image",
        "type" => "image",
        "return_format" => "array",
      ],
      /* VISION */
      [
        "key" => "field_vision_tab",
        "label" => "Vision & Mission",
        "type" => "tab",
      ],

      [
        "key" => "field_vision_image",
        "label" => "Vision Image",
        "name" => "vision_image",
        "type" => "image",
        "return_format" => "array",
      ],

      [
        "key" => "field_vision_title",
        "label" => "Vision Title",
        "name" => "vision_title",
        "type" => "text",
      ],

      [
        "key" => "field_vision_description",
        "label" => "Vision Description",
        "name" => "vision_description",
        "type" => "textarea",
      ],

      [
        "key" => "field_mission_title",
        "label" => "Mission Title",
        "name" => "mission_title",
        "type" => "text",
      ],

      [
        "key" => "field_mission_description",
        "label" => "Mission Description",
        "name" => "mission_description",
        "type" => "textarea",
      ],

      /* WHY CHOOSE */
      [
        "key" => "field_why_tab",
        "label" => "Why Choose Us",
        "type" => "tab",
      ],

      [
        "key" => "field_why_choose_image",
        "label" => "Right Side Image",
        "name" => "why_choose_image",
        "type" => "image",
        "return_format" => "array",
      ],
    ],

    "location" => [
      [
        [
          "param" => "page_template",
          "operator" => "==",
          "value" => "page-about-us.php",
        ],
      ],
    ],

    "position" => "acf_after_title",
    "style" => "seamless",
  ]);
});

/* ─────────────────────────────────────────────────────────────
   CONTACT PAGE DYNAMIC ACF FIELDS
───────────────────────────────────────────────────────────── */

add_action("acf/init", function () {
  if (!function_exists("acf_add_local_field_group")) {
    return;
  }

  acf_add_local_field_group([
    "key" => "group_contact_page_dynamic",

    "title" => "Contact Page Settings",

    "fields" => [
      /*
      |--------------------------------------------------------------------------
      | HERO SECTION
      |--------------------------------------------------------------------------
      */

      [
        "key" => "field_contact_hero_tab",
        "label" => "Hero Section",
        "type" => "tab",
      ],

      [
        "key" => "field_contact_hero_title",
        "label" => "Hero Title",
        "name" => "contact_hero_title",
        "type" => "text",
        "default_value" => "Contact Us",
      ],

      [
        "key" => "field_contact_hero_bg",
        "label" => "Hero Background",
        "name" => "contact_hero_bg",
        "type" => "image",
        "return_format" => "array",
        "preview_size" => "large",
      ],

      /*
      |--------------------------------------------------------------------------
      | CONTACT CONTENT
      |--------------------------------------------------------------------------
      */

      [
        "key" => "field_contact_content_tab",
        "label" => "Contact Content",
        "type" => "tab",
      ],

      [
        "key" => "field_contact_small_title",
        "label" => "Small Title",
        "name" => "contact_small_title",
        "type" => "text",
        "default_value" => "Contact Us",
      ],

      [
        "key" => "field_contact_main_title",
        "label" => "Main Title",
        "name" => "contact_main_title",
        "type" => "textarea",
        "rows" => 3,
      ],

      [
        "key" => "field_contact_email_icon",
        "label" => "Email Icon",
        "name" => "contact_email_icon",
        "type" => "image",
        "return_format" => "array",
      ],

      [
        "key" => "field_contact_email",
        "label" => "Email Address",
        "name" => "contact_email",
        "type" => "text",
      ],

      [
        "key" => "field_contact_phone_icon",
        "label" => "Phone Icon",
        "name" => "contact_phone_icon",
        "type" => "image",
        "return_format" => "array",
      ],

      [
        "key" => "field_contact_phone_1",
        "label" => "Phone Number 1",
        "name" => "contact_phone_1",
        "type" => "text",
      ],

      [
        "key" => "field_contact_phone_2",
        "label" => "Phone Number 2",
        "name" => "contact_phone_2",
        "type" => "text",
      ],

      [
        "key" => "field_contact_address_icon",
        "label" => "Address Icon",
        "name" => "contact_address_icon",
        "type" => "image",
        "return_format" => "array",
      ],

      [
        "key" => "field_contact_address",
        "label" => "Address",
        "name" => "contact_address",
        "type" => "textarea",
        "rows" => 4,
      ],

      /*
      |--------------------------------------------------------------------------
      | MAP SECTION
      |--------------------------------------------------------------------------
      */

      [
        "key" => "field_contact_map_tab",
        "label" => "Map Section",
        "type" => "tab",
      ],

      [
        "key" => "field_contact_map_iframe",
        "label" => "Google Map Iframe",
        "name" => "contact_map_iframe",
        "type" => "textarea",
        "instructions" => "Paste Google Maps iframe embed code",
        "rows" => 6,
      ],
    ],

    "location" => [
      [
        [
          "param" => "page_template",
          "operator" => "==",
          "value" => "page-contact-us.php",
        ],
      ],
    ],

    "position" => "acf_after_title",
    "style" => "seamless",
    "label_placement" => "top",
    "instruction_placement" => "label",
  ]);
});

/*
|--------------------------------------------------------------------------
| SOCIAL LINKS ACF FIELDS
|--------------------------------------------------------------------------
*/

add_action("acf/init", function () {
  if (!function_exists("acf_add_local_field_group")) {
    return;
  }

  acf_add_local_field_group([
    "key" => "group_social_links_fields",

    "title" => "Social Links Fields",

    "fields" => [
      [
        "key" => "field_social_icon",
        "label" => "Icon",
        "name" => "social_icon",
        "type" => "image",
        "return_format" => "array",
        "preview_size" => "thumbnail",
      ],

      [
        "key" => "field_social_name",
        "label" => "Name",
        "name" => "social_name",
        "type" => "text",
      ],

      [
        "key" => "field_social_link",
        "label" => "Link",
        "name" => "social_link",
        "type" => "url",
      ],
    ],

    "location" => [
      [
        [
          "param" => "post_type",
          "operator" => "==",
          "value" => "social_links",
        ],
      ],
    ],

    "position" => "acf_after_title",
    "style" => "seamless",
  ]);
});

add_action(
  "admin_menu",
  function () {
    remove_menu_page("edit-comments.php");

    remove_menu_page("tools.php");
  },
  999
);

/*
|--------------------------------------------------------------------------
| STATISTICS CPT
|--------------------------------------------------------------------------
*/

function jagdamba_statistics_cpt()
{
  register_post_type("statistics", [
    "labels" => [
      "name" => "About • Statistics",
      "singular_name" => "Statistic",
      "add_new_item" => "Add Statistic",
      "edit_item" => "Edit Statistic",
    ],

    "public" => true,

    "show_ui" => true,

    "show_in_menu" => "content-hub",
    "menu_icon" => "dashicons-chart-bar",

    "supports" => ["title"],

    "has_archive" => false,
    "show_in_rest" => true,
  ]);
}
add_action("init", "jagdamba_statistics_cpt");

/*
|--------------------------------------------------------------------------
| WHY CHOOSE US CPT
|--------------------------------------------------------------------------
*/

function jagdamba_why_choose_cpt()
{
  register_post_type("why_choose_us", [
    "labels" => [
      "name" => "About • Why Choose Us",
      "singular_name" => "Why Choose Item",
      "add_new_item" => "Add Why Choose Item",
      "edit_item" => "Edit Why Choose Item",
    ],

    "public" => true,

    "show_ui" => true,

    "show_in_menu" => "content-hub",
    "menu_icon" => "dashicons-awards",

    "supports" => ["title"],

    "has_archive" => false,
    "show_in_rest" => true,
  ]);
}
add_action("init", "jagdamba_why_choose_cpt");

add_action("acf/init", function () {
  acf_add_local_field_group([
    "key" => "group_statistics_fields",

    "title" => "Statistics Fields",

    "fields" => [
      [
        "key" => "field_stat_number",
        "label" => "Number",
        "name" => "stat_number",
        "type" => "text",
      ],

      [
        "key" => "field_stat_text",
        "label" => "Text",
        "name" => "stat_text",
        "type" => "textarea",
      ],
    ],

    "location" => [
      [
        [
          "param" => "post_type",
          "operator" => "==",
          "value" => "statistics",
        ],
      ],
    ],
  ]);
});
add_action("acf/init", function () {
  acf_add_local_field_group([
    "key" => "group_why_choose_fields",
    "title" => "Why Choose Us Fields",

    "fields" => [
      [
        "key" => "field_why_choose_desc",
        "label" => "Description",
        "name" => "why_choose_desc",
        "type" => "textarea",
      ],
    ],

    "location" => [
      [
        [
          "param" => "post_type",
          "operator" => "==",
          "value" => "why_choose_us",
        ],
      ],
    ],
  ]);
});

/* --------------------------------------------------------------------------
   REMOVE CATEGORY BOX FROM PRODUCT EDITOR
   -------------------------------------------------------------------------- */

function jagdamba_remove_product_category_metabox()
{
    remove_meta_box(
        'product_categorydiv',
        'products',
        'side'
    );
}

add_action(
    'admin_menu',
    'jagdamba_remove_product_category_metabox'
);