<?php
/*
Template Name: Contact Us
*/

get_header();

$hero_title = get_field('contact_hero_title');
$hero_bg = get_field('contact_hero_bg');

$small_title = get_field('contact_small_title');
$main_title = get_field('contact_main_title');

$email = get_field('contact_email');
$phone1 = get_field('contact_phone_1');
$phone2 = get_field('contact_phone_2');
$address = get_field('contact_address');

$email_icon = get_field('contact_email_icon');
$phone_icon = get_field('contact_phone_icon');
$address_icon = get_field('contact_address_icon');

$map_iframe = get_field('contact_map_iframe');
?>
<section
  class="relative w-full h-[300px] md:h-[350px] bg-cover bg-center overflow-hidden flex items-center"
  style="background-image:url('<?php echo esc_url($hero_bg['url']); ?>');">

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

<section class="py-20 bg-[#f7f7f7]">

  <div class="max-w-7xl mx-auto px-6">

    <div class="grid lg:grid-cols-3 gap-16">

      <!-- LEFT -->
      <div class="lg:col-span-2">

        <p
          class="text-sm text-[#000000] tracking-wide mb-3 font-medium font-montserrat">
          <?php echo esc_html($small_title); ?>
        </p>

        <h2
          class="text-3xl md:text-3xl font-semibold text-green-700 mb-14 max-w-3xl leading-tight font-montserrat">
          <?php echo esc_html($main_title); ?>
        </h2>

        <!-- FORM -->
        <div class="contact-form-wrapper">

          <form class="space-y-6">

            <!-- ROW 1 -->
            <div class="grid md:grid-cols-2 gap-5">

              <div>

                <label
                  class="block text-sm text-black mb-2 font-medium font-montserrat">
                  First Name
                </label>

                <input
                  type="text"
                  placeholder="Enter first name"
                  class="w-full h-[50px] px-6 rounded-full border border-[#888888] bg-white focus:outline-none focus:border-green-700 font-roboto">

              </div>

              <div>

                <label
                  class="block text-sm text-black mb-2 font-medium font-montserrat">
                  Last Name
                </label>

                <input
                  type="text"
                  placeholder="Enter last name"
                  class="w-full h-[50px] px-6 rounded-full border border-[#888888] bg-white focus:outline-none focus:border-green-700 font-roboto">

              </div>

            </div>

            <!-- ROW 2 -->
            <div class="grid md:grid-cols-2 gap-5">

              <div>

                <label
                  class="block text-sm text-black mb-2 font-medium font-montserrat">
                  Email Address
                </label>

                <input
                  type="email"
                  placeholder="Enter email address"
                  class="w-full h-[50px] px-6 rounded-full border border-[#888888] bg-white focus:outline-none focus:border-green-700 font-roboto">

              </div>

              <div>

                <label
                  class="block text-sm text-black mb-2 font-medium font-montserrat">
                  Phone Number
                </label>

                <input
                  type="text"
                  placeholder="Enter phone number"
                  class="w-full h-[50px] px-6 rounded-full border border-[#888888] bg-white focus:outline-none focus:border-green-700 font-roboto">

              </div>

            </div>

            <!-- SUBJECT -->
            <div>

              <label
                class="block text-sm text-black mb-2 font-medium font-montserrat">
                Subject
              </label>

              <select
                class="w-full h-[50px] px-6 rounded-full border border-[#888888] bg-white focus:outline-none focus:border-green-700 font-roboto">

                <option>Select Subject</option>
                <option>General Inquiry</option>
                <option>Sales Inquiry</option>
                <option>Support</option>
                <option>Partnership</option>

              </select>

            </div>

            <!-- MESSAGE -->
            <div>

              <label
                class="block text-sm text-black mb-2 font-medium font-montserrat">
                Message
              </label>

              <textarea
                rows="8"
                placeholder="Write your message..."
                class="w-full px-6 py-5 rounded-[28px] border border-[#888888] bg-white focus:outline-none focus:border-green-700 resize-none font-roboto"></textarea>

            </div>

            <!-- BUTTONS -->
            <div class="flex items-center gap-4 pt-2">

              <button
                type="reset"
                class="px-10 h-[45px] rounded-full bg-[#888888] text-white text-sm font-regular hover:bg-gray-600 transition font-roboto">

                Reset

              </button>

              <button
                type="submit"
                class="px-10 h-[45px] rounded-full bg-green-700 text-white text-sm font-regular hover:bg-green-800 transition font-roboto">

                Send Message

              </button>

            </div>

          </form>

        </div>

      </div>

      <!-- RIGHT -->
      <div>

        <div class="space-y-12 pt-10">

          <!-- EMAIL -->
          <?php if ($email): ?>

            <div class="block">

              <?php if (!empty($email_icon['url'])): ?>

                <div class="shrink-0">

                  <img
                    src="<?php echo esc_url($email_icon['url']); ?>"
                    alt=""
                    class="w-10 h-10 object-contain">

                </div>

              <?php endif; ?>

              <div>

                <p
                  class="text-[16px] text-gray-700 leading-relaxed font-montserrat">
                  <?php echo esc_html($email); ?>
                </p>

              </div>

            </div>

          <?php endif; ?>

          <!-- PHONE -->
          <?php if ($phone1 || $phone2): ?>

            <div class="block">

              <?php if (!empty($phone_icon['url'])): ?>

                <div class="shrink-0">

                  <img
                    src="<?php echo esc_url($phone_icon['url']); ?>"
                    alt=""
                    class="w-10 h-10 object-contain">

                </div>

              <?php endif; ?>

              <div class="space-y-1">

                <?php if ($phone1): ?>

                  <p
                    class="text-[17px] font-semibold text-gray-800 leading-relaxed font-montserrat">
                    <?php echo esc_html($phone1); ?>
                  </p>

                <?php endif; ?>

                <?php if ($phone2): ?>

                  <p
                    class="text-[17px] font-semibold text-gray-800 leading-relaxed font-montserrat">
                    <?php echo esc_html($phone2); ?>
                  </p>

                <?php endif; ?>

              </div>

            </div>

          <?php endif; ?>

          <!-- ADDRESS -->
          <?php if ($address): ?>

            <div class="block gap-5">

              <?php if (!empty($address_icon['url'])): ?>

                <div class="shrink-0">

                  <img
                    src="<?php echo esc_url($address_icon['url']); ?>"
                    alt=""
                    class="w-10 h-10 object-contain">

                </div>

              <?php endif; ?>

              <div>

                <p
                  class="text-[16px] text-gray-700 whitespace-pre-line leading-relaxed font-montserrat">
                  <?php echo esc_html($address); ?>
                </p>

              </div>

            </div>

          <?php endif; ?>

          <!-- SOCIAL -->
          <div class="pt-6">

            <h3
              class="text-lg font-semibold text-gray-800 mb-5 font-montserrat">
              Follow Us
            </h3>

            <?php

            $social_query = new WP_Query([
              'post_type'      => 'social_links',
              'posts_per_page' => -1,
              'orderby'        => 'menu_order',
              'order'          => 'ASC',
            ]);

            if ($social_query->have_posts()) :
            ?>

              <div class="flex items-center gap-4">

                <?php
                while ($social_query->have_posts()) :
                  $social_query->the_post();

                  $icon = get_field('social_icon');
                  $link = get_field('social_link');
                ?>

                  <a
                    href="<?php echo esc_url($link); ?>"
                    target="_blank"
                    class="hover:opacity-70 transition">

                    <?php if (!empty($icon['url'])) : ?>

                      <img
                        src="<?php echo esc_url($icon['url']); ?>"
                        alt="<?php the_title_attribute(); ?>"
                        class="h-5 object-contain brightness-0 opacity-90">

                    <?php endif; ?>

                  </a>

                <?php endwhile; ?>

              </div>

            <?php
              wp_reset_postdata();
            endif;
            ?>

          </div>

        </div>

      </div>

    </div>

    <!-- MAP -->
    <?php if ($map_iframe): ?>

      <div class="mt-24 overflow-hidden rounded-sm">

        <?php echo $map_iframe; ?>

      </div>

    <?php endif; ?>

  </div>

</section>

<?php get_footer(); ?>