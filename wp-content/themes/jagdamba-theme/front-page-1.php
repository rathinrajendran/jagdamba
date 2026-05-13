<?php get_header(); ?>

<!-- ─── HERO CAROUSEL ─────────────────────────────────────────────────────── -->
<?php
$slides = new WP_Query([
  "post_type"      => "hero_banner",
  "posts_per_page" => -1,
  "orderby"        => "menu_order",
  "order"          => "ASC",
]);
?>

<!-- HERO CAROUSEL -->
<style>
  .myHeroSlider,
  .myHeroSlider .swiper-wrapper,
  .myHeroSlider .swiper-slide {
    width: 100%;
    height: 100vh;
  }

  .myHeroSlider .swiper-slide {
    overflow: hidden;
  }

  .hero-overlay {
    background: linear-gradient(to top,
        rgba(0, 0, 0, 0.85) 0%,
        rgba(0, 0, 0, 0.35) 45%,
        rgba(0, 0, 0, 0.1) 100%);
  }
</style>

<?php
$slides = new WP_Query([
  "post_type"      => "hero_banner",
  "posts_per_page" => -1,
  "orderby"        => "menu_order",
  "order"          => "ASC",
]);
?>

<section class="swiper myHeroSlider relative">

  <div class="swiper-wrapper">

    <?php if ($slides->have_posts()): ?>

      <?php while ($slides->have_posts()): $slides->the_post();

        $image_id = get_post_meta(
          get_the_ID(),
          "_hero_banner_image_id",
          true
        );

        $image_url = $image_id
          ? wp_get_attachment_image_url($image_id, "full")
          : "";

      ?>

        <div class="swiper-slide">

          <div
            class="relative w-full h-screen bg-cover bg-center flex items-end"
            style="background-image:url('<?php echo esc_url($image_url); ?>')">

            <div class="absolute inset-0 hero-overlay"></div>

            <div class="relative z-10 w-full">

              <div class="max-w-7xl mx-auto px-6 md:px-10 pb-20 md:pb-28">

                <div class="max-w-[760px] flex items-start">

                  <img
                    src="<?php echo get_template_directory_uri(); ?>/assets/icons/layer.png"
                    class="w-[22px] mt-3 mr-4"
                    alt="">

                  <h1 class="text-white text-5xl md:text-7xl font-bold leading-[0.95]">
                    <?php the_title(); ?>
                  </h1>

                </div>

              </div>

            </div>

          </div>

        </div>

      <?php endwhile;
      wp_reset_postdata(); ?>

    <?php endif; ?>

  </div>

  <div class="swiper-pagination !bottom-8"></div>

</section>

<!-- ─── ABOUT ─────────────────────────────────────────────────────────────── -->
<?php
$about_title = get_field("about_title");
$about_desc = get_field("about_desc");
$about_btn = get_field("about_button_text");
$about_img = get_field("about_image");
?>

<section id="about" class="py-10 text-center">
  <div class="max-w-4xl mx-auto px-6 pb-5">

    <p class="text-sm mb-2 font-medium">about</p>

    <?php if ($about_title): ?>
      <h2 class="text-3xl md:text-4xl font-semibold text-green-600">
        <?php echo esc_html($about_title); ?>
      </h2>
    <?php endif; ?>

    <?php if ($about_desc): ?>
      <p class="mt-4 text-gray-600">
        <?php echo esc_html($about_desc); ?>
      </p>
    <?php endif; ?>

    <?php if ($about_btn): ?>
      <div class="mt-6">
        <button class="px-6 py-2 bg-green-600 text-white rounded-full font-roboto font-regular">
          <?php echo esc_html($about_btn); ?>
        </button>
      </div>
    <?php endif; ?>

  </div>

  <?php if (!empty($about_img['url'])): ?>

    <div class="pt-5 px-6 max-w-7xl mx-auto">

      <img
        src="<?php echo esc_url($about_img['url']); ?>"
        alt="About"
        class="w-full shadow-md rounded-xl object-cover">

    </div>

  <?php endif; ?>
</section>

<!-- ─── SERVICES ──────────────────────────────────────────────────────────── -->
<section class="py-5 px-6 max-w-7xl mx-auto space-y-20">

  <?php
  $query = new WP_Query(["post_type" => "services"]);
  $index = 0;

  if ($query->have_posts()):
    while ($query->have_posts()):

      $query->the_post();

      $reverse = $index % 2 != 0;
      $content = get_the_content();

      // extract first image from content
      preg_match(
        '/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i',
        $content,
        $img_match
      );
      $image_url = !empty($img_match['src'])
        ? $img_match['src']
        : '';
      $content = preg_replace("/<img[^>]+>/i", "", $content);
  ?>

      <div class="grid md:grid-cols-2 gap-10 items-center">

        <?php if (!$reverse && $image_url): ?>
          <img src="<?php echo esc_url(
                      $image_url
                    ); ?>" class="w-full shadow-md">
        <?php endif; ?>

        <div class="text-center px-10">
          <h3 class="text-2xl md:text-3xl font-semibold text-green-600">
            <?php the_title(); ?>
          </h3>

          <div class="text-gray-600 mt-4">
            <?php echo $content; ?>
          </div>

          <a href="<?php the_permalink(); ?>" class="mt-6 inline-block bg-green-600 text-white px-6 py-2 rounded-full">
            Know more
          </a>
        </div>

        <?php if ($reverse && $image_url): ?>
          <img src="<?php echo esc_url(
                      $image_url
                    ); ?>" class="w-full shadow-md">
        <?php endif; ?>

      </div>

  <?php $index++;
    endwhile;
    wp_reset_postdata();
  endif;
  ?>
</section>

<!-- FEATURE BANNER -->
<?php
$banner = get_field("feature_background");
$banner_text = get_field("feature_ttile");
?>

<section
  class="relative mt-20 h-screen bg-cover bg-center flex items-center justify-center overflow-hidden"
  style="background-image:url('<?php echo !empty($banner['url'])
                                  ? esc_url($banner['url'])
                                  : ''; ?>')">
  <div class="absolute l-0 r-0 h-100 w-100">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/quote.png" alt="Scroll Down">
  </div>
  <div class="absolute inset-0 bg-black/60"></div>

  <div class="relative z-10 text-center px-6">

    <?php if ($banner_text): ?>

      <h2
        class="text-white text-4xl md:text-7xl font-black uppercase leading-tight max-w-5xl mx-auto">
        <?php echo esc_html($banner_text); ?>
      </h2>

    <?php endif; ?>

  </div>

</section>

<!-- ─── PRODUCTS SWIPER CAROUSEL ─────────────────────────────────────────── -->
<section class="py-16 bg-[#eaf4f4]">
  <!-- Swiper wrapper with custom prev/next -->
  <div class="relative max-w-6xl mx-auto px-12">

    <!-- Prev Arrow -->
    <button class="swiper-btn-prev-prod absolute left-0 top-1/2 -translate-y-1/2 z-10
                   w-10 h-10 flex items-center justify-center
                   text-gray-500 hover:text-green-600 text-2xl transition-colors"
      aria-label="Previous">&#8249;</button>

    <!-- Swiper -->
    <div class="swiper myProductSlider overflow-hidden rounded-2xl">
      <div class="swiper-wrapper">

        <?php
        $prod_q = new WP_Query([
          "post_type" => "products",
          "posts_per_page" => -1,
          "orderby" => "menu_order",
          "order" => "ASC",
        ]);

        if ($prod_q->have_posts()):
          while ($prod_q->have_posts()):

            $prod_q->the_post();
            $thumb = get_the_post_thumbnail_url(get_the_ID(), "large");
            $excerpt = get_the_excerpt();
            $applic = get_post_meta(
              get_the_ID(),
              "_product_application",
              true
            );
        ?>

            <div class="swiper-slide">
              <div class="bg-[#eaf4f4] grid md:grid-cols-2 gap-0 items-center min-h-[340px]">

                <!-- Left: text -->
                <div class="px-10 py-10 md:py-16">
                  <h3 class="text-2xl md:text-3xl font-bold text-gray-800 leading-snug mb-4">
                    <?php the_title(); ?>
                  </h3>

                  <?php if ($applic): ?>
                    <p class="text-sm font-semibold text-gray-700 mb-1">Application:</p>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                      <?php echo esc_html($applic); ?>
                    </p>
                  <?php elseif ($excerpt): ?>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                      <?php echo wp_trim_words($excerpt, 25); ?>
                    </p>
                  <?php endif; ?>

                  <a href="<?php the_permalink(); ?>"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm px-6 py-2 rounded-full transition-colors duration-200">
                    Know more
                  </a>
                </div>

                <!-- Right: image -->
                <div class="flex items-center justify-center p-6 md:p-10">
                  <?php if ($thumb): ?>
                    <img src="<?php echo esc_url($thumb); ?>"
                      alt="<?php the_title_attribute(); ?>"
                      class="max-h-[260px] w-auto object-contain drop-shadow-lg">
                  <?php endif; ?>
                </div>

              </div>
            </div>

        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>

      </div><!-- /.swiper-wrapper -->

      <!-- Pagination -->
      <div class="swiper-pagination-products pb-4"></div>
    </div><!-- /.swiper -->

    <!-- Next Arrow -->
    <button class="swiper-btn-next-prod absolute right-0 top-1/2 -translate-y-1/2 z-10 w-10 h-10 flex items-center justify-center
                   text-gray-500 hover:text-green-600 text-2xl transition-colors" aria-label="Next">&#8250;</button>
  </div>

</section>



<script>
  window.addEventListener('load', function() {
    var prodEl = document.querySelector('.myProductSlider');
    if (!prodEl || typeof Swiper === 'undefined') return;
    var prodSwiper = new Swiper(prodEl, {
      loop: true,
      speed: 700,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false
      },
      pagination: {
        el: '.swiper-pagination-products',
        clickable: true
      },
      navigation: {
        nextEl: '.swiper-btn-next-prod',
        prevEl: '.swiper-btn-prev-prod',
      },
    });
  });
</script>

<!-- ─── MEDIA GALLERY ───────────────────────────────────────────────────── -->
<section class="py-20 md:py-24 bg-[#f8f8f8]">

  <div class="max-w-7xl mx-auto px-6">

    <!-- HEADING -->
    <div class="flex items-end justify-between mb-12">
      <div>
        <h2
          class="text-3xl md:text-4xl uppercase font-bold text-green-600">
          Our Media Gallery
        </h2>
      </div>
      <a
        href="/media-gallery"
        class="hidden md:inline-flex items-center gap-2 text-green-600 font-medium hover:text-green-700 transition-colors">
        View All
        <span>→</span>
      </a>

    </div>

    <!-- GRID -->
    <div
      class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">

      <?php
      $media_query = new WP_Query([
        "post_type" => "gallery",
        "posts_per_page" => 8,
        "orderby" => "date",
        "order" => "DESC",
      ]);

      if ($media_query->have_posts()):
        while ($media_query->have_posts()):

          $media_query->the_post();

          $video = get_field("video_url");

          /* FEATURED IMAGE */
          $image = get_the_post_thumbnail_url(get_the_ID(), "large");

          /* FALLBACK TO EDITOR IMAGE */
          if (!$image) {
            $content = get_the_content();

            preg_match(
              '/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i',
              $content,
              $matches
            );

            $image = $matches["src"] ?? "";
          }

          /* FINAL FALLBACK */
          if (!$image) {
            $image =
              get_template_directory_uri() .
              "/assets/images/default.jpg";
          }
      ?>

          <!-- ITEM -->
          <a
            href="<?php echo esc_url($video ? $video : $image); ?>"
            target="_blank"
            class="block group">

            <div
              class="relative overflow-hidden rounded-md bg-whitetransition-all duration-500">

              <!-- IMAGE -->
              <img
                src="<?php echo esc_url($image); ?>"
                alt="<?php the_title_attribute(); ?>"
                class="w-full h-[180px] md:h-[260px] object-cover group-hover:scale-110 transition-transform duration-700">

              <!-- OVERLAY -->
              <div
                class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all duration-500"></div>

              <!-- TITLE -->
              <div
                class="absolute bottom-0 left-0 right-0 p-4 opacity-0 group-hover:opacity-100 transition-all duration-500">

                <h3
                  class="text-white text-sm md:text-base font-semibold">
                  <?php the_title(); ?>
                </h3>

              </div>

              <!-- VIDEO ICON -->
              <?php if ($video): ?>

                <div
                  class="absolute inset-0 flex items-center justify-center">

                  <div
                    class="w-14 h-14 rounded-full bg-white/90 flex items-center justify-center text-black text-xl shadow-xl backdrop-blur-sm">
                    ▶
                  </div>

                </div>

              <?php endif; ?>

            </div>

          </a>

      <?php
        endwhile;

        wp_reset_postdata();
      endif;
      ?>

    </div>

    <!-- MOBILE BUTTON -->
    <div class="text-center mt-10 md:hidden">

      <a
        href="/media-gallery"
        class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-full transition-colors">
        View All
      </a>

    </div>

  </div>

</section>

<!-- ─── CLIENTS ───────────────────────────────────────────────────────────── -->
<section class="py-20 bg-[#f7f7f7] overflow-hidden">

  <div class="max-w-7xl mx-auto px-6">

    <div class="flex items-center justify-between mb-12">
      <div>
        <p class="text-sm text-gray-500 font-bold tracking-widest mb-2">
          List of Our
        </p>

        <h2 class="text-3xl md:text-4xl uppercase font-bold text-green-600">
          Major Clients
        </h2>
      </div>

      <a href="/clients"
        class="text-green-600 font-medium hover:underline">
        View All →
      </a>
    </div>

    <div class="swiper myClientsSlider">

      <div class="swiper-wrapper">

        <?php
        $client_query = new WP_Query([
          "post_type" => "clients",
          "posts_per_page" => -1,
          "orderby" => "menu_order",
          "order" => "ASC",
        ]);

        if ($client_query->have_posts()):
          while ($client_query->have_posts()):

            $client_query->the_post();

            $logo = get_the_post_thumbnail_url(get_the_ID(), "medium");
        ?>

            <div class="swiper-slide">

              <div class="h-[120px] flex items-center justify-center px-6">

                <?php if ($logo): ?>

                  <img
                    src="<?php echo esc_url($logo); ?>"
                    alt="<?php the_title_attribute(); ?>"
                    class="max-h-[70px] w-auto object-contain grayscale hover:grayscale-0 transition duration-300">

                <?php endif; ?>

              </div>

            </div>

        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>

      </div>

      <div class="swiper-pagination-clients mt-8"></div>

    </div>

  </div>

</section>
<script>
  window.addEventListener('load', function() {

    var clientEl = document.querySelector('.myClientsSlider');

    if (!clientEl || typeof Swiper === 'undefined') return;

    new Swiper(clientEl, {

      loop: true,

      speed: 800,

      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },

      slidesPerView: 2,
      spaceBetween: 20,

      pagination: {
        el: '.swiper-pagination-clients',
        clickable: true,
      },

      breakpoints: {

        640: {
          slidesPerView: 3,
        },

        768: {
          slidesPerView: 4,
        },

        1024: {
          slidesPerView: 5,
        },

        1280: {
          slidesPerView: 6,
        }

      }

    });

  });
</script>

<?php get_footer(); ?>