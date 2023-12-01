jQuery(function($){

       //Faq Item
        $( ".accordion_item" ).accordion({
          collapsible: true,
          active:false,
          heightStyle: "content",
        });

        $( ".r_accordion_items" ).on( "accordionbeforeactivate", function( event, ui ) {} );
        $('.rmore_content').click(function() {
            $('.rinner_content.rcontent_course_box').toggleClass('show_all_content');
        });
  });
  