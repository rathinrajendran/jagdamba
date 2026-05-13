<?php
/**
 * Template for displaying the list of products within a specific category
 * UI matched to archive-products.php
 */
get_header();

$cat_id = get_the_ID(); 
?>

<section class="py-24 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="mb-16">

            <p          class="text-sm text-[#000000] tracking-wide mb-3 font-medium font-montserrat">
                <?php the_title(); ?>
            </p>

            <h2
                class="text-3xl md:text-3xl font-semibold text-green-700 mb-5 max-w-3xl leading-tight font-montserrat">
                <?php the_title(); ?> Range
            </h2>

        </div>

        <?php
        $products = new WP_Query([
            'post_type'      => 'products',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'meta_query'     => [
                [
                    'key'   => '_product_category',
                    'value' => $cat_id,
                ]
            ]
        ]);
        ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <?php if ($products->have_posts()) : ?>

                <?php while ($products->have_posts()) : $products->the_post(); ?>

                    <div class="bg-[#f5f5f5] overflow-hidden transition-all duration-500 group">

                        <div class="h-[280px] flex items-center justify-center p-8 overflow-hidden">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium_large', [
                                    'class' => 'max-h-full object-contain group-hover:scale-105 transition-all duration-500'
                                ]); ?>
                            <?php else : ?>
                                <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/default-product.jpg"
                                    class="max-h-full object-contain group-hover:scale-105 transition-all duration-500">
                            <?php endif; ?>
                        </div>

                        <div class="p-6">

                            <div class="flex items-center justify-between gap-4">

                                <h3
                                    class="text-xl md:text-2xl font-semibold text-black leading-snug"
                                    style="font-family:'Montserrat',sans-serif;">
                                    <?php the_title(); ?>
                                </h3>

                                <a
                                    href="<?php the_permalink(); ?>"
                                    class="bg-green-600 hover:bg-green-700 text-white text-xs px-4 py-2 rounded-full whitespace-nowrap transition-all duration-300">
                                    View Details
                                </a>

                            </div>

                        </div>

                    </div>

                <?php endwhile; wp_reset_postdata(); ?>

            <?php else : ?>

                <div class="col-span-2 text-center py-24">
                    <h3 class="text-3xl font-semibold text-gray-500">
                        No Products Found in this Range
                    </h3>
                </div>

            <?php endif; ?>

        </div>

    </div>

</section>

<?php get_footer(); ?>