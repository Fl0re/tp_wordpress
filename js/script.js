

(function( $ ){
    $(document).ready(function () {

   //slider


   $all_slide = $(".all_slide");
    $current_slide = $all_slide.first();

   $all_slide.hide();
    $current_slide.show();

   setInterval(function(){
 
        $current_slide.fadeOut(500, function(){
            $current_slide = $current_slide.next();
            if($current_slide.length < 1 ){
                $current_slide = $all_slide.first();
            }
            $current_slide.fadeIn(500);
        });
    }, 3000);
    });
}(jQuery));