!function(e){"use strict";var t=localStorage.getItem("language"),n="en";function a(l){document.getElementById("header-lang-img")&&("en"==l?document.getElementById("header-lang-img").src="assets/images/flags/us.jpg":"sp"==l?document.getElementById("header-lang-img").src="assets/images/flags/spain.jpg":"gr"==l?document.getElementById("header-lang-img").src="assets/images/flags/germany.jpg":"it"==l?document.getElementById("header-lang-img").src="assets/images/flags/italy.jpg":"ru"==l&&(document.getElementById("header-lang-img").src="assets/images/flags/russia.jpg"),localStorage.setItem("language",l),null==(t=localStorage.getItem("language"))&&a(n),e.getJSON("assets/lang/"+t+".json",function(n){e("html").attr("lang",t),e.each(n,function(t,n){"head"===t&&e(document).attr("title",n.title),e("[key='"+t+"']").text(n)})}))}function l(){for(var e=document.getElementById("topnav-menu-content").getElementsByTagName("a"),t=0,n=e.length;t<n;t++)"nav-item dropdown active"===e[t].parentElement.getAttribute("class")&&(e[t].parentElement.classList.remove("active"),null!==e[t].nextElementSibling&&e[t].nextElementSibling.classList.remove("show"))}function c(){document.webkitIsFullScreen||document.mozFullScreen||document.msFullscreenElement||(console.log("pressed"),e("body").removeClass("fullscreen-enable"))}e("#side-menu").metisMenu(),e("#vertical-menu-btn").on("click",function(t){t.preventDefault(),e("body").toggleClass("sidebar-enable"),992<=e(window).width()?e("body").toggleClass("vertical-collpsed"):e("body").removeClass("vertical-collpsed")}),e("#sidebar-menu a").each(function(){var t=window.location.href.split(/[?#]/)[0];this.href==t&&(e(this).addClass("active"),e(this).parent().addClass("mm-active"),e(this).parent().parent().addClass("mm-show"),e(this).parent().parent().prev().addClass("mm-active"),e(this).parent().parent().parent().addClass("mm-active"),e(this).parent().parent().parent().parent().addClass("mm-show"),e(this).parent().parent().parent().parent().parent().addClass("mm-active"))}),e(document).ready(function(){var t;0<e("#sidebar-menu").length&&0<e("#sidebar-menu .mm-active .active").length&&300<(t=e("#sidebar-menu .mm-active .active").offset().top)&&(t-=300,e(".vertical-menu .simplebar-content-wrapper").animate({scrollTop:t},"slow"))}),e(".navbar-nav a").each(function(){var t=window.location.href.split(/[?#]/)[0];this.href==t&&(e(this).addClass("active"),e(this).parent().addClass("active"),e(this).parent().parent().addClass("active"),e(this).parent().parent().parent().addClass("active"),e(this).parent().parent().parent().parent().addClass("active"),e(this).parent().parent().parent().parent().parent().addClass("active"),e(this).parent().parent().parent().parent().parent().parent().addClass("active"))}),e('[data-bs-toggle="fullscreen"]').on("click",function(t){t.preventDefault(),e("body").toggleClass("fullscreen-enable"),document.fullscreenElement||document.mozFullScreenElement||document.webkitFullscreenElement?document.cancelFullScreen?document.cancelFullScreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitCancelFullScreen&&document.webkitCancelFullScreen():document.documentElement.requestFullscreen?document.documentElement.requestFullscreen():document.documentElement.mozRequestFullScreen?document.documentElement.mozRequestFullScreen():document.documentElement.webkitRequestFullscreen&&document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT)}),document.addEventListener("fullscreenchange",c),document.addEventListener("webkitfullscreenchange",c),document.addEventListener("mozfullscreenchange",c),e(".right-bar-toggle").on("click",function(t){e("body").toggleClass("right-bar-enabled")}),e(document).on("click","body",function(t){0<e(t.target).closest(".right-bar-toggle, .right-bar").length||e("body").removeClass("right-bar-enabled")}),function(){if(document.getElementById("topnav-menu-content")){for(var e=document.getElementById("topnav-menu-content").getElementsByTagName("a"),t=0,n=e.length;t<n;t++)e[t].onclick=function(e){"#"===e.target.getAttribute("href")&&(e.target.parentElement.classList.toggle("active"),e.target.nextElementSibling.classList.toggle("show"))};window.addEventListener("resize",l)}}(),[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function(e){return new bootstrap.Tooltip(e)}),[].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map(function(e){return new bootstrap.Popover(e)}),[].slice.call(document.querySelectorAll(".offcanvas")).map(function(e){return new bootstrap.Offcanvas(e)}),e("#password-addon").on("click",function(){0<e(this).siblings("input").length&&("password"==e(this).siblings("input").attr("type")?e(this).siblings("input").attr("type","input"):e(this).siblings("input").attr("type","password"))}),null!=t&&t!==n&&a(t),e(".language").on("click",function(t){a(e(this).attr("data-lang"))}),e(window).on("load",function(){e("#status").fadeOut(),e("#preloader").delay(350).fadeOut("slow")}),Waves.init(),e("#checkAll").on("change",function(){e(".table-check .form-check-input").prop("checked",e(this).prop("checked"))}),e(".table-check .form-check-input").change(function(){e(".table-check .form-check-input:checked").length==e(".table-check .form-check-input").length?e("#checkAll").prop("checked",!0):e("#checkAll").prop("checked",!1)})}(jQuery);
