// ( function( $ ) {
//   /**
//    * @param $scope The Widget wrapper element as a jQuery element
//    * @param $ The jQuery alias
//    */
//   var WidgetAwesomesauceHandler = function( $scope, $ ) {
//     console.log( $scope );
//   };
//
//   // Make sure you run this code under Elementor.
//   alert('akhads');
//   $( window ).on( 'elementor/frontend/init', function() {
//     elementorFrontend.hooks.addAction( 'frontend/element_ready/awesomesauce.default', WidgetAwesomesauceHandler, function(){
//         $(".owl-carousel").owlCarousel();
//     } );
//   } );
// } )( jQuery );

class WidgetHandlerClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                firstSelector: '.owl-carousel',
                secondSelector: '.big-wrapper',
            },
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $firstSelector: this.$element.find( selectors.firstSelector ),
            $secondSelector: this.$element.find( selectors.secondSelector ),
        };
    }

    bindEvents() {
        this.elements.$firstSelector.owlCarousel();
    }

   //  onFirstSelectorClick( event ) {
   //      event.preventDefault();
   //
   //      this.elements.$secondSelector.show();
   // }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
   const addHandler = ( $element ) => {
       elementorFrontend.elementsHandler.addHandler( WidgetHandlerClass, {
           $element,
       } );
   };

   elementorFrontend.hooks.addAction( 'frontend/element_ready/post-carousel.default', addHandler );
} );
