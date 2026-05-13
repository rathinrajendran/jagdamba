<?php

/**
 * Template Name: About Page
 */

get_header();

/* ==========================================================================
   HERO
   ========================================================================== */

$hero_title = get_field('about_hero_title');

$hero_bg = get_field('about_hero_bg');

$hero_bg_url = $hero_bg['url'] ?? '';

if (!$hero_bg_url) {

  $hero_bg_url = get_template_directory_uri()
    . '/assets/images/about-banner.jpg';
}

/* ==========================================================================
   STORY
   ========================================================================== */

$small_title = get_field('about_small_title');

$main_title = get_field('about_main_title');

$description = get_field('about_description');

$story_image = get_field('about_story_image');

/* ==========================================================================
   VISION & MISSION
   ========================================================================== */

$vision_image = get_field('vision_image');

$vision_title = get_field('vision_title');

$vision_description = get_field(
  'vision_description'
);

$mission_title = get_field(
  'mission_title'
);

$mission_description = get_field(
  'mission_description'
);

/* WHY IMAGE */
$why_image = get_field(
  'why_choose_image'
);
?>

<!-- HERO -->
<section
  class="relative w-full h-[300px] md:h-[350px] bg-cover bg-center overflow-hidden flex items-center"
  style="background-image:url('<?php echo esc_url($hero_bg_url); ?>');">

  <div class="absolute inset-0 bg-black/65"></div>

  <div class="relative z-10 w-full max-w-4xl mx-auto px-6 md:px-10">

    <div class="max-w-3xl">

      <h1
        class="text-white text-5xl md:text-5xl font-bold leading-tight font-montserrat">

        <?php echo esc_html($hero_title); ?>

      </h1>

    </div>

  </div>

</section>

<!-- ABOUT -->
<section class="py-20 bg-white">

  <div class="max-w-7xl mx-auto px-6">

    <div class="grid md:grid-cols-2 gap-14 items-center">

      <!-- LEFT -->
      <div>

        <p
          class="text-sm text-[#000000] tracking-wide mb-3 font-medium font-montserrat">

          <?php echo esc_html($small_title); ?>

        </p>

        <h2
          class="text-3xl md:text-4xl font-semibold text-green-700 leading-tight mb-8 font-montserrat">

          <?php echo nl2br(esc_html($main_title)); ?>

        </h2>

        <div class="space-y-5">

          <?php echo wp_kses_post($description); ?>

        </div>

      </div>

      <!-- RIGHT -->
      <div class="relative">

        <img
          src="<?php echo get_template_directory_uri(); ?>/assets/icons/layer.png"
          class="w-[20%] absolute -top-[15px] -left-[15px]"
          alt="">

        <div class="bg-white">

          <?php if ($story_image): ?>

            <img
              src="<?php echo esc_url($story_image['url']); ?>"
              alt=""
              class="relative w-full bg-white">

          <?php endif; ?>

        </div>

      </div>

    </div>

  </div>

</section>

<!-- VISION & MISSION -->
<section class="py-5 relative overflow-hidden bg-white">

  <!-- BG SHAPE -->
  <div class="absolute left-0 top-0 w-[32%] h-[65%] bg-[#edf7ff] z-0"></div>

  <div class="max-w-7xl mx-auto px-6 relative z-10">

    <div class="grid md:grid-cols-2 gap-16">

      <!-- IMAGE -->
      <div class="relative mt-10">

        <?php if ($vision_image): ?>

          <img
            src="<?php echo esc_url($vision_image['url']); ?>"
            alt=""
            class="w-full object-cover">

        <?php endif; ?>

      </div>

      <!-- CONTENT -->
      <div>

        <!-- VISION -->
        <div class="mb-12">

          <h3
            class="text-3xl md:text-4xl font-semibold text-green-700 mb-5 font-montserrat">

            <?php echo esc_html($vision_title); ?>

          </h3>

          <p
            class="text-gray-600 leading-8 font-roboto text-[15px]">

            <?php echo esc_html($vision_description); ?>

          </p>

        </div>

        <!-- MISSION -->
        <div>

          <h3
            class="text-3xl md:text-4xl font-semibold text-green-700 mb-5 font-montserrat">

            <?php echo esc_html($mission_title); ?>

          </h3>

          <p
            class="text-gray-600 leading-8 font-roboto text-[15px]">

            <?php echo esc_html($mission_description); ?>

          </p>

        </div>

      </div>

    </div>

  </div>

</section>

<!-- STATISTICS -->
<section class="py-20 bg-white">

  <div class="max-w-7xl mx-auto px-6">

    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

      <?php
      $stats = new WP_Query([
        'post_type' => 'statistics',
        'posts_per_page' => 4,
        'order' => 'ASC',
      ]);

      if ($stats->have_posts()) :
        while ($stats->have_posts()) :
          $stats->the_post();

          $number = get_field('stat_number');
          $text   = get_field('stat_text');
      ?>

          <div class="bg-[#edf5ef] p-8 text-center rounded-sm">

            <h3
              class="text-3xl md:text-4xl font-semibold text-green-700 mb-3 font-montserrat">

              <?php echo esc_html($number); ?>

            </h3>

            <p
              class="text-sm md:text-base text-gray-600 leading-relaxed font-roboto">

              <?php echo esc_html($text); ?>

            </p>

          </div>

      <?php
        endwhile;
        wp_reset_postdata();
      endif;
      ?>

    </div>

  </div>

</section>

<!-- WHY CHOOSE US -->
<section class="py-20 bg-white">

  <div class="max-w-7xl mx-auto px-6">

    <div class="grid md:grid-cols-2 gap-16 items-start">

      <!-- LEFT -->
      <div>

        <h2
          class="text-3xl md:text-4xl font-bold text-green-700 mb-12 font-montserrat">

          Why You Should Choose Us

        </h2>

        <div class="border-t border-gray-300">

          <?php
          $why = new WP_Query([
            'post_type' => 'why_choose_us',
            'posts_per_page' => -1,
            'order' => 'ASC',
          ]);

          if ($why->have_posts()) :
            $index = 0;

            while ($why->have_posts()) :
              $why->the_post();

              $desc = get_field('why_choose_desc');
          ?>

              <div class="border-b border-gray-300 py-6">

                <button
                  class="accordion-btn w-full flex items-center justify-between text-left">

                  <span
                    class="text-lg md:text-xl text-gray-900 font-medium font-montserrat">

                    <?php the_title(); ?>

                  </span>

                  <span
                    class="accordion-icon text-green-700 transition-transform duration-300">

                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="w-5 h-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2">

                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 9l-7 7-7-7" />

                    </svg>

                  </span>

                </button>

                <div
                  class="accordion-content <?php echo $index === 0 ? '' : 'hidden'; ?> pt-5">

                  <p
                    class="text-gray-600 leading-8 text-[15px] md:text-base font-roboto max-w-2xl">

                    <?php echo esc_html($desc); ?>

                  </p>

                </div>

              </div>

          <?php
              $index++;
            endwhile;

            wp_reset_postdata();
          endif;
          ?>

        </div>

      </div>

      <!-- RIGHT IMAGE -->
      <div>

        <?php if ($why_image): ?>

          <img
            src="<?php echo esc_url($why_image['url']); ?>"
            alt=""
            class="w-full object-cover">

        <?php endif; ?>

      </div>

    </div>

  </div>

</section>

<script>
  window.addEventListener('load', function() {

    const buttons = document.querySelectorAll('.accordion-btn');

    buttons.forEach((btn, index) => {

      const content = btn.nextElementSibling;
      const icon = btn.querySelector('.accordion-icon');

      // First item open
      if (index === 0) {
        icon.style.transform = 'rotate(180deg)';
      }

      btn.addEventListener('click', function() {

        const isOpen = !content.classList.contains('hidden');

        // Close all
        document.querySelectorAll('.accordion-content')
          .forEach(el => el.classList.add('hidden'));

        document.querySelectorAll('.accordion-icon')
          .forEach(el => {
            el.style.transform = 'rotate(0deg)';
          });

        // Open current
        if (!isOpen) {
          content.classList.remove('hidden');
          icon.style.transform = 'rotate(180deg)';
        }

      });

    });

  });
</script>
<?php get_footer(); ?>
