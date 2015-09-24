<?php
/*
Copyright (C) 2015  Lenilson Jr.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/


/*
    This class deal with everything related to posts, like list, new and others actions
*/

class Posts {

    /*
        New posts function
        RETURN: Array(Erro(Boolean), Message(String), ID of the new posts(Integer))

        $data: Array of data of the post | DEFAULT : Empty
    */
    public function _add($data = array()) {

        if (!empty($data['post'])) {

            $tags_str = '';

            foreach ($data['tags'] as $k => $v) {

                $tags_str = $tags_str . $v . '; ';

            }

            $database = new DB;
            $query = $database->runQuery("INSERT INTO posts
                                (post, tags) VALUES
                                ('".$data['post']."', '".$tags_str."')", true);

            if ($query) {


                $return = array(0, 'Post inserido com sucesso!');

            } else {

                $return = array(1, 'Ocorreu um erro ao tentar inserir o post, tente novamente.');

            }

        } else {

            $return = array(1, 'Por favor, preencha o formulário.');

        }

        return $return;
    }

    /*
        Function to list posts
        RETURN: array of posts

        $max: Number of maximum entries to return | DEFAULT: No limit
    */
    public function _list($max = NULL, $start = NULL, $where = NULL) {

        $max = ($max == NULL) ? '' : ' LIMIT ' . $max;
        $start = ($start == NULL) ? '' : ' OFFSET ' . $start;
        $where = ($where == NULL) ? '' : " WHERE " . $where[0] . " = '" . $where[1] . "' ";

        $database = new DB;
        $query = $database->runQuery("SELECT * FROM posts ORDER BY id DESC" . $where . $max . $start);

        return $query;

    }

    /*
        Function to get a post data
        RETURN: Array(Sucess(Boolean), Array()(Status data))

        $id: The post ID in database | DEFAULT: Empty
    */
    public function _view($id) {

        $database = new DB;
        $query = $database->runQuery("SELECT * FROM posts WHERE id = '".$id."' LIMIT 1");

        if($query) {

            $return = array();
            foreach ($query as $k => $v) {

                $return[$k] = $v;

            }

            return array(0, $return);

        } else {

            return array(1, 'Ocorreu um erro ao tentar recuperar os dados do post!');

        }

    }

    /*
        Function to convert string tags into an array;
        RETURN: array

        $str: The string to convert

    */
    public function tagStrArr($str) {

        $arr = explode("; ", $str);
        unset($arr[count($arr) - 1]);

        return $arr;
    }
}

?>
