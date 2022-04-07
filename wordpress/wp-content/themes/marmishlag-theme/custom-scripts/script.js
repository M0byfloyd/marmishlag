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
        let lastPosition = Number(
          el.style.transform.replace(/translateX\(|px\)/g, "")
        );

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

  if (nbOfPortionsSetter && ingredients) {
    nbOfPortionsSetter
      .querySelector("#add_portion")
      .addEventListener("mousedown", () =>
        addPortion(nbOfPortionsSetter, ingredients)
      );
    nbOfPortionsSetter
      .querySelector("#remove_portion")
      .addEventListener("mousedown", () =>
        removePortion(nbOfPortionsSetter, ingredients)
      );
  }

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

  // const preparationSteps = document.querySelectorAll('.preparation-steps p');

  // if (preparationSteps) {
  //   preparationSteps.forEach((step, i) => {
  //     window.getComputedStyle(
  //       step, ':before'
  //   )['content'] = `"${i + 1}"`;
  //   })
  // }

  const recipeIngredients = document.querySelectorAll(
    ".create-recette .add-new-item"
  );

  if (recipeIngredients) {
    recipeIngredients.forEach((button) => {
      button.addEventListener("click", () => {
        let name;
        if (button.dataset.type == "ingredient") name = 'ingredient';
        else if (button.dataset.type == "ustensile") name = 'ustensile';
        
        button.previousElementSibling.innerHTML += `<div class="${name}">
        <div class="${name}-quantity">
        <input type="number" name="${name}-quantity" min="1" value="1">
        <select name="${name}-quantity-type" id="${name}_quantity_type">
        <option value="cas">c.à.s</option>
        <option value="g">g</option>
        <option value="cl">cl</option>
        </select>
        </div>
        <input type="text" class="${name}-name" value="">
        </div>`;
      });
    });
  }
};
