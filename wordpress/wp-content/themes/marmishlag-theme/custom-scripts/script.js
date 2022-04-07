window.onload = () => {
  document.querySelectorAll(".marmishlag-drag-slider").forEach((slider) => {
    slider.addEventListener("mousedown", () => {
      startDrag(slider);
    });
    window.addEventListener("mouseup", () => {
      stopDrag(slider);
    });
  });

  function startDrag(el) {
    const childWidth = el.querySelector("[class*=-list]").clientWidth;
    const elementWidth = el.clientWidth;

    let lastX = null;

    window.onmousemove = (e) => {
      if (!el.style.transform) {
        el.style.transform = "translateX(0px)";
      }

      if (lastX) {
        let lastPosition = Number(el.style.transform.replace(/translateX\(|px\)/g, ""));

        let newPos = lastPosition + (e.x - lastX);

        if (newPos < 0 && Math.abs(newPos) < childWidth - elementWidth) {
          el.style.transform = `translateX(${newPos}px)`;
        }
      }

      lastX = e.x;
    };
  }

  function stopDrag(el) {
    window.onmousemove = null;
  }

  const nbOfPortionsSetter = document.querySelector(".number-of-portion");
  const ingredients = document.querySelectorAll(".ingredient-quantity");

  let portions = 1;

  nbOfPortionsSetter.querySelector("#add_portion").addEventListener("mousedown", () => addPortion(nbOfPortionsSetter, ingredients));
  nbOfPortionsSetter.querySelector("#remove_portion").addEventListener("mousedown", () => removePortion(nbOfPortionsSetter, ingredients));

  function addPortion(el, list) {
    portions++;

    el.querySelector(".portions").innerText = portions;
    list.forEach((ingredient) => {
      const ingredientData = ingredient.dataset.defaultValue;
      ingredient.innerText = ingredientData * portions;
    });
  }

  function removePortion(el, list) {
    if (portions > 1) portions--;

    el.querySelector(".portions").innerText = portions;
    list.forEach((ingredient) => {
      const ingredientData = ingredient.dataset.defaultValue;
      ingredient.innerText = ingredientData * portions;
    });
  }
};
