<?php

/**
 * Template Name: Products Page
 */

get_header();

/*
|--------------------------------------------------------------------------
| PAGE SETTINGS
|--------------------------------------------------------------------------
*/

$page_id = 296; 

$hero_title = get_field('products_hero_title', $page_id);
$hero_desc  = get_field('products_hero_description', $page_id);
$hero_bg    = get_field('products_hero_bg', $page_id);


?>

<!-- HERO SECTION -->
<section
    class="relative w-full h-[320px] md:h-[420px] bg-cover bg-center overflow-hidden flex items-center"
    style="background-image:url('<?php echo esc_url($hero_bg['url'] ?? ''); ?>');">

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/65"></div>

    <!-- CONTENT -->
    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 md:px-10">

        <div class="max-w-3xl">

            <!-- HERO TITLE -->
            <h1
                class="text-white text-4xl md:text-6xl font-bold leading-tight font-montserrat">

                <?php echo esc_html($hero_title ?: 'Our Products'); ?>

            </h1>

            <!-- HERO DESCRIPTION -->
            <?php if ($hero_desc) : ?>

                <p
                    class="text-white/80 text-base md:text-lg leading-8 mt-6 max-w-2xl">

                    <?php echo esc_html($hero_desc); ?>

                </p>

            <?php endif; ?>

        </div>

    </div>

</section>

<!-- CATEGORY LISTING -->
<section class="py-24 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        <!-- SECTION HEADER -->
        <div class="mb-16">

            <p
                class="text-xs uppercase tracking-[0.3em] text-gray-400 mb-4">



            </p>

            <h2
                class="text-3xl md:text-5xl font-bold text-green-700 leading-tight max-w-5xl"
                style="font-family:'Montserrat',sans-serif;">

                Number 1 Trailer Brand in India now presenting TitanTrans Trailer Range in UAE

            </h2>

        </div>

        <?php

        $categories = get_posts([
            'post_type'      => 'product_categories',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'title',
            'order'          => 'ASC',
        ]);

        ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <?php if (!empty($categories)) : ?>

                <?php foreach ($categories as $category) :

                    $image = get_field(
                        'category_image',
                        $category->ID
                    );

                    $image_url = !empty($image['url'])
                        ? $image['url']
                        : get_template_directory_uri() . '/assets/images/default-product.jpg';

                    $description = get_field(
                        'category_description',
                        $category->ID
                    );

                ?>

                    <!-- CATEGORY CARD -->
                    <div
                        class="bg-[#f5f5f5] overflow-hidden group transition-all duration-500 hover:shadow-2xl">

                        <!-- IMAGE -->
                        <div
                            class="h-[280px] flex items-center justify-center p-8 overflow-hidden">

                            <img
                                src="<?php echo esc_url($image_url); ?>"
                                alt="<?php echo esc_attr($category->post_title); ?>"
                                class="max-h-full object-contain group-hover:scale-105 transition-all duration-500">

                        </div>

                        <!-- CONTENT -->
                        <div class="p-6">

                            <div
                                class="flex items-center justify-between gap-4 flex-wrap">

                                <h3
                                    class="text-xl md:text-2xl font-semibold text-black">

                                    <?php echo esc_html($category->post_title); ?>

                                </h3>

                                <a
                                    href="<?php echo esc_url(get_permalink($category->ID)); ?>"
                                    class="inline-flex whitespace-nowrap bg-green-600 hover:bg-green-700 transition-all duration-300 text-white text-xs px-5 py-3 rounded-full">

                                    View Details

                                </a>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <div class="col-span-2 text-center py-24">

                    <h3 class="text-3xl text-gray-500">

                        No Categories Found

                    </h3>

                </div>

            <?php endif; ?>

        </div>

    </div>

</section>

<?php get_footer(); ?>