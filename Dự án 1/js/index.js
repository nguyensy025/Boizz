ScrollReveal({
  reset: true,
  distance: "60px",
  duration: 2500,
  delay: 400,
});

ScrollReveal().reveal(".slogantext , .danhmuc ,.hot ,.gioithieu ,.phukien ", {
  delay: 500,
  origin: "left",
});
ScrollReveal().reveal(".slogan img", {
  delay: 500,
  origin: "bottom",
});

// };
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides((slideIndex += n));
}

function currentSlide(n) {
  showSlides((slideIndex = n));
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
}

var giohang = JSON.parse(localStorage.getItem("cart"));
