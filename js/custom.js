document.addEventListener("DOMContentLoaded", function() {
  // Logo Preloader
  var preloader = document.querySelector("#preloader");

  // Add the "hidden" class to the preloader to fade it out
  preloader.classList.add("hidden");

  // Remove the preloader from the DOM after the animation is complete
  setTimeout(function() {
      preloader.parentNode.removeChild(preloader);
  }, 500);
});

document.addEventListener("DOMContentLoaded", function() {
  // Navbar toggler
  $(document).ready(function() {
    $('.navbar-toggler').click(function() {
      $('.navbar-collapse').toggleClass('collapsing');
    });
  });
});

document.addEventListener("DOMContentLoaded", function() {
  // Chat icon
  document.getElementById("chatIcon").addEventListener("click", function() {
    window.open("https://your-chat-page.com", "chatWindow", "width=400,height=600");
  });
});
document.addEventListener("DOMContentLoaded",function(){
  window.onload = function() {
    document.getElementById("contactp").style.opacity = 1;
  };
})
