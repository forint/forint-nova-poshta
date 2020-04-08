(function() {
    'use strict';
    window.addEventListener('load', function() {

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');

        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);

    $(function() {
        $('input[name="daterange"]').daterangepicker({
            locale: {
                format: {
                    startDate: 'YYYY/MM/DD',
                    endDate: 'MM.DD.YYYY',
                }
                // direction: 'rgh',
            },
            //autoApply: true,
            opens: "right",
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
})();

/** Add task form validation */
function takeData(isAjax) {

    let inputs = document.querySelectorAll(".needs-validation input, .needs-validation textarea");

    /* Break, if not pass validation */
    for (let i = 0; i < inputs.length; i++) {
        if (!inputs[i].validity.valid){
            return false;
        }
    }

    if (!isAjax) {
        $('#form-task-add').removeAttr('onsubmit');
        $('#form-task-add').submit();
    }else{
        $.ajax({
            url: $('#homepage-form__date-range').attr('action'),
            dataType: 'json',
            data: {
                'isAjax': true,
                'daterange': $("#date-range").val()
            },
            async: true,
            method: 'POST',
            beforeSend: function () {},
            success: function (response) {
                $(".date-range-diff").html('<p>'+ response['diff_date'] +'</p>');
                const params = new URLSearchParams(window.location.search);
                params.set('id', response['id']);
                window.history.pushState({}, 'Date loaded with ajax', decodeURIComponent(`${window.location.pathname}?${params}`));
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $(".date-range-diff").html('<p class="messages invalid">Произошла непредвиденная ошибка. Пожалуйста повторите попытку.</p>');
            },
        })
    }

}