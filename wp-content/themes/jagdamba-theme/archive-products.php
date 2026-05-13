<?php
/**
 * Template Name: Products Page
 */
get_header(); ?>

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-16">
            <p class="text-xs uppercase tracking-[0.3em] text-gray-400 mb-4">Our Products</p>
            <h2 class="text-3xl md:text-5xl font-bold text-green-700 leading-tight max-w-5xl" style="font-family:'Montserrat',sans-serif;">
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
            <?php if (!empty($categories)) : foreach ($categories as $category) : 
                $image = get_field('category_image', $category->ID);
                $image_url = !empty($image['url']) ? $image['url'] : get_template_directory_uri() . '/assets/images/default-product.jpg';
                $description = get_field('category_description', $category->ID);
            ?>
                <div class="bg-[#f5f5f5] overflow-hidden group">
                    <div class="h-[280px] flex items-center justify-center p-8 overflow-hidden">
                        <img src="<?php echo esc_url($image_url); ?>" class="max-h-full object-contain group-hover:scale-105 transition-all duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between gap-4">
                            <h3 class="text-xl md:text-2xl font-semibold text-black"><?php echo esc_html($category->post_title); ?></h3>
                            <a href="<?php echo esc_url(get_permalink($category->ID)); ?>" class="inline-flex whitespace-nowrap bg-green-600 text-white text-xs px-4 py-2 rounded-full">
                                View Details
                            </a>
                        </div>
                        <?php if ($description) : ?>
                            <p class="text-gray-600 text-sm mt-4"><?php echo esc_html($description); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; else : ?>
                <div class="col-span-2 text-center py-24"><h3 class="text-3xl text-gray-500">No Categories Found</h3></div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>