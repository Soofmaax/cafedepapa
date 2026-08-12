<?php

// Charger les styles du thème parent Storefront
add_action( 'wp_enqueue_scripts', 'storefront_child_enqueue_styles' );

function storefront_child_enqueue_styles() {

    wp_enqueue_style(
        'storefront-parent-style',
        get_template_directory_uri() . '/style.css'
    );

    // CSS personnalisé de la landing page
    wp_enqueue_style(
        'cafedepapa-landing',
        get_stylesheet_directory_uri() . '/assets/css/app.css',
        array( 'storefront-parent-style' ),
        '1.0.0'
    );

    // JavaScript personnalisé
    wp_enqueue_script(
        'cafedepapa-main',
        get_stylesheet_directory_uri() . '/assets/js/main.js',
        array(),
        '1.0.0',
        true
    );
}


// Afficher les champs ACF personnalisés sur la fiche produit WooCommerce
add_action( 'woocommerce_single_product_summary', 'cdp_display_acf_fields', 25 );

function cdp_display_acf_fields() {

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