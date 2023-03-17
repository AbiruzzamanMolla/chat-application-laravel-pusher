import './bootstrap';

toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-left",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

$(document).ready(function(){

    $(document).on('click','#send_message',function (e){
        e.preventDefault();

        let username = $('#username').val();
        let message = $('#message').val();

        if(username == '' || message == ''){
            alert('Please enter both username and message')
            return false;
        }

        $.ajax({
            method:'POST',
            url:'/send-message',
            data: {
                username: username,
                message: message,
            },
            success: function (res) {
                console.log(res);
                if (res.success) {
                    toastr.success(res.message);
                    $('#message').val('');
                }
            }
        });

    });
});

window.Echo.channel('chat')
    .listen('.message', (e) => {
        let username = $('#username').val();
        $('#emptyMessage').hide();
        if (username !== e.username) {
            toastr.success("New message!");
            $('#messages').append('<p><strong>'+e.username+'</strong>'+ ': ' + e.message+'</p>');
        } else {
            $('#messages').append('<p class="d-flex justify-content-end"><strong>'+e.username+'</strong>'+ ': ' + e.message+'</p>');
        }
    });