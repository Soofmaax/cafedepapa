<?php
if ( ! cdp_is_landing_page() ) {
    require get_template_directory() . '/header.php';
    return;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$landing_page_url = trailingslashit( home_url( '/' ) );
$nav_links        = array(
    array( 'label' => 'Nos cafés', 'href' => '#cafes' ),
    array( 'label' => 'La Finca', 'href' => '#origine' ),
    array( 'label' => 'Notre histoire', 'href' => '#histoire' ),
    array( 'label' => 'Nos engagements', 'href' => '#engagements' ),
    array( 'label' => 'Contact', 'href' => '#contact' ),
);
?>

<header id="site-header" class="site-header fixed inset-x-0 top-0 z-50 bg-transparent transition-all duration-500" data-site-header>
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-10">
        <a href="<?php echo esc_url( $landing_page_url ); ?>" class="site-header__brand font-serif text-xl font-semibold tracking-wide text-cream-50 transition-colors duration-300">
            CAFÉ DE PAPÁ
        </a>

        <nav class="hidden items-center gap-9 lg:flex" aria-label="Navigation principale">
            <?php foreach ( $nav_links as $nav_link ) : ?>
                <a href="<?php echo esc_url( $landing_page_url . $nav_link['href'] ); ?>" class="site-header__nav-link group relative text-[13px] font-medium uppercase tracking-widest2 text-cream-100/90 transition-colors duration-300 hover:text-cream-50">
                    <?php echo esc_html( $nav_link['label'] ); ?>
                    <span class="absolute -bottom-1.5 left-0 h-px w-0 bg-gold-500 transition-all duration-300 group-hover:w-full" aria-hidden="true"></span>
                </a>
            <?php endforeach; ?>
        </nav>

        <a href="<?php echo esc_url( $landing_page_url . '#cafes' ); ?>" class="hidden rounded-full border border-cream-100/40 px-5 py-2.5 text-[13px] font-medium uppercase tracking-widest2 text-cream-50 transition-all duration-300 hover:border-gold-500 hover:bg-gold-500 hover:text-coffee-950 lg:inline-block">
            Découvrir nos cafés
        </a>

        <button type="button" class="site-header__toggle text-cream-50 transition-colors lg:hidden" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="mobile-menu" data-menu-toggle>
            <svg class="site-header__menu-icon" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M4 12h16"></path>
                <path d="M4 6h16"></path>
                <path d="M4 18h16"></path>
            </svg>
            <svg class="site-header__close-icon hidden" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
            </svg>
        </button>
    </div>

    <div id="mobile-menu" class="site-header__mobile-menu max-h-0 overflow-hidden bg-coffee-950 opacity-0 transition-[max-height,opacity] duration-500 lg:hidden" aria-hidden="true" inert data-mobile-menu>
        <nav class="flex flex-col gap-1 px-6 pb-8 pt-2" aria-label="Navigation mobile">
            <?php foreach ( $nav_links as $nav_link ) : ?>
                <a href="<?php echo esc_url( $landing_page_url . $nav_link['href'] ); ?>" class="border-b border-coffee-800/60 py-4 font-serif text-2xl text-cream-100 transition-colors hover:text-gold-400" data-mobile-menu-link>
                    <?php echo esc_html( $nav_link['label'] ); ?>
                </a>
            <?php endforeach; ?>

            <a href="<?php echo esc_url( $landing_page_url . '#cafes' ); ?>" class="mt-5 inline-block rounded-full bg-gold-500 px-6 py-3.5 text-center text-[13px] font-semibold uppercase tracking-widest2 text-coffee-950" data-mobile-menu-link>
                Découvrir nos cafés
            </a>
        </nav>
    </div>
</header>
