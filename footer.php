<?php
$landing_page_url = trailingslashit( home_url( '/' ) );
$footer_columns   = array(
    array(
        'title' => 'Découvrir',
        'links' => array(
            array( 'label' => 'Nos cafés', 'url' => $landing_page_url . '#cafes' ),
            array( 'label' => 'Notre histoire', 'url' => $landing_page_url . '#histoire' ),
            array( 'label' => 'La Finca', 'url' => $landing_page_url . '#origine' ),
            array( 'label' => 'Nos engagements', 'url' => $landing_page_url . '#engagements' ),
        ),
    ),
    array(
        'title' => 'Informations',
        'links' => array(
            array( 'label' => 'Livraison', 'url' => '#' ),
            array( 'label' => 'Contact', 'url' => $landing_page_url . '#contact' ),
            array( 'label' => 'FAQ', 'url' => '#' ),
            array( 'label' => 'Mentions légales', 'url' => '#' ),
            array( 'label' => 'CGV', 'url' => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'terms' ) : '#' ),
            array( 'label' => 'Politique de confidentialité', 'url' => get_privacy_policy_url() ?: '#' ),
        ),
    ),
);
?>

<footer class="bg-coffee-950 text-cream-200">
    <div class="mx-auto max-w-7xl px-6 py-16 lg:px-10 lg:py-20">
        <div class="grid gap-12 lg:grid-cols-[1.4fr_1fr_1fr_1fr]">
            <div>
                <p class="font-serif text-2xl font-semibold tracking-wide text-cream-50">CAFÉ DE PAPÁ</p>
                <p class="mt-3 max-w-xs font-serif text-lg italic text-cream-200/70">
                    De la Terre Péruvienne à la Tasse Parisienne
                </p>
            </div>

            <?php foreach ( $footer_columns as $footer_column ) : ?>
                <div>
                    <h2 class="text-[12px] font-semibold uppercase tracking-widest2 text-gold-400">
                        <?php echo esc_html( $footer_column['title'] ); ?>
                    </h2>
                    <ul class="mt-5 space-y-3">
                        <?php foreach ( $footer_column['links'] as $footer_link ) : ?>
                            <li>
                                <a href="<?php echo esc_url( $footer_link['url'] ); ?>" class="text-sm text-cream-200/70 transition-colors hover:text-cream-50">
                                    <?php echo esc_html( $footer_link['label'] ); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>

            <div>
                <h2 class="text-[12px] font-semibold uppercase tracking-widest2 text-gold-400">Nous suivre</h2>
                <div class="mt-5 flex gap-3">
                    <a href="#" aria-label="Instagram" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-coffee-700 text-cream-200 transition-all duration-300 hover:border-gold-500 hover:text-gold-400">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37Z"></path>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                        </svg>
                    </a>
                    <a href="#" aria-label="Facebook" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-coffee-700 text-cream-200 transition-all duration-300 hover:border-gold-500 hover:text-gold-400">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3Z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-14 border-t border-coffee-800/60 pt-7">
            <p class="text-center text-xs text-cream-200/50">
                © 2026 Café de Papá — Tous droits réservés
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
