/**
 * Remove todo o "lixo" de um número (basicamente tudo o que não é um dígito)
 * @param {string} celular
 * @returns {string}
 */
function limparNumeros(celular) {
  return celular.replace(/[^0-9]/gm, "");
}

/**
 * Formata um número de celular
 * @param {string} digitos
 * @param {string} formato
 * @returns {{ formato: string, numDigitos: number, ultimoNumPos: number }}
 */
function formatarGenerico(digitos, formato) {
  var digitosApenas = limparNumeros(digitos.toString()).split("");
  var numDigitos = digitosApenas.length;
  var ultimoNumPos = 0;

  while (digitosApenas.length > 0) {
    var digito = digitosApenas.shift();
    formato = formato.replace("d", digito || " ");
    ultimoNumPos = formato.indexOf("d");

    if (ultimoNumPos === -1) {
      ultimoNumPos = formato.length;
    }
  }

  formato = formato.replaceAll("d", " ");

  return { formato, numDigitos, ultimoNumPos };
}

/**
 * Formata um número de celular
 * @param {string} digitos
 * @returns {{ formato: string, numDigitos: number, ultimoNumPos: number }}
 */
function formatarNumeroCelular(digitos) {
  return formatarGenerico(digitos, "(dd) ddddd-dddd");
}

/**
 * Formata um CNPJ
 * @param {string} digitos
 * @returns {{ formato: string, numDigitos: number, ultimoNumPos: number }}
 */
function formatarCnpj(digitos) {
  return formatarGenerico(digitos, "dd.ddd.ddd/dddd-dd");
}

/**
 * Formata um CPF
 * @param {string} digitos
 * @returns {{ formato: string, numDigitos: number, ultimoNumPos: number }}
 */
function formatarCpf(digitos) {
  return formatarGenerico(digitos, "ddd.ddd.ddd-dd");
}
