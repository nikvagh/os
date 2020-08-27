$(document).ready(function(){
  "use strict";

  /*=====================================
    main slider
  ======================================*/
  $('#main-slider').owlCarousel({
    loop: false,
    items: 1,
    dots: true,
    nav: false,
    navText : ['<i class="fas fa-caret-left"></i>','<i class="fas fa-caret-right"></i>']
 
  });

  /*=====================================
    section product slider
  ======================================*/
  // medicine slider
  $('#medicine-slider,#prescription-slider,.section-home-right').owlCarousel({
    loop: false,
    margin: 30,
    dots: false,
    nav: true,
    navText : ['<i class="fas fa-caret-left"></i>','<i class="fas fa-caret-right"></i>'],
    responsive:{
      0:{
        items: 2,
        margin: 15
      },
      479:{
        items: 2,
        margin: 15
      },
      768:{
        items: 2,
        margin: 15
      },
      979:{
        items: 2
      },
      1199:{
        items: 4
      }
    }
  });
  

  // equipment slider
  $('#equipment-slider,#female-slider,.section-home-left').owlCarousel({
    loop: false,
    margin: 30,
    items: 4,
    dots: false,
    nav: true,
    navText : ['<i class="fas fa-caret-left"></i>','<i class="fas fa-caret-right"></i>'],
    rtl: true,
    responsive:{
      0:{
        items: 2,
        margin: 15
      },
      479:{
        items: 2,
        margin: 15
      },
      768:{
        items: 2,
        margin: 15
      },
      979:{
        items: 2
      },
      1199:{
        items: 4
      }
    }
  });

  // testimonial slider
  $('#team-testimonial').owlCarousel({
    loop: false,
    margin: 30,
    dots: false,
    nav: false,
    responsive:{
      0:{
        items: 2,
        margin: 15
      },
      479:{
        items: 2,
        margin: 15
      },
      768:{
        items: 3
      },
      979:{
        items: 4
      },
      1199:{
        items: 6
      }
    }
  });

  /*=====================================
    banner slider
  ======================================*/
  $('#banner-slider').owlCarousel({
    loop: false,
    margin: 60,
    dots: false,
    nav: false,
    responsive:{
      0:{
        items: 2,
        margin: 15
      },
      479:{
        items: 2,
        margin: 15
      },
      768:{
        items: 2,
        margin: 15
      },
      979:{
        items: 3,
        margin: 30
      },
      1199:{
        items: 4
      }
    }
  });

  // equipment slider
  $('#recomanded-slider').owlCarousel({
    loop: false,
    margin: 30,
    items: 4,
    dots: false,
    nav: true,
    navText : ['<i class="fas fa-caret-left"></i>','<i class="fas fa-caret-right"></i>'],
    responsive:{
      0:{
        items: 2,
        margin: 15
      },
      479:{
        items: 2,
        margin: 15
      },
      768:{
        items: 3,
        margin: 15
      },
      979:{
        items: 4
      },
      1199:{
        items: 5
      }
    }
  });



  /* ========================================== 
  Minus and Plus Btn Height
  ========================================== */

  // $('.minus-btn,.minus-btn-1').on('click', function(e) {
  //   e.preventDefault();
  //   var $this = $(this);
  //   var $input = $this.closest('div').find('input');
  //   var value = parseInt($input.val());

  //   if (value > 1) {
  //     value = value - 1;
  //   } else {
  //     value = 0;
  //   }
  //   $input.val(value);
  // });

  // $('.plus-btn,.plus-btn-1').on('click', function(e) {
  //   e.preventDefault();
  //   var $this = $(this);
  //   var $input = $this.closest('div').find('input');
  //   var value = parseInt($input.val());

  //   if (value < 100) {
  //     value = value + 1;
  //   } else {
  //     value =2;
  //   }
  //   $input.val(value);
  // });


    /*========================================== 
      Product-zoom events on hover
    ========================================== */

    $('.zoom').zoom();

  /*=====================================
    back to top
  ======================================*/

  $('#top').click(function(){
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
  });

  
  /*=====================================
    language button
  ======================================*/
  // $('.slider').on('click', function() {
  //   if($('.eng-lag').hasClass('active')){
  //     $('.eng-lag').removeClass('active');
  //     $('.bangali-lan').addClass('active');
  //   }else{
  //     $('.bangali-lan').removeClass('active');
  //     $('.eng-lag').addClass('active');
  //   } 
  // });

  // $(".language-op input[name=language]").change(function(){
  //   if($("input[name=language]").is(":checked")){
  //     $('.bangali-lan').removeClass('active');
  //     $('.eng-lag').addClass('active');
  //   }else{
  //     $('.eng-lag').removeClass('active');
  //     $('.bangali-lan').addClass('active');
  //   }
  // })

  langu_change();
  $("input[name=language]").change(function(){
      langu_change();
  });
  function langu_change(){
      if($("input[name=language]").is(":checked")){
          $("input[name=language]").val('en');
          $('.eng-lag').addClass('active');
          $('.bangali-lan').removeClass('active');
      }else{
          $("input[name=language]").val('bn');
          $('.eng-lag').removeClass('active');
          $('.bangali-lan').addClass('active');
      }
  }


  /*=====================================
    navbar-toggler button
  ======================================*/
  $('.navbar-toggler').on('click', function (e) {
    if($('.navbar-collapse').hasClass('active')){
        $('.navbar-collapse').removeClass('active');
        $('.navbar-collapse').removeClass('remove');
        $(this).removeClass('active');
    }else{
        $('.navbar-collapse').addClass('active');
        $(this).addClass('active');
    }
  });

  /*=====================================
    profile dropdown
  ======================================*/
  var win_width = $( window ).width();
  if(win_width <= 1024){
    $('.profile-info').on('click', function (e) {
        if($('.profile-dropdown').hasClass('active')){
            $('.profile-dropdown').removeClass('active');
        }else{
            $('.profile-dropdown').addClass('active');
        }
    });
  }
  $('.img-picker').on('click', function (e) {
      if($('.edit-photo-title ').hasClass('remove')){
          $('.edit-photo-title').removeClass('remove');
      }else{
          $('.edit-photo-title').addClass('remove');
      }
  });
  
  
  /* ==============================
    profile settings img picker
  =============================== */
  (function ( $ ) {
 
    $.fn.imagePicker = function( options ) {
      // Define plugin options
      var settings = $.extend({
          // Input name attribute
          name: "",
          // Classes for styling the input
          class: "form-control btn btn-default btn-block",
          // Icon which displays in center of input
          
      }, options );
      
      // Create an input inside each matched element
      return this.each(function() {
          $(this).html(create_btn(this, settings));
      });
 
    };
 
    // Private function for creating the input element
    function create_btn(that, settings) {
      // The input icon element
      var picker_btn_icon = $('<i class="'+settings.icon+'"></i>');
      
      // The actual file input which stays hidden
      var picker_btn_input = $('<input type="file" class="add-img" name="'+settings.name+'" />');
      
      // The actual element displayed
      var picker_btn = $('<div class="'+settings.class+' img-upload-btn"></div>')
          .append(picker_btn_icon)
          .append(picker_btn_input);
          
      // File load listener
      picker_btn_input.change(function() {
        if ($(this).prop('files')[0]) {
            // Use FileReader to get file
            var reader = new FileReader();
            
            // Create a preview once image has loaded
            reader.onload = function(e) {
                var preview = create_preview(that, e.target.result, settings);
                $(that).html(preview);
            }
            
            // Load image
            reader.readAsDataURL(picker_btn_input.prop('files')[0]);
        }                
      });

      return picker_btn
    };
    
    // Private function for creating a preview element
    function create_preview(that, src, settings) {
        
      // The preview image
      var picker_preview_image = $('<img src="'+src+'" class="img-responsive img-rounded" />');
      
      // The remove image button
      var picker_preview_remove = $('<button class="btn btn-link"><small>Remove</small></button>');
      
      // The preview element
      var picker_preview = $('<div class="text-center"></div>')
          .append(picker_preview_image)
          .append(picker_preview_remove);

      // Remove image listener
      picker_preview_remove.click(function() {
          var btn = create_btn(that, settings);
          $(that).html(btn);
      });
      
      return picker_preview;
    };
    
}( jQuery ));

$(document).ready(function() {
    $('.img-picker').imagePicker({name: 'images'});
})

  
});