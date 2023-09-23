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
      const selected = localStorage.getItem("selectedDay"); 
      if(selected===null || selected===undefined){ 
        date = new Date(date);
      }else{ 
        date = new Date(localStorage.getItem("selectedDay")); 
      }

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


$("a.prayer-tab").removeClass("active");
const defaultTab = localStorage.getItem("tab"); 
if(defaultTab === null){
  $('.daily-tab').addClass("active");
}else{
  $('.'+defaultTab+'-tab').addClass("active");
}

$(".prayer-tab").click(function(){

  $("a.prayer-tab").removeClass("active");
  $(this).addClass("active");
  var tab = $(this).attr('data-id');
  const selected = localStorage.getItem("selectedDay"); 
  if(selected===null || selected===undefined){ 
    var date = new Date();
  }else{ 
    var date = new Date(localStorage.getItem("selectedDay")); 
  }  
  localStorage.setItem("tab", tab);
  getPrayers(date, tab);
});
 
function removeLeader(event){
  event.stopPropagation();
  var prayer_id =  event.target.getAttribute('data-id');
  var date =  event.target.getAttribute('data-date');

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }); 
  $.ajax({
    url:'/remove-lead-pray',
    method:'post',
    data:{
        prayer_date:date,
        prayer_id:prayer_id
    },
    success:function(response){ 

      const selected = localStorage.getItem("selectedDay"); 
      if(selected===null || selected===undefined){ 
        date = new Date(date);
      }else{ 
        date = new Date(localStorage.getItem("selectedDay")); 
      }

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
}

// getting url and showing calendar according to url 

