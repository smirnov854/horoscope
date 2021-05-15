; (function (w) {
  const Horoscope = {}
  Horoscope.register = async event => {
    event.preventDefault()
    const form = event.target
    const payload = new FormData(form)

    const response = await fetch('/register', { method: 'post', body: payload })
    if (response.redirected) {
      location = response.redirected
      return
    }

    const result = await response.json()
    if (result.error) {
      form.querySelector('#error').innerHTML = result.error
      return
    }

    form.innerHTML = `<div class="text-center">${result.message}</div>`
  }

  Horoscope.init = _ => {
    document.querySelector('#registerForm')?.addEventListener('submit', async event => Horoscope.register(event))
  }

  Horoscope.init()

  w.Horoscope = Horoscope
})(window);

const escapeHTML = unsafe => {
	return unsafe
		.replace(/&/g, "&amp;")
		.replace(/</g, "&lt;")
		.replace(/>/g, "&gt;")
		.replace(/"/g, "&quot;")
		.replace(/'/g, "&#039;");
}
