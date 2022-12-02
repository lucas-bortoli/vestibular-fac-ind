!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e="undefined"!=typeof globalThis?globalThis:e||self).MicroModal=t()}(this,function(){"use strict";function e(e,t){for(var o=0;o<t.length;o++){var n=t[o];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}function f(e){return function(e){if(Array.isArray(e))return n(e)}(e)||function(e){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(e))return Array.from(e)}(e)||function(e,t){if(e){if("string"==typeof e)return n(e,t);var o=Object.prototype.toString.call(e).slice(8,-1);return"Object"===o&&e.constructor&&(o=e.constructor.name),"Map"===o||"Set"===o?Array.from(e):"Arguments"===o||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(o)?n(e,t):void 0}}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function n(e,t){(null==t||t>e.length)&&(t=e.length);for(var o=0,n=new Array(t);o<t;o++)n[o]=e[o];return n}var t,s,l,i,c,o=(t=["a[href]","area[href]",'input:not([disabled]):not([type="hidden"]):not([aria-hidden])',"select:not([disabled]):not([aria-hidden])","textarea:not([disabled]):not([aria-hidden])","button:not([disabled]):not([aria-hidden])","iframe","object","embed","[contenteditable]",'[tabindex]:not([tabindex^="-"])'],e(h.prototype,[{key:"registerTriggers",value:function(){for(var t=this,e=arguments.length,o=new Array(e),n=0;n<e;n++)o[n]=arguments[n];o.filter(Boolean).forEach(function(e){e.addEventListener("click",function(e){return t.showModal(e)})})}},{key:"showModal",value:function(){var e,t=this,o=0<arguments.length&&void 0!==arguments[0]?arguments[0]:null;this.activeElement=document.activeElement,this.modal.setAttribute("aria-hidden","false"),this.modal.classList.add(this.config.openClass),this.scrollBehaviour("disable"),this.addEventListeners(),this.config.awaitOpenAnimation?(e=function e(){t.modal.removeEventListener("animationend",e,!1),t.setFocusToFirstNode()},this.modal.addEventListener("animationend",e,!1)):this.setFocusToFirstNode(),this.config.onShow(this.modal,this.activeElement,o)}},{key:"closeModal",value:function(){var t,e=0<arguments.length&&void 0!==arguments[0]?arguments[0]:null,o=this.modal;this.modal.setAttribute("aria-hidden","true"),this.removeEventListeners(),this.scrollBehaviour("enable"),this.activeElement&&this.activeElement.focus&&this.activeElement.focus(),this.config.onClose(this.modal,this.activeElement,e),this.config.awaitCloseAnimation?(t=this.config.openClass,this.modal.addEventListener("animationend",function e(){o.classList.remove(t),o.removeEventListener("animationend",e,!1)},!1)):o.classList.remove(this.config.openClass)}},{key:"closeModalById",value:function(e){this.modal=document.getElementById(e),this.modal&&this.closeModal()}},{key:"scrollBehaviour",value:function(e){if(this.config.disableScroll){var t=document.querySelector("body");switch(e){case"enable":Object.assign(t.style,{overflow:""});break;case"disable":Object.assign(t.style,{overflow:"hidden"})}}}},{key:"addEventListeners",value:function(){this.modal.addEventListener("touchstart",this.onClick),this.modal.addEventListener("click",this.onClick),document.addEventListener("keydown",this.onKeydown)}},{key:"removeEventListeners",value:function(){this.modal.removeEventListener("touchstart",this.onClick),this.modal.removeEventListener("click",this.onClick),document.removeEventListener("keydown",this.onKeydown)}},{key:"onClick",value:function(e){(e.target.hasAttribute(this.config.closeTrigger)||e.target.parentNode.hasAttribute(this.config.closeTrigger))&&(e.preventDefault(),e.stopPropagation(),this.closeModal(e))}},{key:"onKeydown",value:function(e){27===e.keyCode&&this.closeModal(e),9===e.keyCode&&this.retainFocus(e)}},{key:"getFocusableNodes",value:function(){var e=this.modal.querySelectorAll(t);return Array.apply(void 0,f(e))}},{key:"setFocusToFirstNode",value:function(){var e,t,o=this;this.config.disableFocus||0!==(e=this.getFocusableNodes()).length&&(0<(t=e.filter(function(e){return!e.hasAttribute(o.config.closeTrigger)})).length&&t[0].focus(),0===t.length&&e[0].focus())}},{key:"retainFocus",value:function(e){var t,o=this.getFocusableNodes();0!==o.length&&(o=o.filter(function(e){return null!==e.offsetParent}),this.modal.contains(document.activeElement)?(t=o.indexOf(document.activeElement),e.shiftKey&&0===t&&(o[o.length-1].focus(),e.preventDefault()),!e.shiftKey&&0<o.length&&t===o.length-1&&(o[0].focus(),e.preventDefault())):o[0].focus())}}]),s=h,l=null,i=function(e){if(!document.getElementById(e))return console.warn("MicroModal: ❗Seems like you have missed %c'".concat(e,"'"),"background-color: #f8f9fa;color: #50596c;font-weight: bold;","ID somewhere in your code. Refer example below to resolve it."),console.warn("%cExample:","background-color: #f8f9fa;color: #50596c;font-weight: bold;",'<div class="modal" id="'.concat(e,'"></div>')),!1},c=function(e,t){if(e.length<=0&&(console.warn("MicroModal: ❗Please specify at least one %c'micromodal-trigger'","background-color: #f8f9fa;color: #50596c;font-weight: bold;","data attribute."),console.warn("%cExample:","background-color: #f8f9fa;color: #50596c;font-weight: bold;",'<a href="#" data-micromodal-trigger="my-modal"></a>')),!t)return!0;for(var o in t)i(o);return!0},{init:function(e){var o,n,t=Object.assign({},{openTrigger:"data-micromodal-trigger"},e),e=f(document.querySelectorAll("[".concat(t.openTrigger,"]"))),i=(o=t.openTrigger,n=[],e.forEach(function(e){var t=e.attributes[o].value;void 0===n[t]&&(n[t]=[]),n[t].push(e)}),n);if(!0!==t.debugMode||!1!==c(e,i))for(var a in i){var r=i[a];t.targetModal=a,t.triggers=f(r),l=new s(t)}},show:function(e,t){t=t||{};t.targetModal=e,!0===t.debugMode&&!1===i(e)||(l&&l.removeEventListeners(),(l=new s(t)).showModal())},close:function(e){e?l.closeModalById(e):l.closeModal()}});function h(e){var t=e.targetModal,o=e.triggers,n=void 0===o?[]:o,i=e.onShow,a=void 0===i?function(){}:i,r=e.onClose,s=void 0===r?function(){}:r,l=e.openTrigger,c=void 0===l?"data-micromodal-trigger":l,d=e.closeTrigger,u=void 0===d?"data-micromodal-close":d,o=e.openClass,i=void 0===o?"is-open":o,r=e.disableScroll,l=void 0!==r&&r,d=e.disableFocus,o=void 0!==d&&d,r=e.awaitCloseAnimation,d=void 0!==r&&r,r=e.awaitOpenAnimation,r=void 0!==r&&r,e=e.debugMode,e=void 0!==e&&e;!function(e){if(!(e instanceof h))throw new TypeError("Cannot call a class as a function")}(this),this.modal=document.getElementById(t),this.config={debugMode:e,disableScroll:l,openTrigger:c,closeTrigger:u,openClass:i,onShow:a,onClose:s,awaitCloseAnimation:d,awaitOpenAnimation:r,disableFocus:o},0<n.length&&this.registerTriggers.apply(this,f(n)),this.onClick=this.onClick.bind(this),this.onKeydown=this.onKeydown.bind(this)}return"undefined"!=typeof window&&(window.MicroModal=o),o});

/**
 * @typedef Dialog
 * @prop {string?} title
 * @prop {string} message
 * @prop {boolean?} hideCloseButton
 * @prop {("error"|"info"|"warn"|"success")?} icon
 * @prop {DialogButton[]?} buttons
 *
 * @typedef SelectDialog
 * @prop {string?} title
 * @prop {string} message
 * @prop {boolean?} hideCloseButton
 * @prop {DialogButton[]?} buttons
 * @prop {SelectDialogOption[]} options
 *
 * @typedef SelectDialogOption
 * @prop {string} text
 * @prop {number} value
 *
 * @typedef DialogButton
 * @prop {string} text
 * @prop {number} id
 */
var Dialog = {
  /**
   * Cria uma janela popup.
   * @param {Dialog} options
   * @returns {Promise<{ buttonId: number }>}
   */
  show(options) {
    var id = Math.random().toString(36);

    // Criar um modal com base nesse html
    document.body.insertAdjacentHTML(
      "beforeend",
      `
      <div class="modal micromodal-slide" id="${id}">
        <div class="modal__overlay" tabindex="-1">
          <div class="modal__container">
            <header class="modal__header">
              <h2 class="modal__title"></h2>
              <a class="modal-close-x" button-id="-1"></a>
            </header>
            <main class="modal__content">
            </main>
            <footer class="modal__footer">
            </footer>
          </div>
        </div>
      </div>`
    );

    var element = document.getElementById(id);

    // Adicionar ícone antes do texto.
    if (options.icon) {
      options.message = `<i class="dialog-icon ${options.icon}"></i>` + options.message;
    }

    // Mostrar os textos do diálogo
    element.querySelector(".modal__title").innerText = options.title || "";
    element.querySelector(".modal__content").innerHTML = options.message || "";

    // Esconder o botão X se pedido
    if (options.hideCloseButton) {
      element.querySelector(".modal-close-x").remove();
    }

    // Adicionar os botões no diálogo
    // Se não forem dados botões, mostrar um "OK" padrão
    for (var button of options.buttons || [{ id: 0, text: "OK" }]) {
      var b = document.createElement("button");
      b.setAttribute("button-id", button.id);
      b.innerText = button.text;
      element.querySelector(".modal__footer").appendChild(b);
    }

    // Mostrar diálogo
    MicroModal.show(id, { awaitCloseAnimation: true, disableScroll: true });

    return new Promise((resolve) => {
      // Adicionar click nos botões
      element.addEventListener("click", (event) => {
        var buttonId = parseInt(event.target.getAttribute("button-id"));

        // Checar se é um número (comparando com infinito, se fosse para fazer normalmente, 0 seria falso)
        if (buttonId < Infinity) {
          MicroModal.close(id);
          resolve({ buttonId });
          setTimeout(() => element.remove(), 2000);
        }
      });
    });
  },

  /**
   * Mostra uma janela popup com select.
   * @param {SelectDialog} options
   * @returns {Promise<{ buttonId: number, value: any, selectedIndex: number }>}
   */
  async showSelect(options) {
    var selectId = Math.floor(Math.random() * 100000000.0);

    var message = `
      ${options.message || ""}
      <select id="${selectId}">
        ${options.options.map((opt) => `<option value="${opt.value}">${opt.text}</option>`)}
      </select>
    `;

    var dialog = await Dialog.show({
      title: options.title,
      buttons: options.buttons,
      hideCloseButton: options.hideCloseButton,
      message: message,
    });

    var value = document.getElementById(selectId).value;
    var selectedIndex = document.getElementById(selectId).selectedIndex;
    console.log(document.getElementById(selectId));
    return { buttonId: dialog.buttonId, value, selectedIndex };
  },
};
