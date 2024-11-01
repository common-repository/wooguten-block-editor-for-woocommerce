jQuery(window).load( function () {
    var wc_product_data_metaBox = jQuery( '#woocommerce-product-data' );
    // tested in firefox and chrome..
    wc_product_data_metaBox.off( 'click', '.hndle' );
    // wc_product_data_metaBox.find( '.hndle' ).off( 'click' );
    wc_product_data_metaBox.find( '.hndle' ).unbind( 'click.postboxes' );
    // wc_product_data_metaBox.find( '.hndle' ).bind( 'click.postboxes', window.postboxes.handle_click );
    wc_product_data_metaBox.on( 'click', '.hndle', function( event ) {
        // If the user clicks on some form input inside the h3 the box should not be toggled.
        // needed for firefox, chrome doesn't have problem with it (tested on chrome 78 & firefox 67)
        if ( jQuery( event.target ).filter( 'input, option, label, select' ).length ) {
            return;
        }
        // if( wc_product_data_metaBox.hasClass('closed') ) wc_product_data_metaBox.removeClass('closed');
        // if( ! wc_product_data_metaBox.hasClass('closed') ) wc_product_data_metaBox.addCLass('closed');
        // console.log( jQuery( '#woocommerce-product-data' ).get(0), this, jQuery( '#woocommerce-product-data' ).hasClass('closed'));
        // firefox has problem with jQuery.addClass()
        wc_product_data_metaBox.toggleClass( 'closed' );
        // save postbox state..
        postboxes.save_state( 'product' );
    });
});
