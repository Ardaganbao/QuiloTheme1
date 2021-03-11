 

(function () {
    addEventListener('load', (event) => {


        //*take care of the main menu -----------------------------------
        var menu_btn = document.getElementById("menu_toggle_icon");
        menu_btn.addEventListener("click", function (e) {
            e.preventDefault();
            document.body.classList.toggle('navbarNavDropdown_show')

        }, false);
        //*-------------------------------------------------------------

        var allpages = document.getElementById("allpages");
        allpages.onscroll = function() {stickyFunction()};

        // Get the header
        var header = document.getElementById("header");

        // Get the offset position of the navbar
        var sticky = header.offsetTop;

        // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function stickyFunction() {
        if (allpages.scrollTop > sticky) {
            document.body.classList.add("sticky");
        } else {
            document.body.classList.remove("sticky");
        }
        }

    });


})();

