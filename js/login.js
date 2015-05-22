$(document).ready(function () {

$("#form1").submit(function (e) {

            var email = $("#email").val();
            var password = $("#password").val();
  
  var dataString = '&email='+ email + 'password='+ password ;
                            if(email==''||password=='')
                            {
                               alert("Please Fill All Fields");
                            }
                            else
                            {

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'http://localhost/phoneBook/php/login.php',
                    data: {
                        action: 'login',
                        email: email,
                        password: password,
                    },
                    }).done ( function(result){
                                if (result.statusCode == 200){
                                    window.location.href = 'http://localhost/phoneBook/home.html';
                                }else if (result.statusCode == 302){
                                    alert ("Username/Password is incorrect");
                                }

                                }).fail( function(jqXHR, textStatus, errorThrown){
                                    alert ("hmm.. Something went wrong");

                                });
                                }
                              return false;
                                });

  });



  