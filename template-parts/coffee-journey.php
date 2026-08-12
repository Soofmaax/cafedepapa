<?php
$journey_steps = array(
    array(
        'number' => '01',
        'title'  => 'La terre',
        'text'   => 'Le café commence dans les terres de la finca, sur les hauteurs du Pérou.',
        'image'  => 'https://images.pexels.com/photos/23848552/pexels-photo-23848552.jpeg?auto=compress&cs=tinysrgb&w=1100',
        'alt'    => 'Paysage montagneux du Pérou au lever du soleil',
    ),
    array(
        'number' => '02',
        'title'  => 'La récolte',
        'text'   => 'Les cerises sont récoltées à maturité, à la main, cerise après cerise.',
        'image'  => 'https://images.pexels.com/photos/7125702/pexels-photo-7125702.jpeg?auto=compress&cs=tinysrgb&w=1100',
        'alt'    => 'Mains tenant des cerises de café fraîchement récoltées',
    ),
    array(
        'number' => '03',
        'title'  => 'Le savoir-faire',
        'text'   => 'Chaque étape cherche à préserver les qualités et le caractère du grain.',
        'image'  => 'https://images.pexels.com/photos/30444143/pexels-photo-30444143.jpeg?auto=compress&cs=tinysrgb&w=1100',
        'alt'    => 'Gros plan de grains de café fraîchement torréfiés',
    ),
    array(
        'number' => '04',
        'title'  => 'Paris',
        'text'   => "Le café traverse l'Atlantique pour arriver jusqu'à la tasse parisienne.",
        'image'  => 'https://images.pexels.com/photos/4927237/pexels-photo-4927237.jpeg?auto=compress&cs=tinysrgb&w=1100',
        'alt'    => 'Bariste versant un café dans une tasse',
    ),
);
?>

<section class="bg-coffee-900 py-24 text-cream-100 lg:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">
        <div class="reveal mx-auto max-w-2xl text-center">
            <p class="text-[12px] font-semibold uppercase tracking-widest2 text-gold-400">
                Le voyage du café
            </p>
            <h2 class="mt-5 font-serif text-4xl font-medium leading-tight text-cream-50 sm:text-5xl lg:text-6xl">
                De la graine à la tasse
            </h2>
        </div>

        <div class="relative mt-20">
            <div aria-hidden="true" class="absolute left-1/2 top-0 hidden h-full w-px -translate-x-1/2 bg-gold-500/25 lg:block"></div>

            <div class="flex flex-col gap-16 lg:gap-28">
                <?php foreach ( $journey_steps as $index => $journey_step ) : ?>
                    <div class="reveal flex flex-col items-center gap-8 lg:flex-row lg:gap-14<?php echo 1 === $index % 2 ? ' lg:flex-row-reverse' : ''; ?>">
                        <div class="img-zoom relative aspect-[16/11] w-full overflow-hidden lg:w-1/2">
                            <img
                                src="<?php echo esc_url( $journey_step['image'] ); ?>"
                                alt="<?php echo esc_attr( $journey_step['alt'] ); ?>"
                                loading="lazy"
                                class="h-full w-full object-cover"
                            >
                        </div>

                        <div class="w-full lg:w-1/2 lg:px-6">
                            <span class="font-serif text-6xl font-medium text-gold-500/40 lg:text-7xl">
                                <?php echo esc_html( $journey_step['number'] ); ?>
                            </span>
                            <h3 class="mt-3 font-serif text-3xl font-medium text-cream-50 lg:text-4xl">
                                <?php echo esc_html( $journey_step['title'] ); ?>
                            </h3>
                            <p class="mt-4 max-w-md text-base leading-relaxed text-cream-200/80">
                                <?php echo esc_html( $journey_step['text'] ); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
