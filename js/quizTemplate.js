const questionTemplateHTML = document.querySelector('#questionTemplate').innerHTML
const answerTemplateHTML = document.querySelector('#answerTemplate').innerHTML
const questionList = document.querySelector('#questionList')
const addQuestion = (elem, item) => {
  let newQuestion
  if (elem) {
    const question = elem.closest('.question')
    question.insertAdjacentHTML('afterend', questionTemplateHTML)
    newQuestion = question.nextElementSibling
  } else {
    questionList.insertAdjacentHTML('beforeend', questionTemplateHTML)
    newQuestion = questionList.querySelector('.question')
  }
  if (!item) {
    newQuestion.querySelector('.answer-list').insertAdjacentHTML('beforeend', answerTemplateHTML)
    return
  }
  newQuestion.querySelector('.question-input').value = item.question
  if (isBaseTemplate) newQuestion.querySelector('.question-immutable').checked = item.immutable
  if (!item.answers.length) {
    newQuestion.querySelector('.answer-list').insertAdjacentHTML('beforeend', answerTemplateHTML)
    return
  }
  item.answers.map(answer => {
    newQuestion.querySelector('.answer-list').insertAdjacentHTML('beforeend', answerTemplateHTML)
    newQuestion.querySelector('.answer:last-child .answer-input').value = answer
  })
}

const removeQuestion = (that) => {
  const question = that.closest('.question')
  const count = questionList.querySelectorAll('.question').length
  if (count <= 3) return
  question.remove()
}
const addAnswer = (that) => {
  const answer = that.closest('.answer')
  answer.insertAdjacentHTML('afterend', answerTemplateHTML)
}
const removeAnswer = (that) => {
  const answer = that.closest('.answer')
  const list = answer.closest('.answer-list')
  const count = list.querySelectorAll('.answer').length
  if (count == 1) return
  answer.remove()
}
const saveTemplate = async _ => {
  const templateData = []
  questionList.querySelectorAll('.question').forEach(questionNode => {
    const question = questionNode.querySelector('.question-input').value.trim()
    if (!question) return
    const item = {
      question,
      answers: []
    }
    questionNode.querySelectorAll('.answer-input').forEach(answerInput => {
      const answer = answerInput.value.trim()
      if (!answer) return
      if (isBaseTemplate) item.immutable = questionNode.querySelector('.question-immutable').checked
      item.answers.push(answer)
    })
    templateData.push(item)
  })

  const payload = new FormData
  payload.append('template', JSON.stringify(templateData))
  const response = await fetch(location.pathname, { method: 'post', body: payload })
  if (!response.ok) {
    alert('Ошибка передачи данных')
    return
  }
  if (response.redirected) {
    location = response.url
    return
  }
  const result = await response.json()
  if (result.error) {
    alert(result.error)
    return
  }

  alert('Шаблон сохранен')
}

data.map(item => {
  addQuestion(questionList.querySelector('.question:last-child input'), item)
})
