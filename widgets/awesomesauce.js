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
                secondSelector: '.post-slider',
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
        // this.elements.$firstSelector.owlCarousel();
        this.elements.$firstSelector.on('load', this.blabla());
    }

    blabla() {
      const controls = JSON.parse(this.elements.$secondSelector.attr('data-controls'));
      const autoslide = Boolean(controls.auto_nav_slide?true:false);
      const nav_show = Boolean(controls.nav_show?true:false);
      const dot_nav = Boolean(controls.dot_nav_show?true:false);
      const item_count = parseInt( controls.item_count );

      if (this.elements.$secondSelector.length > 0) {
                     this.elements.$secondSelector.owlCarousel({
                        items: item_count,
                        loop: true,
                        autoplay: autoslide,
                        nav: nav_show,
                        dots: dot_nav,
                        autoplayTimeout: 8000,
                        autoplayHoverPause: false,
                        mouseDrag: true,
                        smartSpeed: 1100,
                        margin:30,
                        navText: ["<i class='fas fa-arrow-left'></i>", "<i class='fas fa-arrow-right'></i>"],
                        responsive: {
                           0: {
                              items: 1,
                           },
                           600: {
                              items: 2,
                           },
                           1000: {
                              items: 3,
                           },
                           1200: {
                              items:item_count,
                           }
                        }

                     });
               }
    }

   //  onFirstSelectorClick( event ) {
   //      event.preventDefault();
   //
   //      this.elements.$secondSelector.show();
   // }
}

//
// export default ( $scope ) => {
// 	elementorFrontend.elementsHandler.addHandler( VideoModule, { $element: $scope } );
// };

jQuery( window ).on( 'elementor/frontend/init', () => {
   const addHandler = ( $element ) => {
       elementorFrontend.elementsHandler.addHandler( WidgetHandlerClass, {
           $element,
       } );
   };

   elementorFrontend.hooks.addAction( 'frontend/element_ready/post-carousel.default', addHandler );
} );
