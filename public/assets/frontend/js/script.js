document.addEventListener('livewire:navigated', () => {
    // ========= top-search start ===========
   

        let search = document.querySelector(".search");
        search.onclick = function () {
            document.querySelector(".mbsearch").classList.toggle('active');
        }

    // ========= top-search end ===========

    // ========= slide start ===========


        // partner section srart
        $('.slick').slick({
            dots: false,
            arrows: false,
            infinite: true,
            autoplay: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
            ]
        });
        // partner section end

        // clients section start
        $('.clients').slick({
            dots: false,
            arrows: false,
            infinite: true,
            autoplay: true,
            speed: 300,
            slidesToShow: 5,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
            ]
        });
        // clients section end

        // recent section start

        // recent section end

        // product-detail start

        $('.show-one').click(function () {
            $('.details').show();
            $('.reviews').hide();
            $('.shipping').hide();
            $('.seller').hide();
            $('.show-one').css({
                color: '#127FFF'
            });
            $('.show-three').css({
                color: '#8B96A5'
            });
            $('.show-two').css({
                color: '#8B96A5'
            });
            $('.show-four').css({
                color: '#8B96A5'
            });
        });

        $('.show-two').click(function () {
            $('.details').hide();
            $('.reviews').show();
            $('.shipping').hide();
            $('.seller').hide();
            $('.show-two').css({
                color: '#127FFF'
            });
            $('.show-one').css({
                color: '#8B96A5'
            });
            $('.show-three').css({
                color: '#8B96A5'
            });
            $('.show-four').css({
                color: '#8B96A5'
            });
        });

        $('.show-three').click(function () {
            $('.details').hide();
            $('.reviews').hide();
            $('.shipping').show();
            $('.seller').hide();
            $('.show-three').css({
                color: '#127FFF'
            });
            $('.show-one').css({
                color: '#8B96A5'
            });
            $('.show-two').css({
                color: '#8B96A5'
            });
            $('.show-four').css({
                color: '#8B96A5'
            });
        });

        $('.show-four').click(function () {
            $('.details').hide();
            $('.reviews').hide();
            $('.shipping').hide();
            $('.seller').show();
            $('.show-four').css({
                color: '#127FFF'
            });
            $('.show-one').css({
                color: '#8B96A5'
            });
            $('.show-two').css({
                color: '#8B96A5'
            });
            $('.show-three').css({
                color: '#8B96A5'
            });
        });
        // product-detail end

    // ========= slide start ===========



    // ================== otp verification start ================ //
    let digitValidate = function (ele) {
        console.log(ele.value);
        ele.value = ele.value.replace(/[^0-9]/g, '');
    }

    let tabChange = function (val) {
        let ele = document.querySelectorAll('.otp');
        if (ele[val - 1].value != '') {
            ele[val].focus()
        } else if (ele[val - 1].value == '') {
            ele[val - 2].focus()
        }
    }

    // ================== otp verification end ================== //


    // ========= quantity start  =========
    $(document).ready(function () {

        var buttonPlus = $(".qty-btn-plus");
        var buttonMinus = $(".qty-btn-minus");

        var incrementPlus = buttonPlus.click(function () {
            var $n = $(this)
                .parent(".qty-container")
                .find(".input-qty");
            $n.val(Number($n.val()) + 1);
        });

        var incrementMinus = buttonMinus.click(function () {
            var $n = $(this)
                .parent(".qty-container")
                .find(".input-qty");
            var amount = Number($n.val());
            if (amount > 0) {
                $n.val(amount - 1);
            }
        });

    });
    // ========= quantity end  =========


    //  ========= frequently start  =========  //
    const accordion = document.getElementsByClassName('contentBx');
    for (i = 0; i < accordion.length; i++) {
        accordion[i].addEventListener('click', function () {
            this.classList.toggle('frequently-active')
        })
    }
    //  ========= frequently end ========= //

    //  ========= countdown start ========= //

    //  ========= countdown end ========= //

    //  ========= our-software section start ========= //
    filterSelection("clinic")

    function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("column");
        if (c == "all") c = "";
        for (i = 0; i < x.length; i++) {
            w3RemoveClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
        }
    }

    function w3AddClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
                element.className += " " + arr2[i];
            }
        }
    }

    function w3RemoveClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
        }
        element.className = arr1.join(" ");
    }

    //  ========= our-software section end ============ //
});