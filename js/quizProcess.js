let current = -1
let result = ''
const h1 = document.querySelector('h1')
const quizArea = document.querySelector('#quizArea')
const questionArea = document.querySelector('#questionArea')
const errorArea = document.querySelector('#errorArea')
const answersArea = document.querySelector('#answersArea')
const nextButton = document.querySelector('#nextButton')
const resultButton = document.querySelector('#resultButton')

const answersHTML = answers =>
  answers.map((answer, i) => `
    <div class="my-1"><label class="d-flex align-items-center"><input name="answer" type="radio"><div class="ms-2">${escapeHTML(answer)}</div></label></div>
  `).join('\n')

const showQuestion = _ => {
  h1.innerHTML = `Вопрос №${current + 1}`
  questionArea.innerHTML = `<div class="mb-3">${escapeHTML(quiz[current].question)}</div>`
  errorArea.innerHTML = ''
  answersArea.innerHTML = `<div class="mb-4">${answersHTML(quiz[current].answers)}</div>`
  nextButton.style.display = current >= 0 && current <= quiz.length ? 'block' : 'none'
  nextButton.innerHTML = current == -1 ? 'Начать' : (current < quiz.length - 1 ? 'Продолжить' : 'Завершить тест')
}

const fixAnswer = _ => {
  if (current < 0) return true
  const checked = answersArea.querySelector(':checked')
  if (!checked) {
    errorArea.innerHTML = '<div class="mb-2">Выберите ответ</div>'
    return false
  }

  quiz[current].answer = checked.closest('label').textContent

  return true
}

const quizDone = async _ => {
  quizArea.classList.add('shadow')
  h1.innerHTML = 'Тест пройден'
  questionArea.innerHTML = 'Поздравляем! Тест пройден. Вы можете посмотреть Ваш результат, нажав на кнопку'
  errorArea.innerHTML = ''
  answersArea.innerHTML = ''
  nextButton.style.display = 'none'
  resultButton.style.display = 'block'

  const formData = new FormData()
  formData.append('quiz', JSON.stringify(quiz))
  const response = await fetch(location.pathname, { method: 'post', body: formData })
  if (!response.ok) {
    return
  }
  const data = await response.json()
  if (data.error) {
    alert(data.error)
    return
  }

  result = data.result
}

const nextQuestion = _ => {
  if (!fixAnswer()) return
  current++
  if (current < quiz.length) {
    showQuestion()
  } else {
    quizDone()
  }
}

const showResult = _ => {
  h1.innerHTML = 'Результат'
  questionArea.innerHTML = ''
  errorArea.innerHTML = ''
  answersArea.innerHTML = result
  nextButton.style.display = 'none'
  resultButton.style.display = 'none'
}
