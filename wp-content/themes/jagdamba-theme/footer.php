<?php
$footer_page = get_page_by_path("footer");
if ($footer_page) {
    $id        = $footer_page->ID;
    $title     = get_field("footer_title", $id);
    $desc      = get_field("footer_description", $id);
    $email     = get_field("footer_email", $id);
    $phone1    = get_field("footer_phone_1", $id);
    $phone2    = get_field("footer_phone_2", $id);
    $address   = get_field("footer_address", $id);
    $fb        = get_field("footer_facebook", $id);
    $ig        = get_field("footer_instagram", $id);
    $yt        = get_field("footer_youtube", $id);
    $copyright = get_field("footer_copyright", $id);
}
?>

<footer class="bg-black text-white mt-0">

  <!-- Top Section -->
  <div class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-start">

    <!-- Left: Newsletter -->
    <div>
      <h3 class="text-xl font-semibold mb-3">
        <?php echo esc_html($title ?: "LET'S CONNECT"); ?>
      </h3>
      <p class="text-gray-400 mb-6 text-sm">
        <?php echo esc_html($desc); ?>
      </p>
      <div class="flex items-center border border-gray-600 rounded-full overflow-hidden max-w-md">
        <input type="email" placeholder="Enter your email ID"
               class="bg-transparent px-4 py-2 w-full text-sm outline-none">
        <button class="bg-green-600 px-6 py-2 text-sm rounded-full hover:bg-green-700">Send</button>
      </div>
    </div>

    <!-- Right: Contact Info -->
    <div class="flex justify-end text-sm text-gray-300">
      <div class="space-y-2">

        <?php if ($address): ?>
          <div class="flex items-start">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/loc.png"
                 class="mt-1 mr-3 w-[15px] object-contain" alt="Location">
            <span><?php echo nl2br(esc_html($address)); ?></span>
          </div>
        <?php endif; ?>

        <?php if ($phone1 || $phone2): ?>
          <div class="flex items-start">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/phone.png"
                 class="mt-1 mr-3 w-[15px] object-contain" alt="Phone">
            <span>
              <?php echo esc_html($phone1); ?>
              <?php if ($phone2): ?><br><?php echo esc_html($phone2); ?><?php endif; ?>
            </span>
          </div>
        <?php endif; ?>

        <?php if ($email): ?>
          <div class="flex items-start">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/mail.png"
                 class="mt-1 mr-3 w-[15px] object-contain" alt="Mail">
            <span><?php echo esc_html($email); ?></span>
          </div>
        <?php endif; ?>

      </div>
    </div>

  </div>

<!-- Social Icons -->
<div class="text-center py-10 border-t border-[#212121] text-center text-xs text-gray-500 py-10">

  <?php
  $social_query = new WP_Query([
    'post_type'      => 'social_links',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
  ]);

  if ($social_query->have_posts()) :
  ?>

    <div class="flex justify-center gap-5 mb-5">

      <?php
      while ($social_query->have_posts()) :
        $social_query->the_post();

        $icon = get_field('social_icon');
        $link = get_field('social_link');
      ?>

        <a
          href="<?php echo esc_url($link); ?>"
          target="_blank"
          class="w-[56px] h-[56px] rounded-full border-4 border-white flex items-center justify-center hover:bg-white/10 transition duration-300">

          <?php if (!empty($icon['url'])) : ?>

            <img
              src="<?php echo esc_url($icon['url']); ?>"
              alt="<?php the_title_attribute(); ?>"
              class="w-7 h-7 object-contain brightness-0 invert">

          <?php endif; ?>

        </a>

      <?php endwhile; ?>

    </div>

  <?php
    wp_reset_postdata();
  endif;
  ?>

  <p class="text-[11px] text-[#ffffff] underline underline-offset-2 tracking-wide">
    Terms and Conditions & Privacy policy
  </p>

</div>

 
<!-- Bottom Bar -->
<div class="border-t border-[#212121] text-center text-xs text-white py-8 tracking-wide font-light">
  Copyright <?php echo date("Y"); ?>. Jagdamba Global FZE | All Rights Reserved.
</div>

</footer>

<?php wp_footer(); ?>
<script>
function scrollToAbout() {
  document.getElementById("about").scrollIntoView({
    behavior: "smooth"
  });
}


</script>
</body>
</html>