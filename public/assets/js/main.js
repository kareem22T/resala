$(function () {
    // switch between two donates methods
    $('#the_donta').trigger('click')
    $('#location1').trigger('click')

    $('#location1').on('click', function () {
        $('.currency').text('بالجنيه')

    })
    $('#location2').on('click', function () {

        $('.currency').text('بالدولار')
    })

    // switch cart methods 
    $('.banks label').on('click', function () {
        $(this).addClass('active')
        $('.banks label').not(this).removeClass('active')

        if ($("input:radio").attr('checked', true)) {
            $(this).siblings('label').addClass('active')
        }
    })

    $('.switch-btns a').on('click', function (e) {
        e.preventDefault();
        $(this).addClass('active')
        $(this).siblings().removeClass('active')
        $('.donates').css('opacity', 0)
        setTimeout(() => {
            $('.donates').css('opacity', 1)
        }, 500);
    })

    $('.more').on('click', function () {
        $(this).find('ul').fadeToggle()
    })

    $('.menu').on('click', function (e) {
        e.preventDefault()
        $('header nav').removeClass('animate__animated animate__fadeOutRight')
        $('header nav').addClass('animate__animated animate__fadeInRight')
        $('header nav').css('display', 'flex')
        $('header nav').fadeIn('fast')
    })
    $('.close').on('click', function () {
        $('header nav').addClass('animate__animated animate__fadeOutRight')
        $('header nav').fadeOut()
        $('header nav').remove('animate__animated animate__fadeInRight')
        setTimeout(() => {
            $('header nav').removeClass('animate__animated animate__fadeOutRight')
        }, 1000);
    })

})
function validateBank() { // validate cart
    let bank = document.forms["cart_form"]["bank"].value;
    if (bank == "") {
        $(function () {
            $('#validation-msgs').append('<div class="alert alert-danger">عفوا البنك مطلوب</div>')
        })

        document.getElementById('validation-msgs').style.opacity = 1

        setTimeout(() => {
            document.getElementById('validation-msgs').style.opacity = 0
        }, 2000);

        setTimeout(() => {
            $(function () {
                $('#validation-msgs').children().remove()
            })
        }, 2500);

        return false
    }

}

// validation form
function validateForm() {
    let valid = true;
    let name = document.forms["donate-form"]["the_name"].value;
    let email = document.forms["donate-form"]["the_email"].value;
    let phone = document.forms["donate-form"]["the_phone"].value;
    let target = document.forms["donate-form"]["donation_target"].value;
    let price = document.forms["donate-form"]["price"].value;

    let form_content = [
        {
            input: name,
            error_msg: "عفوا الاسم مطلوب"
        },
        {
            input: email,
            error_msg: "عفوا البريد الالكتروني مطلوب"
        },
        {
            input: phone,
            error_msg: "عفوا رقم الهاتف مطلوب"
        },
        {
            input: target,
            error_msg: "عفوا جهة التبرع مطلوبة"
        },
        {
            input: price,
            error_msg: "عفوا قيمة التبرع مطلوبة"
        },
    ]

    for (let index = 0; index < form_content.length; index++) {
        if (form_content[index].input == "") {
            $(function () {
                $('#validation-msgs').append('<div class="alert alert-danger">' + form_content[index].error_msg + '</div>')
            })
            valid = false
        }
    }

    document.getElementById('validation-msgs').style.opacity = 1

    setTimeout(() => {
        document.getElementById('validation-msgs').style.opacity = 0
    }, 2000);

    setTimeout(() => {
        $(function () {
            $('#validation-msgs').children().remove()
        })
    }, 2500);

    return valid;

}
