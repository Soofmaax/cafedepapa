<?php

// Charger les styles du thème parent Storefront
add_action( 'wp_enqueue_scripts', 'storefront_child_enqueue_styles' );

function cdp_is_landing_page() {
    if ( ! is_front_page() ) {
        return false;
    }

    if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
        return false;
    }

    if ( function_exists( 'is_cart' ) && is_cart() ) {
        return false;
    }

    if ( function_exists( 'is_checkout' ) && is_checkout() ) {
        return false;
    }

    if ( function_exists( 'is_account_page' ) && is_account_page() ) {
        return false;
    }

    return true;
}

function storefront_child_enqueue_styles() {
    wp_enqueue_style(
        'storefront-parent-style',
        get_template_directory_uri() . '/style.css'
    );

    if ( ! cdp_is_landing_page() ) {
        return;
    }

    $stylesheet_path = get_stylesheet_directory() . '/assets/css/app.css';
    $script_path     = get_stylesheet_directory() . '/assets/js/main.js';
    $theme           = wp_get_theme();
    $theme_version   = $theme->get( 'Version' );

    // CSS personnalisé de la landing page
    wp_enqueue_style(
        'cafedepapa-landing',
        get_stylesheet_directory_uri() . '/assets/css/app.css',
        array( 'storefront-parent-style' ),
        file_exists( $stylesheet_path ) ? (string) filemtime( $stylesheet_path ) : $theme_version
    );

    // JavaScript personnalisé
    wp_enqueue_script(
        'cafedepapa-main',
        get_stylesheet_directory_uri() . '/assets/js/main.js',
        array(),
        file_exists( $script_path ) ? (string) filemtime( $script_path ) : $theme_version,
        true
    );
}


// Afficher les champs ACF personnalisés sur la fiche produit WooCommerce
add_action( 'woocommerce_single_product_summary', 'cdp_display_acf_fields', 25 );

function cdp_display_acf_fields() {
    if ( ! function_exists( 'get_field' ) ) {
        return;
    }

    $origine   = get_field( 'texte_dorigine' );
    $notes     = get_field( 'notes_aromatiques' );
    $guide     = get_field( 'guide_de_preparation' );
    $intensite = get_field( 'intensite_produit' );

    // N'affiche le bloc que si au moins un champ est rempli
    if ( $origine || $notes || $guide || $intensite ) {

        echo '<div class="cdp-custom-fields" style="margin: 20px 0; padding: 15px; background: #f9f9f9; border-left: 4px solid #6b4226; border-radius: 4px;">';

        if ( $intensite ) {
            echo '<p style="margin-bottom:8px;"><strong>Intensité :</strong> ' . esc_html( $intensite ) . ' / 5</p>';
        }

        if ( $notes ) {
            echo '<p style="margin-bottom:8px;"><strong>Notes aromatiques :</strong> ' . esc_html( $notes ) . '</p>';
        }

        if ( $origine ) {
            echo '<div style="margin-bottom:8px;"><strong>Origine :</strong> ' . wp_kses_post( $origine ) . '</div>';
        }

        if ( $guide ) {
            echo '<p style="margin-bottom:0;"><strong>Guide de préparation :</strong> ' . esc_html( $guide ) . '</p>';
        }

        echo '</div>';
    }
}


// Enregistrer les inscriptions à la newsletter depuis la landing page
add_action( 'admin_post_nopriv_cdp_newsletter_subscribe', 'cdp_handle_newsletter_subscription' );
add_action( 'admin_post_cdp_newsletter_subscribe', 'cdp_handle_newsletter_subscription' );

function cdp_handle_newsletter_subscription() {
    $redirect_url = home_url( '/#contact' );

    if (
        ! isset( $_POST['cdp_newsletter_nonce'] ) ||
        ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cdp_newsletter_nonce'] ) ), 'cdp_newsletter_subscribe' )
    ) {
        wp_safe_redirect( add_query_arg( 'newsletter', 'error', $redirect_url ) );
        exit;
    }

    $email = isset( $_POST['newsletter_email'] ) ? sanitize_email( wp_unslash( $_POST['newsletter_email'] ) ) : '';

    if ( ! is_email( $email ) ) {
        wp_safe_redirect( add_query_arg( 'newsletter', 'invalid', $redirect_url ) );
        exit;
    }

    $subscribers   = get_option( 'cdp_newsletter_subscribers', array() );
    $subscribers   = is_array( $subscribers ) ? $subscribers : array();
    $normalized    = strtolower( $email );
    $existing_list = array_map( 'strtolower', $subscribers );

    if ( ! in_array( $normalized, $existing_list, true ) ) {
        $subscribers[] = $email;
        update_option( 'cdp_newsletter_subscribers', $subscribers, false );
    }

    wp_safe_redirect( add_query_arg( 'newsletter', 'success', $redirect_url ) );
    exit;
}
