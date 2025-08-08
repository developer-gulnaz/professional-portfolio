$(function () {
    $("#contactForm input, #contactForm textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function ($form, event, errors) {
        },
        submitSuccess: function ($form, event) {
            event.preventDefault();

            var name = $("input#name").val();
            var email = $("input#email").val();
            var subject = $("input#subject").val();
            var message = $("textarea#message").val();

            var $this = $("#sendMessageButton");
            $this.prop("disabled", true);

            $.ajax({
    url: "https://formspree.io/f/mkgzplbr",
    method: "POST",
    data: {
        name: name,
        email: email,
        subject: subject,
        message: message
    },
    dataType: "json",
    success: function () {
        $('#success').html("<div class='alert alert-success'>Your message has been sent!</div>");
        $('#contactForm').trigger("reset");
    },
    error: function () {
        $('#success').html("<div class='alert alert-danger'>Something went wrong. Please try again later.</div>");
    }
});

        },
        filter: function () {
            return $(this).is(":visible");
        }
    });

    $("a[data-toggle=\"tab\"]").click(function (e) {
        e.preventDefault();
        $(this).tab("show");
    });
});

$('#name').focus(function () {
    $('#success').html('');
});
