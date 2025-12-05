// ========= top-search start ===========
$(document).ready(function() {

    let search = document.querySelector(".search");
    search.onclick = function() {
        document.querySelector(".mbsearch").classList.toggle('active');
    }
});
// ========= top-search end ===========

// ========= slide start ===========

$(document).ready(function() {
    // partner section srart
    $('.slick').slick({
        dots: true,
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
        dots: true,
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

    $('.show-one').click(function() {
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

    $('.show-two').click(function() {
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

    $('.show-three').click(function() {
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

    $('.show-four').click(function() {
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
});
// ========= slide start ===========



// ================== otp verification start ================ //
let digitValidate = function(ele) {
    console.log(ele.value);
    ele.value = ele.value.replace(/[^0-9]/g, '');
}

let tabChange = function(val) {
    let ele = document.querySelectorAll('.otp');
    if (ele[val - 1].value != '') {
        ele[val].focus()
    } else if (ele[val - 1].value == '') {
        ele[val - 2].focus()
    }
}

// ================== otp verification end ================== //


// ========= quantity start  =========
$(document).ready(function() {

    var buttonPlus = $(".qty-btn-plus");
    var buttonMinus = $(".qty-btn-minus");

    var incrementPlus = buttonPlus.click(function() {
        var $n = $(this)
            .parent(".qty-container")
            .find(".input-qty");
        $n.val(Number($n.val()) + 1);
    });

    var incrementMinus = buttonMinus.click(function() {
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

// ========= zoom-img start  =========
(function($) {
    $.fn.picZoomer = function(options) {
        var opts = $.extend({}, $.fn.picZoomer.defaults, options),
            $this = this,
            $picBD = $('<div class="picZoomer-pic-wp"></div>').css({
                'width': opts.picWidth + 'px',
                'height': opts.picHeight + 'px'
            }).appendTo($this),

            $pic = $this.children('img').addClass('picZoomer-pic').appendTo($picBD),
            $cursor = $('<div class="picZoomer-cursor"><i class="f-is picZoomCursor-ico"></i></div>').appendTo($picBD),

            cursorSizeHalf = {
                w: $cursor.width() / 2,
                h: $cursor.height() / 2
            },
            $zoomWP = $('<div class="picZoomer-zoom-wp"><img class="picZoomer-zoom-pic"></img></div>').appendTo($this),

            $zoomPic = $zoomWP.find('.picZoomer-zoom-pic'),
            picBDOffset = {
                x: $picBD.offset().left,
                y: $picBD.offset().top
            };

        opts.zoomWidth = opts.zoomWidth || opts.picWidth;
        opts.zoomHeight = opts.zoomHeight || opts.picHeight;
        var zoomWPSizeHalf = {
            w: opts.zoomWidth / 2,
            h: opts.zoomHeight / 2
        };


        $zoomWP.css({
            'width': opts.zoomWidth + 'px',
            'height': opts.zoomHeight + 'px'
        });

        $zoomWP.css(opts.zoomerPosition || {
            top: 0,
            left: opts.picWidth + 30 + 'px'
        });

        $zoomPic.css({
            'width': opts.picWidth * opts.scale + 'px',
            'height': opts.picHeight * opts.scale + 'px'
        });

        $picBD.on('mouseenter', function(event) {
            $cursor.show();
            $zoomWP.show();
            $zoomPic.attr('src', $pic.attr('src'))
        }).on('mouseleave', function(event) {
            $cursor.hide();
            $zoomWP.hide();
        }).on('mousemove', function(event) {
            var x = event.pageX - picBDOffset.x,
                y = event.pageY - picBDOffset.y;

            $cursor.css({
                'left': x - cursorSizeHalf.w + 'px',
                'top': y - cursorSizeHalf.h + 'px'
            });

            $zoomPic.css({
                'left': -(x * opts.scale - zoomWPSizeHalf.w) + 'px',
                'top': -(y * opts.scale - zoomWPSizeHalf.h) + 'px'
            });
        });

        return $this;
    };
    $.fn.picZoomer.defaults = {
        picWidth: 300,
        picHeight: 300,
        scale: 2.5,
        zoomerPosition: {
            top: '0',
            left: '350px'
        }
    };
})(jQuery);

$(function() {
    $('.picZoomer').picZoomer();
    $('.piclist li').on('click', function(event) {
        var $pic = $(this).find('img');
        $('.picZoomer-pic').attr('src', $pic.attr('src'));
    });
});

// ========= zoom-img end  ===========




//  ========= frequently start  =========  //
const accordion = document.getElementsByClassName('contentBx');
for (i = 0; i < accordion.length; i++) {
    accordion[i].addEventListener('click', function() {
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


// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("filter-btn");
for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active1");
        current[0].className = current[0].className.replace(" active1", "");
        this.className += " active1";
    });
}
//  ========= our-software section end ============ //