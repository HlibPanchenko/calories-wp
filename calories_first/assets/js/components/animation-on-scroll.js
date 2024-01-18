// навесить класс "._anim-items" на элемент, на который будет навешиваться "active" по скроллу
// все элементы, которые будут поддаваться анимации
const animItems = document.querySelectorAll("._anim-items");

if (animItems.length > 0) {
  window.addEventListener("scroll", animOnScroll);
  function animOnScroll() {
    for (let index = 0; index < animItems.length; index++) {
      const animItem = animItems[index];
      // высота объекта, который будем анимировать
      const animItemHeight = animItem.offsetHeight;
      // расстояние объекта до верха страницы
      const animItemOffset = offset(animItem).top;
      // класс будет навешиваться когда видно 1\4 высоты объекта, который будем анимировать
      const animStart = 4;
      // момент старта анимации - когда будет навешиваться класс
      // высота окна браузера - высота объекта / коф
      let animItemPoint = window.innerHeight - animItemHeight / animStart;
      // случай если анимированый объект выше окна браузера
      if (animItemHeight > window.innerHeight) {
        animItemPoint = window.innerHeight - window.innerHeight / animStart;
      }
      // pageYOffset - переменная о проскролленых пикселях
      if (
        pageYOffset > animItemOffset - animItemPoint &&
        pageYOffset < animItemOffset + animItemHeight
      ) {
        animItem.classList.add("_active");
      } else {
        // можно закомментировать если тебе такое не надо и вернуть просто "animItem.classList.remove("_active") (35 строка)"
        // чтобы не анимировать объект повторно
        if (!animItem.classList.contains("_anim-no-hide")) {
          animItem.classList.remove("_active");
        }
        //   animItem.classList.remove("_active");
      }
    }
  }
  function offset(el) {
    const rect = el.getBoundingClientRect(),
      scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
      scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    return {
      top: rect.top + scrollTop,
      left: rect.left + scrollLeft,
    };
  }
  // если анимированые объекты сразу видны на странице, то анимация сразу будет происходить, даже без скролла
  animOnScroll();
}
