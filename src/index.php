<?php echo file_get_contents(__DIR__ . "/_partials/header.html") ?>

<main class="main">
  <section class="split-pane">
    <div class="pane info-pane">
      <div class="info">
        <h2>Informações</h2>
        <p>
          Bem-vindo ao portal de inscrição do processo seletivo das Faculdades da Indústria!
          Solicitamos atenção na leitura destas informações e do Edital antes de realizar sua
          inscrição para ciência de todas as regras e disposições que regem o presente processo
          seletivo.
        </p>
        <p>
          A prova online - eletrônica consiste na realização de redação obedecendo o tema proposto,
          levando em consideração o domínio da língua e argumentos coerentes com a proposta. Esta
          prova poderá ser realizada logo após a inscrição do usuário ou até o dia 17/03/23 (desde
          que haja vagas disponíveis), com a senha enviada no e-mail de inscrição. Usamos cookies e
          outras tecnologias semelhantes para melhorar a sua experiência em nosso site. Ao realizar
          a sua inscrição, você concorda com a nossa a nossa Política de Privacidade.
        </p>

        <ul>
          <li>Lista</li>
        </ul>
      </div>

      <div class="attachments">
        <div class="attachment">
          <i class="icon file"></i>
          <a class="name" href="#">Edital Vestibular Verão 2023.01.pdf</a>
          <span class="date">28/09/2022</span>
        </div>
      </div>
    </div>
    <div class="pane subscription-pane">
      <!-- Tela de cadastro -->
      <div class="subscription view" id="view-subscription">
        <h2>Inscrever-se</h2>
        <form class="subscription-form" action="POST">
          <div class="field">
            <label for="nome">Nome completo</label>
            <input name="nome" type="text" />
          </div>

          <div class="field">
            <label for="cpf">CPF</label>
            <input name="cpf" type="text" value="   .   .   -  " />
          </div>

          <div class="field">
            <label for="dataNascimento">Data de nascimento</label>
            <input name="dataNascimento" type="date" />
          </div>

          <div class="field">
            <label for="curso">Primeira opção de curso</label>
            <select name="curso">
              <option>Automação Industrial</option>
              <option>Engenharia de Software</option>
              <option>Engenharia Elétrica</option>
              <option>Engenharia Mecânica</option>
            </select>
          </div>

          <!-- inputs escondidas, os valores das inputs dos modais são copiadas aqui para a submissão do formulário -->
          <input type="text" name="email" class="hidden" />
          <input type="text" name="telefone" class="hidden" />
          <input type="text" name="modalidade" class="hidden" />

          <button class="register">Continuar <i class="icon next-white"></i></button>
        </form>
        <button class="goToLogin">Já me inscrevi <i class="icon next-white"></i></button>
      </div>

      <!-- Tela de login -->
      <div class="login view hidden" id="view-login">
        <h2>Login</h2>

        <form class="login-form">
          <div class="field">
            <label for="documento">Documento</label>
            <input name="documento" type="text" />
          </div>
          <div class="field">
            <label for="documento">Data de nascimento</label>
            <input name="documento" type="text" />
          </div>
        </form>

        <button class="goToSubscription">Não estou inscrito <i class="icon next-white"></i></button>
      </div>
    </div>
  </section>
</main>

<div class="modal micromodal-slide" id="modal_modalidade_prova">
  <div class="modal__overlay" tabindex="-1">
    <div class="modal__container">
      <header class="modal__header">
        <h2 class="modal__title">Quase lá...</h2>
      </header>
      <main class="modal__content">
        Qual é seu e-mail?
        <input type="email" name="email" placeholder="fulano@exemplo.com" /><br /><br />

        Qual é seu telefone?
        <input type="text" name="telefone" placeholder="(xx) xxxxx-xxxx" value="(  )      -    " /><br /><br />

        Qual modalidade de prova você prefere?
        <select name="modalidade">
          <option value="presencial">Presencial - concurso de bolsas</option>
          <option value="online">Online</option>
        </select>
      </main>
      <footer class="modal__footer">
        <button id="segundaEtapaContinuar">Continuar</button>
      </footer>
    </div>
  </div>
</div>

<script src="/js/validacao.js"></script>
<script src="/js/formatos.js"></script>
<script src="/lib/modal/dialog.js"></script>

<script>
  // Alias para querySelector e querySelectorAll
  const $ = document.querySelector.bind(document);
  const $$ = document.querySelectorAll.bind(document);

  /** @type {"subscription"|"login"} */
  let currentView = "subscription";

  const subscriptionPane = $("#view-subscription");
  const loginPane = $("#view-login");

  function switchView() {
    currentView = currentView === "subscription" ? "login" : "subscription";

    subscriptionPane.classList.toggle("hidden", currentView === "login");
    loginPane.classList.toggle("hidden", currentView === "subscription");
  }

  function validarEtapa1() {
    function isValidDate(d) {
      return d instanceof Date && !isNaN(d);
    }

    if ($("[name='nome']").value.length < 1) return "O campo de nome deve ser preenchido.";
    if (cpf($("[name='cpf']").value) == false) return "O CPF dado é inválido.";
    if (!isValidDate(new Date($("[name='dataNascimento']").value)))
      return "A data de nascimento é inválida.";
    // Ao chegar aqui, todas as entradas foram aprovadas.
    return true;
  }

  function validarEtapa2() {
    // Ainda chamar a função de validação da primeira etapa;
    let resultadoEtapa1 = validarEtapa1();
    if (resultadoEtapa1 !== true) return resultadoEtapa1;

    if ($(".modal [name='email']").value.indexOf("@") < 0) return "O e-mail dado é inválido.";
    if (limparNumeros($(".modal [name='telefone']").value).length !== 11)
      return "O telefone dado é inválido.";

    return true;
  }

  // Formatar campos de texto
  $("[name='cpf'").addEventListener("focus", (event) => {
    event.target.value = limparNumeros(event.target.value);
  });
  $("[name='cpf']").addEventListener("blur", (event) => {
    event.target.value = formatarCpf(event.target.value).formato;
  });

  $("[name='telefone'").addEventListener("focus", (event) => {
    event.target.value = limparNumeros(event.target.value);
  });
  $("[name='telefone']").addEventListener("blur", (event) => {
    event.target.value = formatarNumeroCelular(event.target.value).formato;
  });

  // Limitar data de nascimento para o momento de agora
  $("[name='dataNascimento']").max = new Date().toISOString().split("T")[0];

  $(".goToLogin").addEventListener("click", switchView);
  $(".goToSubscription").addEventListener("click", switchView);

  // Clique do botão de registro; validar e abrir segunda etapa do formulário
  $("button.register").addEventListener("click", async (event) => {
    event.preventDefault();

    let resultadoValidacao = validarEtapa1();
    if (resultadoValidacao !== true) {
      return Dialog.show({
        icon: "error",
        hideCloseButton: true,
        title: "Verifique os dados digitados",
        message: resultadoValidacao,
      });
    }

    MicroModal.show("modal_modalidade_prova");
  });

  $("#segundaEtapaContinuar").addEventListener("click", async (event) => {
    event.preventDefault();

    let resultadoValidacao = validarEtapa2();
    if (resultadoValidacao !== true) {
      return Dialog.show({
        icon: "error",
        hideCloseButton: true,
        title: "Verifique os dados digitados",
        message: resultadoValidacao,
      });
    }

    submitRegistrationForm();
  });

  function submitRegistrationForm() {
    $(".subscription-form [name='email']").value = $(".modal [name='email']").value;
    $(".subscription-form [name='telefone']").value = limparNumeros(
      $(".modal [name='telefone']").value,
    );
    $(".subscription-form [name='modalidade']").value = $(".modal [name='modalidade']").value;

    $(".subscription-form").submit();
  }
</script>

<?php echo file_get_contents(__DIR__ . "/_partials/footer.html") ?>