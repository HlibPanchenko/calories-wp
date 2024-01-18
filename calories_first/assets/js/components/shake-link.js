document.addEventListener("DOMContentLoaded", function () {
    setInterval(function () {
        /*элементы, которы мы хотим трясти, должны просто иметь этот класс - shaked-el*/
        const links = document.querySelectorAll('.shaked-el');

        links.forEach(function (link) {
            link.classList.add('shake');

            setTimeout(function () {
                link.classList.remove('shake');
            }, 500); // Время анимации в миллисекундах
        });
    }, 3000); // Интервал тряски в миллисекундах
});
