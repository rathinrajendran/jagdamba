<?php

/**
 * Template Name: Media Gallery Page
 */

get_header();

$page_id = get_the_ID();

/* HERO IMAGE */
$hero_url = get_the_post_thumbnail_url(
  $page_id,
  'full'
);

/* FALLBACK IMAGE */
if (!$hero_url) {

  $hero_url = get_template_directory_uri()
    . '/assets/images/gallery-banner.jpg';
}

/* HERO TITLE */
$hero_title = get_the_title();

if (!$hero_title) {
  $hero_title = 'Media & Gallery';
}

?>

<!-- HERO SECTION -->
<section
  class="relative w-full h-[300px] md:h-[350px] bg-cover bg-center overflow-hidden flex items-center"
  style="background-image:url('<?php echo esc_url($hero_url); ?>');">

  <!-- OVERLAY -->
  <div class="absolute inset-0 bg-black/65"></div>

  <!-- CONTENT -->
  <div class="relative z-10 w-full max-w-4xl mx-auto px-6 md:px-10">

    <div class="max-w-3xl">

      <h1
        class="text-white text-5xl md:text-5xl font-bold leading-tight font-montserrat">

        <?php echo esc_html($hero_title); ?>

      </h1>

    </div>

  </div>

</section>

<!-- GALLERY -->
<section class="py-16 md:py-24 bg-[#f5f5f5]">

  <div class="max-w-7xl mx-auto px-4 md:px-6">

    <!-- GRID -->
    <div
      id="gallery-grid"
      class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-3">

      <?php

      $per_page = 8;

      $gallery_query = new WP_Query([
        'post_type'      => 'gallery',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
      ]);

      $gallery_count = 0;

      if ($gallery_query->have_posts()) :

        while ($gallery_query->have_posts()) :

          $gallery_query->the_post();

          $gallery_count++;

          /* FEATURED IMAGE */
          $image = get_the_post_thumbnail_url(
            get_the_ID(),
            'large'
          );

          /* FALLBACK TO EDITOR IMAGE */
          if (!$image) {

            $content = get_the_content();

            preg_match(
              '/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i',
              $content,
              $matches
            );

            $image = $matches['src'] ?? '';
          }

          /* FINAL FALLBACK */
          if (!$image) {

            $image = get_template_directory_uri()
              . '/assets/images/default.jpg';
          }

          $video = get_field('video_url');

          $hidden = $gallery_count > $per_page
            ? 'style="display:none;"'
            : '';

      ?>

          <!-- ITEM -->
          <div
            class="gallery-item block cursor-pointer"
            data-image="<?php echo esc_url($image); ?>"
            data-video="<?php echo esc_url($video); ?>"
            <?php echo $hidden; ?>>

            <div
              class="relative overflow-hidden bg-white transition-all duration-500 group">

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
              <?php if ($video) : ?>

                <div
                  class="absolute inset-0 flex items-center justify-center">

                  <div
                    class="w-14 h-14 rounded-full bg-white/90 flex items-center justify-center text-black text-xl  backdrop-blur-sm">
                    ▶
                  </div>

                </div>

              <?php endif; ?>

            </div>

          </div>

      <?php

        endwhile;

        wp_reset_postdata();

      endif;

      ?>

    </div>

    <!-- LOAD MORE -->
    <?php if ($gallery_count > $per_page) : ?>

      <div class="text-center mt-14">

        <button
          id="load-more-gallery"
          class="bg-green-600 hover:bg-green-700 text-white text-sm md:text-base px-8 py-3 transition-all duration-300 rounded-full">
          Load More
        </button>

      </div>

    <?php endif; ?>

  </div>

</section>

<!-- GALLERY MODAL -->
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
    | LOAD MORE
    |--------------------------------------------------------------------------
    */

    const btn = document.getElementById(
      'load-more-gallery'
    );

    if (btn) {

      btn.addEventListener('click', function() {

        const hiddenItems = Array.from(
          document.querySelectorAll('.gallery-item')
        ).filter(item => item.style.display === 'none');

        hiddenItems
          .slice(0, 8)
          .forEach(item => {
            item.style.display = 'block';
          });

        if (hiddenItems.length <= 8) {
          btn.style.display = 'none';
        }

      });

    }

    /*
    |--------------------------------------------------------------------------
    | MODAL SLIDER
    |--------------------------------------------------------------------------
    */

    const items = document.querySelectorAll('.gallery-item');

    const modal = document.getElementById(
      'gallery-modal'
    );

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

<?php get_footer(); ?>