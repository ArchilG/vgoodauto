        /*
          Jquery Validation using jqBootstrapValidation
           example is taken from jqBootstrapValidation docs
           */
           $(function() {

            $("#zakaz_<?=$id?>").find('textarea,input').jqBootstrapValidation(
            {
              preventSubmit: true,
              submitError: function($form, event, errors) {
              // something to have when submit produces an error ?
              // Not decided if I need it yet
          },
          submitSuccess: function($form, event) {
              event.preventDefault(); // prevent default submit behaviour
               // get values from FORM
               var fio = $("input#name_zakaz_<?=$id?>").val();
               var phone = $("input#phone_zakaz_<?=$id?>").val();
               var email = $("input#email_zakaz_<?=$id?>").val();
               var title = $("input#title").val();
               var name = $("input#name").val();
               var price = $("input#price").val();

               var mess = $("textarea#mess_zakaz_<?=$id?>").val();

               var fd = new FormData();

               fd.append('fio', fio);
               fd.append('name', name);
               fd.append('phone', phone);
               fd.append('email', email);
               fd.append('title', title);
               fd.append('price', price);

               fd.append('mess', mess);

               // fd.append('file', $('#file')[0].files[0]);

               var firstName = name; // For Success/Failure Message
                   // Check for white space in name for Success/Fail message
                   if (firstName.indexOf(' ') >= 0) {
                    firstName = name.split(' ').slice(0, -1).join(' ');
                   }
                      // data: {name: name, phone: phone, email: email, tirag: tirag, mess: mess, type: type, title: title, file},
                      $.ajax({
                        url: "<?=SITE_DIR?>include/recall_me_zakaz.php",
                        type: "POST",
                        data: fd,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",
                        success: function() {
                      // Success message
                      $('#success_zakaz_<?=$id?>').html("<div class='alert alert-success'>");
                      $('#success_zakaz_<?=$id?> > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                      .append( "</button>");
                      $('#success_zakaz_<?=$id?> > .alert-success')
                      .append("<strong>"+firstName+", <?=GetMessage('form_ok')?>.</strong>");
                      $('#success_zakaz_<?=$id?> > .alert-success')
                      .append('</div>');

              //clear all fields
              $('#callback_zakaz_<?=$id?>').trigger("reset");
          },
          error: function() {
            // Fail message
            $('#success_zakaz_<?=$id?>').html("<div class='alert alert-success'>");
            $('#success_zakaz_<?=$id?> > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append( "</button>");
            $('#success_zakaz_<?=$id?> > .alert-success')
            .append("<strong>"+firstName+", <?=GetMessage('form_ok')?>.</strong>");
            $('#success_zakaz_<?=$id?> > .alert-success')
            .append('</div>');

            $('#callback_zakaz_<?=$id?>').trigger("reset");
        },
    })
},
filter: function() {
  return $(this).is(":visible");
},
});
            });