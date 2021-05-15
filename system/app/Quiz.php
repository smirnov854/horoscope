<?php

use Better\Nanoid\Client;

class Quiz
{
    static function process($link)
    {
        $quiz = Db::row("select id, processed_at, content from quizes where link = ?", [$link]);
        if (!$quiz) {
            Page::notFound();
            return;
        }
        if ($quiz['processed_at'] !== null) {
            Page::notFound('Тест уже пройден');
            return;
        }

        Template::render('quizProcess', ['quiz' => $quiz]);
    }

    static function saveProcess($link)
    {
        $quiz = Db::row("select id, content, processed_at from quizes where link = ?", [$link]);
        if (!$quiz) {
            Util::json(['error' => 'Тест не найден']);
        }
        if ($quiz['processed_at'] !== null) {
            Util::json(['error' => 'Тест уже пройден']);
            return;
        }

        $content = json_decode($quiz['content'], true);
        if (!$content) {
            Util::json(['error' => 'Ошибка данных']);
        }

        $input = json_decode($_POST['quiz'] ?? [], true);
        $content = self::maintainConstantPart($content);
        foreach ($content as $k => $v) {
            $content[$k]['answer'] = $input[$k]['answer'] ?? 'Нет ответа';
        }

        Db::exec(
            "update quizes set content = ?, processed_at = now() where id = ?",
            [json_encode($content), $quiz['id']]
        );

        $gender = $content[0]['answer'];
        $zodiacSign = $content[1]['answer'];
        $result = Db::field(
            "select content from results where gender = ? and zodiac_sign = ?",
            [$gender, $zodiacSign]
        );
        if (!$result) {
            $result = Db::field(
                "select content from results where gender = ? order by id limit 1",
                [$gender]
            );
        }

        $parsedown = new Parsedown();
        $result = $parsedown->text($result);

        Util::json(['result' => $result]);
    }

    static function form(int $id = 0)
    {
        $quiz = [];
        if ($id) {
            $quiz = Db::row("select id, title, content, processed_at from quizes where id = ?", [$id]);
            if (!$quiz) {
                Page::notFound();
                return;
            }
            if ($quiz['processed_at'] !== null) {
                Page::notFound('Тест уже пройден. Редактирование запрещено.');
                return;
            }
        } else {
            $quiz = Db::row(
                "select 0 id, 'Новый тест' title, quiz_template content from users where id = ?",
                [Auth::user()['id']]
            );
        }
        $content = json_decode($quiz['content'], true);
        if (!$content) {
            $quiz['content'] = Db::field("select content from templates where id = 1");
        }

        Template::render('quizForm', ['quiz' => $quiz]);
    }

    static function save(int $id = 0)
    {
        $title = $_POST['title'] ?? '';
        if (empty($title)) {
            Util::json(['error' => 'Заполните название']);
        }

        $quiz = $_POST['quiz'] ?? null;
        if (!$quiz) {
            Util::json(['error' => 'Тест не передан']);
        }

        $quiz = json_decode($quiz, true);
        if (!$quiz) {
            Util::json(['error' => 'Ошибка данных']);
        }

        $quiz = self::maintainConstantPart($quiz);

        $client = new Client();

        if ($id) {
            $row = Db::row("select link, processed_at from quizes where id = ?", [$id]);
            if (!$row) {
                Util::json(['error' => 'Тест не найден']);
            }
            if ($row['processed_at'] !== null) {
                Util::json(['error' => 'Тест уже пройден. Редактирование запрещено.']);
            }

            Db::exec(
                "update quizes set title = ?, content = ? where id = ?",
                [$title, json_encode($quiz), $id]
            );

            $link = $row['link'];
        } else {
            $link = $client->produce(8, true);

            Db::exec(
                "insert quizes set user_id = ?, created_at = now(), title = ?, content = ?, link = ?",
                [Auth::user()['id'], $title, json_encode($quiz), $link]
            );
        }

        Util::json(['link' => 'https://' . Config::SERVER_NAME . '/q/' . $link]);
    }

    static function emptyTemplate()
    {
        return Db::field("select content from templates where id = 1");
    }

    static function baseTemplate()
    {
        $data = Db::field("select content from templates where id = 1");
        Template::render('quizTemplate', ['data' => $data, 'isBaseTemplate' => true]);
    }

    static function template(int $id = 0)
    {
        if (!$id) {
            $id = Auth::user()['id'] ?? 0;
        }
        $data = Db::field("select quiz_template from users where id = ?", [$id]);
        Template::render('quizTemplate', ['data' => $data, 'isBaseTemplate' => false]);
    }

    static function saveBaseTemplate()
    {
        $template = json_decode($_POST['template'] ?? [], true);
        Db::exec(
            "update templates set content = ? where id = 1",
            [json_encode($template)]
        );
        Util::json(['ok' => true]);
    }

    static function saveTemplate(int $id = 0)
    {
        if (!$id) {
            $id = Auth::user()['id'] ?? 0;
        }
        $template = json_decode($_POST['template'] ?? [], true);
        Db::exec(
            "update users set quiz_template = ? where id = ?",
            [json_encode($template), $id]
        );
        Util::json(['ok' => true]);
    }

    static private function сonstantPart()
    {
        $quiz = Db::field("select content from templates where id = 1");
        $quiz = json_decode($quiz, true);
        foreach ($quiz as $k => $v) {
            /*if (!$v['immutable']) {
                unset($quiz[$k]);
            }*/
        }
        // $quiz = [
        //     [
        //         'question' => 'Пол',
        //         'answers' => ['Мужской', 'Женский']
        //     ], [
        //         'question' => 'Знак зодиака',
        //         'answers' => [
        //             'Овен', 'Телец', 'Близнецы', 'Рак', 'Лев', 'Дева',
        //             'Весы', 'Скорпион', 'Стрелец', 'Козерог', 'Водолей', 'Рыбы'
        //         ]
        //     ]
        // ];

        return $quiz;
    }

    static private function maintainConstantPart($quiz)
    {
        $constant = self::сonstantPart();

        foreach ($constant as $k => $question) {
            if (isset($quiz[$k]['answer'])) {
                $question['answer'] = $quiz[$k]['answer'];
            }
            $quiz[$k] = $question;
        }

        return $quiz;
    }

    static function processedList()
    {
        $list = Db::all("
            select id, title, content, paid_at
            from quizes
            where user_id = ? and processed_at is not null
            order by processed_at desc
        ", [Auth::user()['id']]);

        $quizes = ['paid' => [], 'notPaid' => []];
        foreach ($list as $quiz) {
            $quiz['content'] = json_decode($quiz['content'], true);
            if ($quiz['paid_at'] === null) {
                $quizes['notPaid'][] = $quiz;
            } else {
                $quizes['paid'][] = $quiz;
            }
        }

        Template::render('processedList', ['quizes' => $quizes]);
    }

    static function processedItem(int $id)
    {
        $quiz = Db::row("
            select id, title, content, paid_at
            from quizes
            where user_id = ? and processed_at is not null and id = ?
            order by processed_at desc
        ", [Auth::user()['id'], $id]);

        $quiz['content'] = json_decode($quiz['content'], true);

        Template::render('processedItem', ['quiz' => $quiz]);
    }
}
