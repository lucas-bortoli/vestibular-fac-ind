<h2>Prova online</h2>

<p>
  Digite aqui sua redação, com máximo de 900 caracteres. Boa sorte!
</p>

<table id="statusTable">
  <tr>
    <td>Tempo restante</td>
    <td id="remainingTime">1 hora e 43 minutos</td>
  </tr>
  <tr>
    <td>Caracteres</td>
    <td id="characterCount" maxlength="900">0 de 900</td>
  </tr>
</table>

<div class="cadernoWrapper">
  <textarea spellcheck="false" id="caderno" placeholder="Sua redação aqui..."></textarea>
</div>

<div class="actions">
  <button>Enviar redação</button>
</div>

<script>
  // Alias para querySelector e querySelectorAll
  const $ = document.querySelector.bind(document);
  const $$ = document.querySelectorAll.bind(document);

  const notebookElement = $("#caderno");
  const remainingTimeElement = $("#remainingTime");
  const characterCountElement = $("#characterCount");

  function updateStatus() {
    notebookElement.value = notebookElement.value.substr(0, 900);
    characterCountElement.innerText = `${notebookElement.value.length} de 900`;
  }

  notebookElement.addEventListener("keydown", () => updateStatus());
  notebookElement.addEventListener("keyup", () => updateStatus());
  notebookElement.addEventListener("change", () => updateStatus());
  notebookElement.addEventListener("paste", event => {
    //event.preventDefault();
  });
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=La+Belle+Aurore&display=swap');

#statusTable td:nth-child(2) {
  padding-left: 1em;
  font-weight: bold;
}

.cadernoWrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 2rem 0;
}

#caderno {
  font-family: 'La Belle Aurore', cursive, monospace;
  width: 100%;
  font-size: 22px;
  max-width: 45ch;
  height: calc(1.4em * 20); /* 20 linhas */
  /* 20 * 45 = 900 caracteres */
  line-height: 1.4em;
  box-sizing: content-box;
  border: 1px solid #ddd;
  box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.10);
  border-radius: 4px;

  background-color: #fff; 
  background-image: 
    linear-gradient(#eee .1em, transparent .1em);
  background-size: 100% 1.4em;
  background-position-y: -0.1em;
  background-attachment: local;
}

#caderno:focus {
  border-color: #aaa;
}

.actions {
  display: flex;
  flex-direction: row;
  justify-content: flex-end;
}

@media screen and (max-width: 720px) {

}
</style>