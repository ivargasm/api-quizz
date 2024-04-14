<?php
    require_once "conection.php";

    class QuestionsModel{
            
            static public function getQuestions($data){
                $degree = $data["degree"];
                $topic = $data["topic"];
                $user = $data["user"];
                if (isset($data["partial"]) && !empty($data["partial"])) {
                    $partial = $data["partial"];
                }

                if (isset($data["partial"]) && !empty($data["partial"])) {
                    $sql = "
                    SELECT
                        q.id,
                        q.description AS 'question',
                        q.code,
                        GROUP_CONCAT(a.description ORDER BY a.random_order SEPARATOR '|') AS 'answers',
                        MAX(CASE WHEN a.correct_answer = 1 THEN a.ans_number ELSE 0 END) - 1 AS 'correctAnswer',
                        q.is_open
                    FROM
                        (
                            SELECT *,
                                    (@row_number:=CASE WHEN @prev_question_id = question_id THEN @row_number + 1 ELSE 1 END) AS ans_number,
                                    @prev_question_id:=question_id
                            FROM
                                (
                                    SELECT *,
                                            RAND() AS random_order
                                    FROM answers  -- ejemplo para la pregunta con id=1
                                    ORDER BY question_id, random_order
                                ) as rand_ordered_answers,
                                (SELECT @row_number:=0, @prev_question_id:=NULL) r
                        ) a
                    JOIN questions q ON q.id = a.question_id and active is not false
                    join degrees d on d.id = q.degree_id and degree_id = :degree
                    join topics t on t.id = q.topic_id and topic_id = :topic
                    join partners s on s.id = q.partner_id and q.partner_id = :user
                    and partial = :partial
                    GROUP BY q.id;
                    ";  
                    $stmt = Conexion::conectar()->prepare($sql);
                    $stmt->bindParam(":partial", $partial, PDO::PARAM_STR);
                    $stmt->bindParam(":degree", $degree, PDO::PARAM_STR);
                    $stmt->bindParam(":topic", $topic, PDO::PARAM_STR);
                    $stmt->bindParam(":user", $user, PDO::PARAM_STR);
                }else{
                    $sql = "
                    SELECT
                        q.id,
                        q.description AS 'question',
                        q.code,
                        GROUP_CONCAT(a.description ORDER BY a.random_order SEPARATOR '|') AS 'answers',
                        MAX(CASE WHEN a.correct_answer = 1 THEN a.ans_number ELSE 0 END) - 1 AS 'correctAnswer',
                        q.is_open
                    FROM
                        (
                            SELECT *,
                                    (@row_number:=CASE WHEN @prev_question_id = question_id THEN @row_number + 1 ELSE 1 END) AS ans_number,
                                    @prev_question_id:=question_id
                            FROM
                                (
                                    SELECT *,
                                            RAND() AS random_order
                                    FROM answers  -- ejemplo para la pregunta con id=1
                                    ORDER BY question_id, random_order
                                ) as rand_ordered_answers,
                                (SELECT @row_number:=0, @prev_question_id:=NULL) r
                        ) a
                    JOIN questions q ON q.id = a.question_id and active is not false
                    join degrees d on d.id = q.degree_id and degree_id = :degree
                    join topics t on t.id = q.topic_id and topic_id = :topic
                    join partners s on s.id = q.partner_id and q.partner_id = :user
                    GROUP BY q.id;
                    ";
                    $stmt = Conexion::conectar()->prepare($sql);
                    $stmt->bindParam(":degree", $degree, PDO::PARAM_STR);
                    $stmt->bindParam(":topic", $topic, PDO::PARAM_STR);
                    $stmt->bindParam(":user", $user, PDO::PARAM_STR);
                }

                $stmt -> execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
                $stmt -> close();
                
            }
    }

?>