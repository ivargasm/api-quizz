<?php
    require_once "conection.php";

    class QuestionsModel{
            
            static public function getQuestions($data){
                $degree = $data["degree"];
                $topic = $data["topic"];
                if (isset($data["partial"]) && !empty($data["partial"])) {
                    $partial = $data["partial"];
                }

                if (isset($data["partial"]) && !empty($data["partial"])) {
                    $sql = "
                        SELECT
                            q.id,
                            q.description AS 'question',
                            q.code,
                            GROUP_CONCAT(a.description ORDER BY a.id) AS 'answers',
                            MAX(CASE WHEN a.correct_answer = 1 THEN a.ans_number ELSE 0 END) - 1 AS 'correctAnswer'
                        FROM
                            (
                                SELECT *,
                                    (@row_number:=CASE WHEN @question_id = question_id THEN @row_number + 1 ELSE 1 END) AS ans_number,
                                    @question_id:=question_id
                                FROM answers a,
                                    (SELECT @row_number:=0, @question_id:=NULL) r
                                ORDER BY a.question_id, a.id
                            ) a
                        JOIN questions q ON q.id = a.question_id
                        join degrees d on d.id = q.degree_id and upper(d.description) = upper(:degree)
                        join topics t on t.id = q.topic_id and upper(t.description) = upper(:topic)
                        and partial = :partial
                        GROUP BY q.id;
                    ";  
                    $stmt = Conexion::conectar()->prepare($sql);
                    $stmt->bindParam(":partial", $partial, PDO::PARAM_STR);
                    $stmt->bindParam(":degree", $degree, PDO::PARAM_STR);
                    $stmt->bindParam(":topic", $topic, PDO::PARAM_STR);
                }else{
                    $sql = "
                        SELECT
                            q.id,
                            q.description AS 'question',
                            q.code,
                            GROUP_CONCAT(a.description ORDER BY a.id) AS 'answers',
                            MAX(CASE WHEN a.correct_answer = 1 THEN a.ans_number ELSE 0 END) - 1 AS 'correctAnswer'
                        FROM
                            (
                                SELECT *,
                                    (@row_number:=CASE WHEN @question_id = question_id THEN @row_number + 1 ELSE 1 END) AS ans_number,
                                    @question_id:=question_id
                                FROM answers a,
                                    (SELECT @row_number:=0, @question_id:=NULL) r
                                ORDER BY a.question_id, a.id
                            ) a
                        JOIN questions q ON q.id = a.question_id
                        join degrees d on d.id = q.degree_id and upper(d.description) = upper(:degree)
                        join topics t on t.id = q.topic_id and upper(t.description) = upper(:topic)
                        GROUP BY q.id;
                    ";
                    $stmt = Conexion::conectar()->prepare($sql);
                    $stmt->bindParam(":degree", $degree, PDO::PARAM_STR);
                    $stmt->bindParam(":topic", $topic, PDO::PARAM_STR);
                }

                $stmt -> execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
                $stmt -> close();
                
            }
    }

?>