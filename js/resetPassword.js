const resetPassword = async form => {
  const response = await fetch(location.pathname, { method: 'post', body: new FormData(form) })
  if (response.redirected) {
    location = response.url
    return
  }
  const data = await response.json()
  if (data.error) {
    form.querySelector('#error').innerHTML = escapeHTML(data.error)
    return
  }
  form.outerHTML = `
    <div class="text-center mb-4">Новый пароль установлен.</div>
    <div class="d-grid"><a href="/login" class="btn btn-lg btn-pink rounded-pill">Войти</a></div>
  `
}
