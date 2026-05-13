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

<?php
$hero_title = get_field("home_hero_title");
$hero_bg    = get_field("home_hero_bg");

$image_url = !empty($hero_bg["url"])
  ? $hero_bg["url"]
  : "";
?>

<section class="swiper myHeroSlider relative">

  <div class="swiper-wrapper">

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
                <?php echo esc_html($hero_title); ?>
              </h1>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

  <div class="swiper-pagination !bottom-8"></div>

  <div class="scroll-down mt-[-55px] relative z-20 flex justify-center">
    <div class="scroll cursor-pointer" onclick="scrollToAbout()">
      <img
        src="<?php echo get_template_directory_uri(); ?>/assets/icons/down.png"
        class="w-[15px] object-contain"
        alt="Scroll Down">
    </div>
  </div>

  <div class="swiper-pagination-block h-[60px] relative">
    <div class="swiper-pagination"></div>
  </div>

</section>

<!-- ─── ABOUT ─────────────────────────────────────────────────────────────── -->

<?php
$about_subtitle = get_field("home_about_subtitle");
$about_title    = get_field("home_about_title");
$about_desc     = get_field("home_about_description");
$about_btn      = get_field("home_about_button_text");
$about_img      = get_field("home_about_image");
?>

<section id="about" class="py-10 text-center">

  <div class="max-w-4xl mx-auto px-6 pb-5">

    <?php if ($about_subtitle): ?>
      <p class="text-sm mb-2 font-medium">
        <?php echo esc_html($about_subtitle); ?>
      </p>
    <?php endif; ?>

    <?php if ($about_title): ?>
      <h2 class="text-3xl md:text-4xl font-semibold text-green-600">
        <?php echo esc_html($about_title); ?>
      </h2>
    <?php endif; ?>

    <?php if ($about_desc): ?>
      <div class="mt-4 text-gray-600">
        <?php echo wp_kses_post($about_desc); ?>
      </div>
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

<!-- ─── PRODUCT CATEGORIES ───────────────────────────────────────────────── -->
<section class="py-5 px-6 max-w-7xl mx-auto space-y-20">

  <?php
  $query = new WP_Query([
    "post_type"      => "product_categories",
    "posts_per_page" => -1,
    "post_status"    => "publish",
    "orderby"        => "title",
    "order"          => "ASC",
  ]);

  $index = 0;

  if ($query->have_posts()):
    while ($query->have_posts()):

      $query->the_post();

      $reverse = $index % 2 != 0;

      $image = get_field("category_image");

      $image_url = !empty($image['url'])
        ? $image['url']
        : get_template_directory_uri() . '/assets/images/default-product.jpg';

      $content = get_field("category_description");
  ?>

      <div class="grid md:grid-cols-2 gap-10 items-center">

        <?php if (!$reverse && $image_url): ?>

          <img
            src="<?php echo esc_url($image_url); ?>"
            class="w-full shadow-md"
            alt="<?php the_title_attribute(); ?>">

        <?php endif; ?>

        <div class="text-center px-10">

          <h3 class="text-2xl md:text-3xl font-semibold text-green-600">
            <?php the_title(); ?>
          </h3>

          <div class="text-gray-600 mt-4">
            <?php echo wp_kses_post($content); ?>
          </div>

          <a
            href="<?php the_permalink(); ?>"
            class="mt-6 inline-block bg-green-600 text-white px-6 py-2 rounded-full">

            Know more

          </a>

        </div>

        <?php if ($reverse && $image_url): ?>

          <img
            src="<?php echo esc_url($image_url); ?>"
            class="w-full shadow-md"
            alt="<?php the_title_attribute(); ?>">

        <?php endif; ?>

      </div>

  <?php
      $index++;
    endwhile;

    wp_reset_postdata();
  endif;
  ?>

</section>

<!-- FEATURE BANNER -->

<?php
$banner      = get_field("home_feature_image");
$banner_text = get_field("home_feature_title");
?>

<section
  class="relative mt-20 h-screen bg-cover bg-center flex items-center justify-center overflow-hidden"
  style="background-image:url('<?php echo !empty($banner['url']) ? esc_url($banner['url']) : ''; ?>')">

  <div class="absolute l-0 r-0 h-100 w-100">
    <img
      src="<?php echo get_template_directory_uri(); ?>/assets/icons/quote.png"
      alt="Quote">
  </div>

  <div class="absolute inset-0 bg-black/60"></div>

  <div class="relative z-10 text-center px-6">

    <?php if ($banner_text): ?>

      <h2 class="text-white text-4xl md:text-7xl font-black uppercase leading-tight max-w-5xl mx-auto">
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
                      class="max-h-[260px] w-auto object-contain">
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

<!-- ─── MEDIA GALLERY SLIDER ───────────────────────────────────────────── -->
<section class="py-20 md:py-24 bg-[#f8f8f8]">

  <div class="max-w-7xl mx-auto px-6">

    <!-- HEADING -->
    <div class="flex items-center justify-between mb-12">

      <h2 class="text-3xl md:text-4xl uppercase font-semibold text-green-600">
        Our Media Gallery
      </h2>

      <a
        href="/media-gallery"
        class="hidden md:inline-flex items-center gap-2 text-green-600 font-medium hover:text-green-700 transition-colors">

        View All
        <svg
    xmlns="http://www.w3.org/2000/svg"
    width="20"
    height="20"
    viewBox="0 0 24 24"
    fill="none">

    <path
      d="M8 4L16 12L8 20"
      stroke="currentColor"
      stroke-width="2.5"
      stroke-linecap="round"
      stroke-linejoin="round" />

  </svg>
      </a>

    </div>

    <!-- SWIPER -->
    <div class="swiper mediaGallerySlider overflow-hidden">

      <div class="swiper-wrapper">

        <?php
        $media_query = new WP_Query([
          "post_type"      => "gallery",
          "posts_per_page" => 8,
          "orderby"        => "date",
          "order"          => "DESC",
        ]);

        if ($media_query->have_posts()) :
          while ($media_query->have_posts()) :
            $media_query->the_post();

            $video = get_field("video_url");

            /* FEATURED IMAGE */
            $image = get_the_post_thumbnail_url(
              get_the_ID(),
              "large"
            );

            /* FALLBACK IMAGE */
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

              $image = get_template_directory_uri()
                . "/assets/images/default.jpg";
            }
        ?>

            <div class="swiper-slide">

              <!-- ITEM -->
              <div
                class="gallery-item cursor-pointer"
                data-image="<?php echo esc_url($image); ?>"
                data-video="<?php echo esc_url($video); ?>">

                <div class="group">

                  <!-- IMAGE -->
                  <div class="relative overflow-hidden rounded-md">

                    <img
                      src="<?php echo esc_url($image); ?>"
                      alt="<?php the_title_attribute(); ?>"
                      class="w-full h-[260px] object-cover group-hover:scale-105 transition-all duration-500">

                    <!-- OVERLAY -->
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-500"></div>

                    <!-- PLAY ICON -->
                    <div class="absolute inset-0 flex items-center justify-center">

                      <div class="w-16 h-16 rounded-full border-4 border-white flex items-center justify-center">

                        <span class="text-white text-3xl leading-none ml-1">
                          ▶
                        </span>

                      </div>

                    </div>

                  </div>

                  <!-- CONTENT -->
                  <div class="pt-5">

                    <h3 class="text-[#0B2C6B] text-lg leading-snug font-medium">

                      <?php the_title(); ?>

                    </h3>

                    <div class="text-gray-700 text-sm mt-3">

                      <?php echo wp_trim_words(get_the_excerpt(), 8); ?>

                    </div>

                  </div>

                </div>

              </div>

            </div>

        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>

      </div>

    </div>

  </div>

</section>

<!-- ─── GALLERY MODAL ───────────────────────────────────────────────────── -->
<div
  id="gallery-modal"
  class="fixed inset-0 bg-black/95 z-[9999] hidden items-center justify-center p-4">

  <!-- CLOSE -->
  <button
    id="close-gallery-modal"
    class="absolute top-5 right-6 text-white text-5xl leading-none z-50">

    &times;

  </button>

  <!-- PREV -->
  <button
    id="gallery-prev"
    class="absolute left-3 md:left-10 text-white text-5xl z-50">

    ‹

  </button>

  <!-- NEXT -->
  <button
    id="gallery-next"
    class="absolute right-3 md:right-10 text-white text-5xl z-50">

    ›

  </button>

  <!-- CONTENT -->
  <div class="w-full max-w-6xl flex items-center justify-center">

    <!-- IMAGE -->
    <img
      id="gallery-modal-image"
      src=""
      class="max-w-full max-h-[90vh] object-contain hidden">

    <!-- VIDEO -->
    <iframe
      id="gallery-modal-video"
      class="w-full aspect-video hidden rounded-xl"
      allowfullscreen></iframe>

  </div>

</div>

<script>
  window.addEventListener('load', function() {

    /*
    |--------------------------------------------------------------------------
    | SWIPER
    |--------------------------------------------------------------------------
    */

    var mediaEl = document.querySelector('.mediaGallerySlider');

    if (mediaEl && typeof Swiper !== 'undefined') {

      new Swiper(mediaEl, {

        loop: true,

        speed: 800,

        spaceBetween: 24,

        autoplay: {
          delay: 3500,
          disableOnInteraction: false,
        },

        breakpoints: {

          0: {
            slidesPerView: 1,
          },

          640: {
            slidesPerView: 2,
          },

          1024: {
            slidesPerView: 3,
          },

          1280: {
            slidesPerView: 4,
          }

        }

      });

    }

    /*
    |--------------------------------------------------------------------------
    | MODAL
    |--------------------------------------------------------------------------
    */

    const items = document.querySelectorAll('.gallery-item');

    const modal = document.getElementById('gallery-modal');

    const modalImage = document.getElementById(
      'gallery-modal-image'
    );

    const modalVideo = document.getElementById(
      'gallery-modal-video'
    );

    const closeBtn = document.getElementById(
      'close-gallery-modal'
    );

    const nextBtn = document.getElementById(
      'gallery-next'
    );

    const prevBtn = document.getElementById(
      'gallery-prev'
    );

    let currentIndex = 0;

    function showItem(index) {

      const item = items[index];

      const image = item.dataset.image;

      const video = item.dataset.video;

      modal.classList.remove('hidden');
      modal.classList.add('flex');

      if (video) {

        modalVideo.src = video;
        modalVideo.classList.remove('hidden');

        modalImage.classList.add('hidden');

      } else {

        modalImage.src = image;
        modalImage.classList.remove('hidden');

        modalVideo.classList.add('hidden');
        modalVideo.src = '';

      }

      currentIndex = index;

    }

    items.forEach((item, index) => {

      item.addEventListener('click', function() {

        showItem(index);

      });

    });

    nextBtn.addEventListener('click', function() {

      currentIndex++;

      if (currentIndex >= items.length) {
        currentIndex = 0;
      }

      showItem(currentIndex);

    });

    prevBtn.addEventListener('click', function() {

      currentIndex--;

      if (currentIndex < 0) {
        currentIndex = items.length - 1;
      }

      showItem(currentIndex);

    });

    closeBtn.addEventListener('click', function() {

      modal.classList.add('hidden');
      modal.classList.remove('flex');

      modalVideo.src = '';

    });

    modal.addEventListener('click', function(e) {

      if (e.target === modal) {

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        modalVideo.src = '';

      }

    });

  });
</script>

<!-- ─── CLIENTS ───────────────────────────────────────────────────────────── -->
<section class="py-20 bg-[#f7f7f7] overflow-hidden">

  <div class="max-w-7xl mx-auto px-6">

    <div class="flex items-center justify-between mb-12">
      <div>
        <p class="text-sm text-black font-regular  mb-2">
          List of Our
        </p>

        <h2 class="text-3xl md:text-4xl uppercase font-semibold text-green-600  ">
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