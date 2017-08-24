$(document).ready(
        $('#login-form').on('beforeSubmit', function(event, jqXHR, settings) {
                var form = $(this);
                if(form.find('.has-error').length) {
                        return false;
                }
                
                $.ajax({
                        url: form.attr('action'),
                        type: 'post',
                        data: form.serialize(),
                        success: function(data) {
                                // do something ...
                                console.log(data);
                                alert("succces");
                        }
                });
                
                return false;
        })
)