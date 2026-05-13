<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header class="fixed top-0 left-0 w-full z-50">

    <div class="bg-black/10 border-b border-white/10">

      <div class="max-w-7xl mx-auto px-6 flex items-center justify-between relative h-[85px]">

        <!-- LEFT: Home icon + Nav -->
        <div class="flex items-center">
          <div class="mr-5 cursor-pointer">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Home.png"
                 class="w-[15px] object-contain" alt="Home">
          </div>
          <nav>
            <?php
            wp_nav_menu([
              'theme_location' => 'primary',
              'container'      => false,
              'menu_class'     => 'hidden md:flex gap-8 text-white text-sm',
              'fallback_cb'    => false
            ]);
            ?>
          </nav>
        </div>

        <!-- CENTER: Logo -->
        <div class="absolute left-1/2 transform -translate-x-1/2">
          <a href="<?php echo home_url(); ?>" class="block max-w-[60px]">
            <?php if (has_custom_logo()): ?>
              <div class="h-[70px] flex items-center web-logo">
                <?php the_custom_logo(); ?>
              </div>
            <?php else: ?>
              <span class="text-white font-bold text-lg">
                <?php bloginfo('name'); ?>
              </span>
            <?php endif; ?>
          </a>
        </div>

        <!-- RIGHT: Contact icons -->
        <div class="flex items-center gap-3 text-white">
          <span class="hidden md:block text-xs opacity-70">Connect by:</span>
          <a href="mailto:" class="w-9 h-9 flex items-center justify-center border border-white/30 rounded-full hover:bg-white hover:text-black transition">
            ✉
          </a>
          <a href="tel:" class="w-9 h-9 flex items-center justify-center border border-white/30 rounded-full hover:bg-white hover:text-black transition">
            ☎
          </a>
          <a href="#" class="w-9 h-9 flex items-center justify-center bg-green-500 rounded-full hover:scale-110 transition">
            💬
          </a>
        </div>

      </div>
    </div>

  </header>