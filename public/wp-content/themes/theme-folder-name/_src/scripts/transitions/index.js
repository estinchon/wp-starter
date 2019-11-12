import barba from "@barba/core";
import barbaCss from "@barba/css";

import { general as utilsGeneral } from "../utils";
import { initComponents, clearComponents } from "../components";

function initBarba() {
  barba.use(barbaCss);
  barba.init();
}

if (!utilsGeneral.isEditing()) {
  initBarba();
}
