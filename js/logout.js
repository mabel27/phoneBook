       $("#logout").submit(function(){
            $.ajax({
                type: "POST",
                url: "http://localhost/phoneBook/php/logout.php", 
                data: { 
                    action: 'logout', 
                result: 'nothing'
                }
            }).done(function(result){
             
                window.location.href = 'http://localhost/phoneBook/index.html';
            }).fail(function(jqXHR, textStatus, errorThrown){
                alert("hmm.. Something went wrong");
                window.location.href = 'http://localhost/phoneBook/index.html';
            });
        });


  
