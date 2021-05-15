const sendLink = async form => {
  const response = await fetch(location.pathname, { method: 'post', body: new FormData(form) })
  const data = await response.json()
  if (data.error) {
    form.querySelector('#error').innerHTML = escapeHTML(data.error)
    return
  }
  form.outerHTML = `<div class="text-center">${escapeHTML(data.message)}</div>`
}
