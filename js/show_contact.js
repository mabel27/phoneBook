 $(document).ready(function () {
             
      $.ajax({    //create an ajax request to load_page.php
        type: 'GET',
        url: 'http://localhost/phoneBook/php/show_contact.php',             
        dataType: 'html',   //expect html to be returned                
        success: function(response){ 
          
            $("#responsecontainer").html(response); 
            
        }

    });
});