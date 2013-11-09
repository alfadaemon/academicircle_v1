<script>
$(document).ready(function() {
    //This works.
    //TODO Change to a nicer jquery plugin over the page
    if ( $('#flashMessage').text() != '') {
      setTimeout(function() {
         $('#flashMessage').slideUp(300);
     }, 3000);};
 });

</script>
<?php
    echo $session->flash('auth');
    echo $session->flash();
    echo $content_for_layout;
?>
