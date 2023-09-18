var options = {
  accessibility: true,
  prevNextButtons: true,
  pageDots: true,
  setGallerySize: false,
  arrowShape: {
    x0: 10,
    x1: 60,
    y1: 50,
    x2: 60,
    y2: 45,
    x3: 15
  }
};

var carousel = document.querySelector('[data-carousel]');
var slides = document.getElementsByClassName('carousel-cell');
var flkty = new Flickity(carousel, options);

flkty.on('scroll', function () {
  flkty.slides.forEach(function (slide, i) {
    var image = slides[i];
    var x = (slide.target + flkty.x) * -1/3;
    image.style.backgroundPosition = x + 'px';
  });
});

$(".nav-item").on("click", function(e){
  $("li.nav-item").removeClass("active");
  $(this).addClass("active");
});

// add lead pray
$('body').on('click', '.lead-pray-btn', function() {
  var prayer_id = $(this).attr('data-id');
  var date = $(this).attr('data-date');
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }); 
  $.ajax({
    url:'/add-lead-pray',
    method:'post',
    data:{
        date:date,
        prayer_id:prayer_id
    },
    success:function(response){
      date = new Date(date);
      const tab = localStorage.getItem("tab");
      getPrayers(date, tab);

      Toastify({
        text: response.message,
        duration: 3000,
        destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
          background: "green",
        },
        onClick: function(){} // Callback after click
      }).showToast(); 

    },
    error:function(error){ 
      Toastify({
        text: error.responseJSON.message,
        duration: 3000,
        destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
          background: "#dc3545",
        },
        onClick: function(){} // Callback after click
      }).showToast(); 
    }
  }); 

});


$(".prayer-tab").click(function(){
  
  var tab = $(this).attr('data-id'); 
  var date = new Date();
  localStorage.setItem("tab", tab);
  getPrayers(date, tab);
});


$(".prayer-tab").on("click", function(e){
  $("a.prayer-tab").removeClass("active");
  $(this).addClass("active");
});




// getting url and showing calendar according to url 

