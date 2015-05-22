$("#delete_").submit(function (e) {
$.ajax({
    type:'POST',
    url:'http://localhost/phoneBook/php/delete_contact.php',
    data: {
            action: 'delete_contact',
            id: id,
          },
                  
          }).done (function(result){
                                
            confirm("Are you sure you want to Delete");
            location.reload();
            }).fail( function(jqXHR, textStatus, errorThrown){
            alert ("hmm.. Something went wrong");
            location.reload();
            });
            return false;

});

