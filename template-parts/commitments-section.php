<?php
$commitments = array(
    array(
        'icon'  => '<path d="M7 20h10"></path><path d="M10 20c5.5-2.5.8-6.4 3-10"></path><path d="M9.5 9.4c1.1.8 1.8 2.2 1.8 3.6-2.1.4-4.2-.7-5.3-2.5-1.1-1.8-1-4.1-.8-6.1 2 .4 4 .8 5.4 2.3.9 1 1.4 2.2 1.4 3.5 1-3.1 2.9-5.5 5.7-7.2.5 2.5.4 5.2-1 7.4-1.2 2-3.2 3.3-5.4 3.5"></path>',
        'title' => 'Origine connue',
        'text'  => 'Mettre en avant la provenance du café, sans intermédiaire ni mystère.',
    ),
    array(
        'icon'  => '<path d="M11 14h2a2 2 0 0 0 0-4h-3c-.6 0-1.1.2-1.5.6L3 16"></path><path d="m7 20 1.6-1.4c.4-.4.9-.6 1.5-.6h4.8c.6 0 1.1-.2 1.5-.6L21 13"></path><path d="m15 5 1-1a2.1 2.1 0 0 1 3 3l-1 1-3-3Z"></path><path d="m15 5-2-2a2.1 2.1 0 0 0-3 3l5 5 3-3"></path><path d="m2 15 6 6"></path>',
        'title' => 'Lien avec la production',
        'text'  => 'Raconter les personnes et le lieu derrière chaque paquet de café.',
    ),
    array(
        'icon'  => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 2.5 17 2.5c1 2 1.5 4.2 1.5 6.5 0 6.1-3.5 11-7.5 11Z"></path><path d="M2 21c0-3 1.85-5.36 5.08-6.94C9.37 12.94 12.1 12 16 12"></path>',
        'title' => 'Qualité',
        'text'  => 'Préserver le caractère et les arômes naturels du grain.',
    ),
    array(
        'icon'  => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>',
        'title' => 'Transmission',
        'text'  => 'Partager une histoire familiale entre le Pérou et Paris.',
    ),
);

$reveal_delays = array( 'reveal-delay-1', 'reveal-delay-2', 'reveal-delay-3', 'reveal-delay-4' );
?>

<section id="engagements" class="bg-cream-100 py-24 lg:py-32">
    <div class="mx-auto max-w-6xl px-6 lg:px-10">
        <div class="reveal mx-auto max-w-3xl text-center">
            <p class="text-[12px] font-semibold uppercase tracking-widest2 text-terracotta-600">
                Nos engagements
            </p>
            <h2 class="mt-5 font-serif text-4xl font-medium leading-tight text-coffee-900 sm:text-5xl lg:text-6xl">
                Respecter ce qu'il y a
                <br>
                <span class="italic text-coffee-700">derrière chaque grain.</span>
            </h2>
        </div>

        <div class="mt-16 grid gap-px overflow-hidden border border-coffee-200/60 bg-coffee-200/60 sm:grid-cols-2 lg:mt-20 lg:grid-cols-4">
            <?php foreach ( $commitments as $index => $commitment ) : ?>
                <div class="reveal <?php echo esc_attr( $reveal_delays[ $index ] ); ?> group bg-cream-100 p-8 transition-colors duration-500 hover:bg-cream-50 lg:p-10">
                    <span class="inline-flex h-14 w-14 items-center justify-center rounded-full border border-coffee-300/50 text-coffee-700 transition-all duration-500 group-hover:border-terracotta-500 group-hover:text-terracotta-600">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <?php echo $commitment['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG paths defined above. ?>
                        </svg>
                    </span>
                    <h3 class="mt-6 font-serif text-2xl font-medium text-coffee-900">
                        <?php echo esc_html( $commitment['title'] ); ?>
                    </h3>
                    <p class="mt-3 text-sm leading-relaxed text-coffee-600">
                        <?php echo esc_html( $commitment['text'] ); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
