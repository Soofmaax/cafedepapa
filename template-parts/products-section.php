<?php
$coffee_products = array();
$shop_url        = home_url( '/' );

if ( function_exists( 'wc_get_products' ) ) {
    $coffee_products = wc_get_products(
        array(
            'status'   => 'publish',
            'limit'    => 3,
            'category' => array( 'cafe' ),
            'orderby'  => 'menu_order',
            'order'    => 'ASC',
        )
    );
    $shop_url        = wc_get_page_permalink( 'shop' );
}

$reveal_delays = array( 'reveal-delay-1', 'reveal-delay-2', 'reveal-delay-3' );
?>

<section id="cafes" class="bg-cream-50 py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">
        <div class="reveal mx-auto max-w-2xl text-center">
            <p class="text-[12px] font-semibold uppercase tracking-widest2 text-terracotta-600">
                De la finca à votre tasse
            </p>
            <h2 class="mt-5 font-serif text-4xl font-medium leading-tight text-coffee-900 sm:text-5xl lg:text-6xl">
                Découvrez nos cafés
            </h2>
        </div>

        <?php if ( $coffee_products ) : ?>
            <div class="mt-16 grid gap-10 sm:grid-cols-2 lg:mt-20 lg:grid-cols-3 lg:gap-8">
                <?php foreach ( $coffee_products as $index => $coffee_product ) : ?>
                    <?php
                    $product_id   = $coffee_product->get_id();
                    $image_id     = $coffee_product->get_image_id();
                    $origin       = function_exists( 'get_field' ) ? get_field( 'texte_dorigine', $product_id ) : '';
                    $notes        = function_exists( 'get_field' ) ? get_field( 'notes_aromatiques', $product_id ) : '';
                    $weight       = $coffee_product->get_weight();
                    $weight_label = $weight ? wc_format_weight( $weight ) : '';
                    ?>
                    <article class="reveal <?php echo esc_attr( $reveal_delays[ $index ] ); ?> group flex flex-col">
                        <a href="<?php echo esc_url( $coffee_product->get_permalink() ); ?>" class="img-zoom relative block aspect-[4/5] overflow-hidden bg-coffee-100" tabindex="-1" aria-hidden="true">
                            <?php if ( $image_id ) : ?>
                                <?php
                                echo wp_get_attachment_image(
                                    $image_id,
                                    'woocommerce_single',
                                    false,
                                    array(
                                        'class'   => 'h-full w-full object-cover',
                                        'loading' => 'lazy',
                                    )
                                );
                                ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ); ?>" alt="" loading="lazy" class="h-full w-full object-cover">
                            <?php endif; ?>
                        </a>

                        <div class="pt-6">
                            <?php if ( $origin ) : ?>
                                <p class="text-[11px] font-medium uppercase tracking-widest2 text-coffee-500">
                                    <?php echo esc_html( wp_strip_all_tags( $origin ) ); ?>
                                </p>
                            <?php endif; ?>
                            <h3 class="mt-2 font-serif text-2xl font-medium text-coffee-900">
                                <a href="<?php echo esc_url( $coffee_product->get_permalink() ); ?>">
                                    <?php echo esc_html( $coffee_product->get_name() ); ?>
                                </a>
                            </h3>
                            <?php if ( $notes ) : ?>
                                <p class="mt-2 text-sm text-coffee-600"><?php echo esc_html( $notes ); ?></p>
                            <?php endif; ?>
                            <?php if ( $weight_label ) : ?>
                                <p class="mt-1 text-sm text-coffee-500"><?php echo esc_html( $weight_label ); ?></p>
                            <?php endif; ?>

                            <div class="mt-5 flex items-center justify-between border-t border-coffee-200/60 pt-5">
                                <span class="font-serif text-2xl text-coffee-900"><?php echo wp_kses_post( $coffee_product->get_price_html() ); ?></span>
                                <a href="<?php echo esc_url( $coffee_product->get_permalink() ); ?>" class="group/btn inline-flex items-center gap-2 text-[12px] font-semibold uppercase tracking-widest2 text-coffee-800 transition-colors hover:text-terracotta-600">
                                    Découvrir
                                    <span class="transition-transform duration-300 group-hover/btn:translate-x-1" aria-hidden="true">→</span>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="reveal mx-auto mt-16 max-w-2xl text-center text-base text-coffee-600">
                Nos cafés seront bientôt disponibles.
            </p>
        <?php endif; ?>

        <div class="reveal mt-16 text-center">
            <a href="<?php echo esc_url( $shop_url ); ?>" class="group inline-flex items-center gap-2 font-serif text-xl italic text-coffee-800 transition-colors hover:text-terracotta-600">
                Voir tous nos cafés
                <span class="transition-transform duration-300 group-hover:translate-x-1.5" aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</section>
