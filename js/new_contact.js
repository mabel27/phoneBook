
$("#new_contact").submit(function (e) {

  var name = $("#name").val();
  var phone = $("#phone").val();
  var date = $("#date").val();
  var note = $("#note").val();
  
  var dataString = '&name='+ name + 'phone='+ phone ;
                            if(name==''||phone=='')
                            {
                               alert("Please Fill Name and Phone fields");
                            }
                            else
                            {

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'http://localhost/phoneBook/php/new_contact.php',
                    data: {
                        action: 'new_contact',
                        name: name,
                        phone: phone,
                        date: date,
                        note: note,
                    },
                  
                    }).done (function(result){
                                
                                  alert("New Contact Added");
                                  location.reload();
                                  
                            
                                }).fail( function(jqXHR, textStatus, errorThrown){
                                    alert ("hmm.. Something went wrong");
                                    location.reload();

                                });
                                }
  
                              return false;

                                });
  
  