document.addEventListener("DOMContentLoaded", function(event) {
    $('.form_submit').click(function(){
        var form = $(this).closest('form');
        actionPath = form.attr('action').split(':')[0];

        if(actionPath === 'https') {
            form.submit();
        } else {
            alert('Een aanvaller houdt mogelijk uw wachtwoordinvoer in de gaten. Inloggen is geblokkeerd. Maak verbinding met een vertrouwd netwerk en probeer het nogmaals.');
        }
    })

    $('a').click(function(e){
        actionPath = $(this).attr('href').split(':')[0];

        if(actionPath === 'https' || actionPath === '#' || $(this).hasClass('form_submit')) {
            // console.log(actionPath); return false;
            return true;
        } else {
            // console.log(actionPath); return false;

            window.location.href = "https://mediapropulsion.nl/login/destroy/Uw verbining is mogelijk niet veilig. Als voorzorgsmaatregel bent u automatisch uitgelogd.";
            e.preventDefault();
        }
    })
});