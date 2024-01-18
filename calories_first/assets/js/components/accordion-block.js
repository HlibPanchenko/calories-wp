jQuery(document).ready(function($) {
    var accButtons = document.getElementsByClassName("accordion-1_btn");

    for (var i = 0; i < accButtons.length; i++) {
        (function(index) {
            accButtons[index].addEventListener("click", function() {
                // Закрывает все элементы, кроме текущего
                for (var j = 0; j < accButtons.length; j++) {
                    if (j !== index) {
                        var content = accButtons[j].nextElementSibling;
                        content.style.maxHeight = null;
                        $(accButtons[j]).removeClass("active");
                        $(accButtons[j]).find(".accordion-1_arrow").removeClass("opened");
                    }
                }

                // Открывает или закрывает текущий элемент
                var content = this.nextElementSibling;
                content.style.maxHeight = content.style.maxHeight ? null : content.scrollHeight + "px";
                $(this).toggleClass("active");
                $(this).find(".accordion-1_arrow").toggleClass("opened");
            });
        })(i);
    }
});
