let currentQuestionIndex = 0
const quizArea = document.querySelector('#quizArea')
const questionArea = document.querySelector('#questionArea')
const addQuestionButton = document.querySelector('#addQuestionButton')
const delQuestionButton = document.querySelector('#delQuestionButton')
const nextQuestionButton = document.querySelector('#nextQuestionButton')

const addAnswer = (that = false) => {
  if (that) {
    that.closest('.answer')?.insertAdjacentHTML('afterend', answerHTML())
  } else {
    document.querySelector('.answer-list').insertAdjacentHTML('beforeend', answerHTML())
  }
}

const removeAnswer = (that) => {
  const answer = that.closest('.answer')
  const list = answer.closest('.answer-list')
  const count = list.querySelectorAll('.answer').length
  if (count == 1) return
  answer.remove()
}

const addQuestion = _ => {
  const newQuestion = {
    question: '',
    answers: ['']
  }
  quiz.splice(currentQuestionIndex + 1, 0, newQuestion)
  nextQuestion()
}

const delQuestion = _ => {
  quiz.splice(currentQuestionIndex, 1)
  if (quiz.length == currentQuestionIndex) currentQuestionIndex--
  showQuestion()
}

const answerHTML = (disabled = false, value = '') => {
  return `
    <li class="answer">
      <div class="input-group mb-2">
        <input type="text" ${disabled ? 'disabled' : ''} class="form-control answer-input" value="${value}" placeholder="Ответ">
        ${disabled ? '' : `
          <button type="button" class="btn btn-success" onclick="addAnswer(this)">&plus;</button>
          <button type="button" class="btn btn-danger" onclick="removeAnswer(this)">&times;</button>
        `}
      </div>
    </li>
  `
}

const showQuestion = _ => {
  const item = quiz[currentQuestionIndex]
  if (!item) return

  const disabled = currentQuestionIndex < 2

  const answers = item.answers.map(answer => answerHTML(disabled, answer)).join('\n')

  questionArea.innerHTML = `
    <label class="mb-1">Вопрос №${currentQuestionIndex + 1}</label>
    <input type="text" ${disabled ? 'disabled' : ''} class="form-control mb-4 question-input" value="${item.question || ''}" placeholder="Вопрос">
    <label class="mb-1">Ответы</label>
    <ol class="answer-list">${answers}</ol>
  `
  if (!quiz[currentQuestionIndex + 1]) {
    nextQuestionButton.style.display = 'none'
    saveQuizButton.style.display = 'block'
  }
  addQuestionButton.style.display = currentQuestionIndex < 1 ? 'none' : 'block'
  delQuestionButton.style.display = currentQuestionIndex < 2 ? 'none' : 'block'
  if (!item.answers?.length) addAnswer()
}

function updateItem() {
  const item = quiz[currentQuestionIndex]
  if (!item) return

  item.question = questionArea.querySelector('.question-input').value
  item.answers = []
  questionArea.querySelectorAll('.answer-input').forEach((input, n) => {
    item.answers.push(input.value)
  })
}

function nextQuestion() {
  updateItem()
  currentQuestionIndex++
  showQuestion()
}

async function saveQuiz() {
  updateItem()
  const formData = new FormData()
  const titleInput = document.querySelector('#title')
  const triezAmount = document.querySelector('#amount')
  if (!titleInput.value.trim()) {
    alert('Заполните название теста')
    titleInput.focus()
    return
  }
  formData.append('title', titleInput.value.trim())
  formData.append('tries_amount', triezAmount.value.trim())
  formData.append('quiz', JSON.stringify(quiz))
  const response = await fetch(location.pathname, { method: 'post', body: formData })
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

  const message = quizArea.dataset.quizId == '0' ? 'Тест создан' : 'Тест изменен';
  quizArea.innerHTML = `
    <div class="card col-lg-6 text-center mx-auto my-5 shadow">
      <div class="card-body">
        <h3 class="card-title mb-4">${message}</h3>
        <p class="card-text">Поздравляем! ${message}. Ваша персональная ссылка:</p>
        <p class="card-text"><input class="form-control-plaintext text-center" readonly id="quizLink" value="${result.link}"></p>
        <button type="button" id="quizLinkButton" class="btn btn-lg btn-pink rounded-pill" onclick="copyLinkToClipboard();">Скопировать в буфер обмена</button>
        </div>
    </div>
  `
}

const copyLinkToClipboard = _ => {
  document.querySelector('#quizLink').select();
  document.execCommand('copy');
  const button = document.querySelector('#quizLinkButton')
  button.innerHTML = 'Скопировано в буфер обмена'
  button.disabled = true
}

document.addEventListener('DOMContentLoaded', showQuestion)
