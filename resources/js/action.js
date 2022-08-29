window.onscroll = function() { myFunction()};

var navbar = document.getElementById("nav2");
var btnup = document.getElementById("btnup");
var sticky = navbar.offsetTop;

btnup.addEventListener('click',function(){
            $("html, body").animate({ scrollTop: 0 }, 1000);
})

function myFunction() {
           
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
    btnup.classList.remove("d-none");
   
  } else {
    navbar.classList.remove("sticky");
    btnup.classList.add("d-none");
  }
}
$('#mybtn').click(function(){
            alert('aww im clicked');
})
