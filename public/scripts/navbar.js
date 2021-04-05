//collapse top navbar on mobile devices
function navbarCollapse() {
    let links = document.getElementById("myLinks");
    if (links.style.display === "block") {
        links.style.display = "none";
    } else {
        links.style.display = "block";
    }
  }

// When the user scrolls the page, execute stickNavbar
window.onscroll = function() {stickNavbar()};

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function stickNavbar() {
// Get the navbar, sidenav and logo (header) 
let navbar = document.querySelector(".top-nav");
let sidenav = document.querySelector(".side-nav");
let header = document.querySelector("#logo");
let body = document.querySelector("html");
let dropdown = document.querySelectorAll(".dropdown-content");

// Get the offset position of the navbar (through size of responsive logo)
let sticky = header.offsetHeight;

//console.log ("body:", body.offsetHeight, "screen:", screen.height, "sticky:", sticky)

//check length of the page (if it too short then sticky navbar is not applied)
    if (window.pageYOffset > sticky && body.offsetHeight > screen.height + sticky + navbar.offsetHeight) {
        document.querySelector("main").style.marginTop = sticky;
        navbar.classList.add("sticky");

        //dropdown buttons in navbar 
        for (let i = 0; i < dropdown.length; i++) {
            dropdown[i].classList.add("dropdown-content-sticky");
        }

        if(sidenav) {
            sidenav.classList.remove("absolute");
            sidenav.classList.add("sticky-side");
        }
    } else {
        document.querySelector("main").style.marginTop = 0;
        navbar.classList.remove("sticky");

        //dropdown buttons in navbar 
        for (let i = 0; i < dropdown.length; i++) {
            dropdown[i].classList.remove("dropdown-content-sticky");
        }
        
        if(sidenav) {
          sidenav.classList.add("absolute");
            sidenav.classList.remove("sticky-side");  
        }       
    }
    
}