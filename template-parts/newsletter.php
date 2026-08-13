<?php
$newsletter_status = isset( $_GET['newsletter'] ) ? sanitize_key( wp_unslash( $_GET['newsletter'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only status set after form processing.
$newsletter_error  = 'invalid' === $newsletter_status
    ? 'Veuillez saisir une adresse e-mail valide.'
    : 'Une erreur est survenue. Veuillez réessayer.';
?>

<section id="contact" class="bg-coffee-900 py-24 lg:py-32">
    <div class="mx-auto max-w-3xl px-6 text-center lg:px-10">
        <p class="reveal text-[12px] font-semibold uppercase tracking-widest2 text-gold-400">
            Newsletter
        </p>
        <h2 class="reveal reveal-delay-1 mt-5 font-serif text-4xl font-medium leading-tight text-cream-50 sm:text-5xl">
            Recevez des nouvelles
            <br>
            <span class="italic text-gold-400">de la finca.</span>
        </h2>
        <p class="reveal reveal-delay-2 mx-auto mt-6 max-w-lg text-base leading-relaxed text-cream-200/80">
            Nouveaux cafés, récoltes, histoires du Pérou et actualités Café de Papá.
        </p>

        <?php if ( 'success' === $newsletter_status ) : ?>
            <p class="mt-10 font-serif text-2xl italic text-gold-400" role="status">
                Merci — vous recevrez bientôt des nouvelles de la finca.
            </p>
        <?php else : ?>
            <?php if ( $newsletter_status ) : ?>
                <p class="mt-8 text-sm text-cream-100" role="alert">
                    <?php echo esc_html( $newsletter_error ); ?>
                </p>
            <?php endif; ?>

            <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" class="reveal reveal-delay-3 mx-auto mt-10 flex max-w-md flex-col gap-3 sm:flex-row">
                <input type="hidden" name="action" value="cdp_newsletter_subscribe">
                <?php wp_nonce_field( 'cdp_newsletter_subscribe', 'cdp_newsletter_nonce' ); ?>

                <label for="newsletter-email" class="sr-only">Votre adresse e-mail</label>
                <input
                    id="newsletter-email"
                    name="newsletter_email"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="Votre adresse e-mail"
                    class="flex-1 rounded-full border border-cream-100/30 bg-coffee-950/40 px-6 py-4 text-sm text-cream-50 placeholder-cream-200/40 outline-none transition-colors focus:border-gold-500"
                >
                <button type="submit" class="group inline-flex items-center justify-center gap-2 rounded-full bg-gold-500 px-7 py-4 text-[13px] font-semibold uppercase tracking-widest2 text-coffee-950 transition-colors hover:bg-gold-400">
                    S'inscrire
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </button>
            </form>
        <?php endif; ?>
    </div>
</section>
