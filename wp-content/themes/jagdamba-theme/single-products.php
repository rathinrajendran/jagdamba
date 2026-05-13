<?php get_header();

$thumb = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: get_template_directory_uri() . '/assets/images/default.jpg';
$application = get_post_meta(get_the_ID(), '_product_application', true);
$selected_cat_id = get_post_meta(get_the_ID(), '_product_category', true);
?>

<section class="relative h-[260px] md:h-[340px] overflow-hidden">
  <img src="<?php echo esc_url($thumb); ?>" class="absolute inset-0 w-full h-full object-cover">
  <div class="absolute inset-0 bg-black/55"></div>
  <div class="relative z-10 h-full flex items-end px-6 pb-10 max-w-7xl mx-auto w-full">
    <h1 class="text-white text-4xl md:text-5xl font-bold" style="font-family:'Montserrat',sans-serif;">
      Our Products
    </h1>
  </div>
</section>

<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">

    <div class="mb-12">
      <p class="text-xs uppercase tracking-[0.3em] text-gray-400 mb-2">Our Products</p>
      <h2 class="text-2xl md:text-3xl font-bold text-green-700 leading-tight max-w-3xl" style="font-family:'Montserrat',sans-serif;">
        Number 1 Trailer Brand in India now presenting TitanTrans Trailer Range in UAE
      </h2>
    </div>

<div class="relative py-16 overflow-hidden">

    <div class="max-w-7xl mx-auto px-6 relative">

        <!-- GREEN CONTENT BOX -->
        <div class="absolute right-0 top-1/2 -translate-y-1/2
                    w-[72%] min-h-[520px]
                    bg-[#e6efe7]
                    z-10">

            <!-- diagonal -->
            <div class="absolute top-0 left-0 w-[140px] h-[140px] bg-[#f5f5f5] clip-diagonal"></div>

            <!-- content -->
            <div class="pl-[42%] pr-14 py-16">

                <h2 class="text-2xl md:text-3xl font-bold text-green-700 leading-tight max-w-3xl">
                    <?php the_title(); ?>
                </h2>
                
                <?php if ($application) : ?>

                    <div class="border-t border-gray-400/30 pt-8 mb-8">

                        <h3 class="text-2xl font-bold text-black mb-4">
                            Application:
                        </h3>

                        <p class="text-gray-700 leading-relaxed">
                            <?php echo esc_html($application); ?>
                        </p>

                    </div>

                <?php endif; ?>

                <div class="border-t border-gray-400/30 pt-8 prose prose-sm max-w-none text-gray-700">
                    <?php the_content(); ?>
                </div>

            </div>

        </div>

        <!-- IMAGE -->
        <div class="relative z-30 w-[58%]">

            <img
                src="<?php echo esc_url($thumb); ?>"
                alt="<?php the_title_attribute(); ?>"
                class="w-full h-auto object-contain">

        </div>

    </div>

</div>
  </div>
</section>

<section class="pb-24 bg-white overflow-hidden">
  <div class="max-w-7xl mx-auto p-6">

    <div class="flex items-center justify-between mb-5">
      <h3 class="text-2xl font-semibold text-black"
        style="font-family:'Montserrat',sans-serif;">
        Related Products
      </h3>

      <!-- <div class="flex items-center gap-3">
        <button class="related-prev w-11 h-11 rounded-full border border-gray-300 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all">
          &#8249;
        </button>
        <button class="related-next w-11 h-11 rounded-full border border-gray-300 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all">
          &#8250;
        </button>
      </div> -->
    </div>

    <div class="swiper relatedProductsSlider">
      <div class="swiper-wrapper">

        <?php
        $related_query = new WP_Query([
          'post_type'      => 'products',
          'posts_per_page' => 8,
          'post__not_in'   => [get_the_ID()],
          'meta_query'     => [
            [
              'key'   => '_product_category',
              'value' => $selected_cat_id
            ]
          ]
        ]);

        if ($related_query->have_posts()) :
          while ($related_query->have_posts()) :
            $related_query->the_post();

            $rel_thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
        ?>

            <div class="swiper-slide h-auto">
              <div class="bg-[#f5f5f5] h-full group overflow-hidden">

                <div class="h-[260px] flex items-center justify-center p-8 overflow-hidden bg-[#f7f7f7]">
                  <img
                    src="<?php echo esc_url($rel_thumb); ?>"
                    alt="<?php the_title_attribute(); ?>"
                    class="max-h-full object-contain group-hover:scale-105 transition-all duration-500">
                </div>

                <div class="p-6 flex items-center justify-between">

                  <h4 class="text-xl font-bold text-black capitalize leading-snug overflow-hidden text-ellipsis [display:-webkit-box] [-webkit-line-clamp:2] [-webkit-box-orient:vertical]">
                    <?php the_title(); ?>
                  </h4>

                  <a href="<?php the_permalink(); ?>"
                    class="inline-flex items-center justify-center whitespace-nowrap bg-green-600 hover:bg-green-700 text-white text-xs capitalize tracking-wide px-5 py-3 rounded-full transition-all duration-300">
                    View Details
                  </a>

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

<script>
  window.addEventListener('load', function() {

    const relatedEl = document.querySelector('.relatedProductsSlider');

    if (!relatedEl || typeof Swiper === 'undefined') return;

    new Swiper(relatedEl, {

      loop: true,

      speed: 700,
      spaceBetween: 15,

      autoplay: {
        delay: 150000,
        disableOnInteraction: false,
      },

      navigation: {
        nextEl: '.related-next',
        prevEl: '.related-prev',
      },

      pagination: {
        el: '.related-pagination',
        clickable: true,
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
        }

      }

    });

  });
</script>

<?php get_footer(); ?>