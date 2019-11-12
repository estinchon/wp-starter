import barba from "@barba/core";
import barbaCss from "@barba/css";

import { general as utilsGeneral } from "../utils";
import { initComponents, callComponents, clearComponents } from "../components";

function initBarba() {
  barba.use(barbaCss);

  barba.hooks.all.forEach(hook => {
    barba.hooks[hook](data => {
      callComponents("onTransition", { hook, data });
    });
  });

  barba.init({
    transitions: [
      {
        beforeEnter({ next }) {
          initComponents(next.container, true);
          clearComponents();
        }
      }
    ]
  });
}

if (!utilsGeneral.isEditing()) {
  initBarba();
}
