
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery('.question_faq_an').css('background','#eee');
        jQuery(".reponse_faq_an").css('background','#fff');

         jQuery('.question_faq_an').on('mouseenter',function(event){
          event.preventDefault(); 
          jQuery(this).parent().next('.reponse_faq_an').show('fast');
          
        });

        jQuery(".reponse_faq_an").on("mouseleave", function(event){
            event.preventDefault();
            jQuery(this).hide('fast');
        }); 


    });
</script>